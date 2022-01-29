<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\BannerModel;

class Banner extends Controller
{
    protected $logged;
	public function __construct()
    {
        $admindata = session()->get('admindata');
        if($admindata){
            $this->logged = $admindata;
        }
    }
	
	public function index()
	{	
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $model = new BannerModel();
		$data = [
            'meta_title' => 'ระบบจัดการข้อมูลแบนเนอร์',
            'info' => $model->orderBy('page ASC, sortby ASC')->findAll()
        ];
		echo view('admin/banner',$data);
    }

    public function form()
    {
        helper('form');
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $data = [
            'meta_title' => 'เพิ่มแบนเนอร์'
        ];
		echo view('admin/banner-form',$data);
    }

    public function edit(){
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        
        //include helper form
        helper(['form']);
        $request = service('request');
        $model = new BannerModel();
        $id = $request->getGet('id');
                
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'info'  =>  $model->where('id',$id)->first()
        ];
        echo view('admin/banner-form', $data);
    }

    public function update()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        helper(['form', 'url']);
        $request = service('request');
        $model = new BannerModel();

        $post = $request->getPost();
        if($post){
            $banner = $request->getFile('txt_banner'); //เก็บไฟล์รูปอัพโหลด
            $hd_banner = $post['hd_banner']; //เก็บไฟล์รูปเดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนรูปใหม่หรือไม่
            $hd_banner_del = $post['hd_banner_del']; //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม

            $banner_mobile = $request->getFile('banner_mobile'); //เก็บไฟล์รูปอัพโหลด
            $hd_banner_mobile = $post['hd_banner_mobile']; //เก็บไฟล์รูปเดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนรูปใหม่หรือไม่
            $hd_banner_mobile_del = $post['hd_banner_mobile_del']; //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม

            $status = ($post['cb_status']=='on'?'1':'0');
            $data = [
                'page' => $post['ddl_page'],
                'link' => urldecode($post['txt_link']),
                'sortby' => $post['sortby'],
                'status' => $status
            ];
            if($post['hd_id']){
                $model->update($post['hd_id'],$data);
                $id = $post['hd_id'];
            }else{
                $model->save($data);
                $id = $model->getInsertID();
            }

            if ($hd_banner!=$hd_banner_del){
                if(is_file($hd_banner_del)){
                    unlink($hd_banner_del); //ลบรูปเก่าออก
                }
                
                if (!is_dir('uploads/banner')) {
					mkdir('uploads/banner', 0777, TRUE);
                    $this->upload($id,$banner,'uploads/banner',$post['ddl_page'],'desktop'); //id, file, path, web page
				}else{
                    $this->upload($id,$banner,'uploads/banner',$post['ddl_page'],'desktop'); //id, file, path, web page
                }
            }

            if ($hd_banner_mobile!=$hd_banner_mobile_del){
                if(is_file($hd_banner_mobile_del)){
                    unlink($hd_banner_mobile_del); //ลบรูปเก่าออก
                }
                
                if (!is_dir('uploads/banner')) {
					mkdir('uploads/banner', 0777, TRUE);
                    $this->upload($id,$banner_mobile,'uploads/banner',$post['ddl_page'],'mobile'); //id, file, path, web page
				}else{
                    $this->upload($id,$banner_mobile,'uploads/banner',$post['ddl_page'],'mobile'); //id, file, path, web page
                }
            }
            //print_r($model->errors());
        }
        
        return redirect()->to('admin/banner');
    }

    public function upload($id,$file,$path,$page,$size)
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $model = new BannerModel();
        $newName = $page.'-'.$file->getRandomName();
        $namemobile = 'mobile-'.$page.'-'.$file->getRandomName();
        $w = 1920;
        $h = 400;
        if($page == 'home'){
            $h = 700;
        }
        $image = \Config\Services::image();

        // $image->withFile($file)
        // ->fit($w, $h, 'center')
        // ->save($path.'/'.$newName);
        if($size=='desktop'){
            $image->withFile($file)->fit($w, $h, 'center')->save($path.'/'.$newName);
            $data = [
                'banner' => $path.'/'.$newName,
            ];
        }else{
            $image->withFile($file)->fit(600, 400, 'center')->save($path.'/'.$namemobile);
            $data = [
                'banner_mobile' => $path.'/'.$namemobile,
            ];
        }
        $model->update($id, $data);
    }

    public function delete()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        
        $request = service('request');
        $model = new BannerModel();
        if($request->getPost('id')){
			$id = $request->getPost('id');
            $delImg = $model->where('id',$id)->first();
			if(is_file($delImg['banner'])){
				unlink($delImg['banner']); //ลบรูปเก่าออก
			}
            if(is_file($delImg['banner_mobile'])){
				unlink($delImg['banner_mobile']); //ลบรูปเก่าออก
			} 
            $deleted = $model->where('id', $id)->delete($id);
			echo TRUE;
            
        }else{
            return redirect()->to(site_url('admin/articles'));
        }
    }
}
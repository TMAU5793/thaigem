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
            'info' => $model->findAll()
        ];
		echo view('admin/banner',$data);
    }

    public function form()
    {
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
            $hd_banner = $request->getVar('hd_banner'); //เก็บไฟล์รูปเดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนรูปใหม่หรือไม่
            $hd_banner_del = $request->getVar('hd_banner_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
            $data = [
                'page' => $post['ddl_page']
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
                    $this->upload($id,$banner,'uploads/banner',$post['ddl_page']); //id, file, path, web page
				}else{
                    $this->upload($id,$banner,'uploads/banner',$post['ddl_page']); //id, file, path, web page
                }
            }

        }
        
        return redirect()->to('admin/banner');
    }

    public function upload($id,$file,$path,$page)
    {
        $model = new BannerModel();
        $newName = $page.'-'.$file->getRandomName();
        $w = 1920;
        $h = 300;
        if($page == 'home'){
            $h = 700;
        }
        $image = \Config\Services::image()
        ->withFile($file)
        ->fit($w, $h, 'center')
        ->save($path.'/'.$newName);
        
        $data = [
            'banner' => $path.'/'.$newName
        ];
        $model->update($id, $data);
    }
}
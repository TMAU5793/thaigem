<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Price extends Controller
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
        $db = db_connect();
        $tbl_price = $db->table('tbl_price');
        $data = [
            'info' => $tbl_price->get()->getResultArray()
        ];

        return view('admin/price',$data);
    }

    public function form()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        helper(['form']);
        $request = service('request');
        $db = db_connect();
        $tbl_price = $db->table('tbl_price');

        $id = $request->getGet('id');
        if($id==''){
            $data = [
                'meta_title' => 'ตารางราคา'
            ];
        }else{
            $data = [
                'meta_title' => 'ตารางราคา',
                'info' => $tbl_price->where('id',$id)->get()->getRowArray()
            ];
        }
        return view('admin/price-form',$data);
    }

    public function update()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $request = service('request');
        $db = db_connect();
        $tbl_price = $db->table('tbl_price');

        $post = $request->getPost();
        if($post){
            $date = date('Y-m-d H:i:s');
            $status = ($post['cb_status']=='on'?'1':'0');
            $id = $post['hd_id'];
            if($id==''){
                $data = [
                    'type' => $post['rd_type'],
                    'status' => $status,
                    'created_at' => $date,
                    'updated_at' => $date
                ];
                $tbl_price->insert($data);
                $id = $db->insertID();
            }else{
                $data = [
                    'type' => $post['rd_type'],
                    'status' => $status,
                    'updated_at' => $date
                ];
                $tbl_price->where('id',$id);
                $tbl_price->update($data);
            }

            $file = $request->getFile('txt_file'); //เก็บไฟล์รูปอัพโหลด
            $hd_file = $post['hd_file']; //เก็บไฟล์รูปเดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนรูปใหม่หรือไม่
            $hd_file_del = $post['hd_file_del']; //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
            
            // echo '$hd_file:'.$hd_file;
            // echo '<br>$hd_file_del:'.$hd_file_del;
            if ($hd_file!=$hd_file_del){
                if(is_file($hd_file_del)){
                    unlink($hd_file_del); //ลบรูปเก่าออก
                }
                
                if (!is_dir('uploads/price')) {
					mkdir('uploads/price', 0777, TRUE);
                    $this->uploadFile($id,$file,'uploads/price'); //file,width,height,path
				}else{
                    $this->uploadFile($id,$file,'uploads/price'); //file,width,height,path
                }
            }
        }

        return redirect()->to('admin/price');
    }

    public function uploadFile($id,$file,$path)
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $db      = db_connect();
        $builder = $db->table('tbl_price');
        $newName = $id.'-'.$file->getRandomName();

        $file->move($path,$newName);

        $data = [
            "file" => $path.'/'.$newName
        ];
        $builder->where('id',$id);
        $builder->update($data);
        print_r($builder->error);
    }

    public function delete()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $request = service('request');
        $db = db_connect();
        $tbl_price = $db->table('tbl_price');
        if($request->getPost('id')){
			$id = $request->getPost('id');
            $delImg = $tbl_price->where('id',$id)->get()->getRowArray();
			if(is_file($delImg['file'])){
				unlink($delImg['file']); //ลบรูปเก่าออก
			}            
            $tbl_price->where('id', $id);
            $tbl_price->delete();
			echo TRUE;
            
        }else{
            return redirect()->to(site_url('admin/price'));
        }       
    }
}
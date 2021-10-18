<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\FilesModel;

class Files extends Controller
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
        $model = new FilesModel();
		$data = [
            'meta_title' => 'รายการเอกสาร',
			'info' => $model->findAll()
        ];
		echo view('admin/formfiles',$data);
    }

	public function form()
	{
		
		$data = [
            'meta_title' => 'อัปโหลดเอกสาร'
        ];
		echo view('admin/formfiles-form',$data);
	}

	public function edit(){
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        
        //include helper form
        helper(['form']);
        $request = service('request');
        $model = new FilesModel();
        $id = $request->getGet('id');
                
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'info'  =>  $model->where('id',$id)->first()
        ];
        echo view('admin/formfiles-form', $data);
    }

	public function update()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        helper(['form', 'url']);
        $request = service('request');
        $model = new FilesModel();
		
        $post = $request->getPost();
		//print_r($post);
        if($post){
            $banner = $request->getFile('txt_file'); //เก็บไฟล์อัพโหลด
			//print_r($banner);
            $hd_file = $request->getVar('hd_file'); //เก็บไฟล์เดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนใหม่หรือไม่
            $hd_file_del = $request->getVar('hd_file_del'); //เก็บข้อมูล เพื่อจะนำไปเช็คว่ามีอยู่ไหม
            $data = [
                'filefor' => $post['ddl_filefor'],
				'filename' => url_title($post['txt_name'])
            ];
            if($post['hd_id']){
                $model->update($post['hd_id'],$data);
                $id = $post['hd_id'];
            }else{
                $model->save($data);
                $id = $model->getInsertID();
            }

            if ($hd_file!=$hd_file_del){
                if(is_file($hd_file_del)){
                    unlink($hd_file_del); //ลบรูปเก่าออก
                }
                
                if (!is_dir('uploads/files')) {
					mkdir('uploads/files', 0777, TRUE);
                    $this->upload($id,$banner,'uploads/files',url_title($post['txt_name'])); //id, file, path, file name
				}else{
                    $this->upload($id,$banner,'uploads/files',url_title($post['txt_name'])); //id, file, path, file name
                }
            }

        }
        
        return redirect()->to('admin/files');
    }

    public function upload($id,$file,$path,$name)
    {
		helper(['form','filesystem']);
        $model = new FilesModel();
        $newName = $id.'-'.$name;

        // $image = \Config\Services::image()
        // ->withFile($file)
        // ->fit($w, $h, 'center')
        // ->save($path.'/'.$newName);
        $file->move($path,$newName);
        $data = [
            'path' => $path.'/'.$newName
        ];
        $model->update($id, $data);
    }
}
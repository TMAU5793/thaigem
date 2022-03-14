<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\FilesModel;
use App\Models\MemberModel;

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
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        $model = new FilesModel();
        $mbModel = new MemberModel();
        $request = service('request');
        $keyword = $request->getGet('keyword');

        $info = '';
        if($keyword!=''){
            $info = $model->join('tbl_member as b','tbl_files.member_id = b.id')
                ->where('tbl_files.uploadby','admin')->like('b.company',$keyword)->orderBy('tbl_files.created_at DESC')->paginate(25);
        }else{
            $info = $model->where('uploadby','admin')->orderBy('created_at DESC')->paginate(25);
        }
		$data = [
            'meta_title' => 'รายการเอกสาร',
			'info' => $info,
            'pager' => $model->pager,
            'member' => $mbModel->where('type','dealer')->orderBy('created_at DESC')->findAll(),
            'm_upload' => TRUE
        ];
		echo view('admin/formfiles',$data);
    }

    public function memberfiles()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        $model = new FilesModel();
        $mbModel = new MemberModel();
        $request = service('request');
        $keyword = $request->getGet('keyword');
        
        $info = '';
        if($keyword!=''){
            $info = $model
                ->join('tbl_member as b','tbl_files.member_id = b.id')
                ->where('tbl_files.uploadby',null)->like('b.company',$keyword)->orderBy('tbl_files.created_at DESC')->paginate(25);
        }else{
            $info = $model
                ->join('tbl_member as b','tbl_files.member_id = b.id')
                ->where('tbl_files.uploadby',null)->orderBy('tbl_files.created_at DESC')->paginate(25);
        }
		$data = [
            'meta_title' => 'เอกสารลูกค้า',
			'info' => $info,
            'pager' => $model->pager,
            'member' => $mbModel->where('type','dealer')->orderBy('created_at DESC')->findAll()            
        ];
        //print_r($info);
		echo view('admin/formfiles',$data);
    }

	public function form()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
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
            $rules = [
                'txt_name' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกชื่อไฟล์'
                    ]
                ],
                'hd_file' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณาเลือกไฟล์'
                    ]
                ]
            ];
            
            if($this->validate($rules)){
                $file = $request->getFile('txt_file'); //เก็บไฟล์อัพโหลด
                //print_r($file);
                $hd_file = $request->getVar('hd_file'); //เก็บไฟล์เดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนใหม่หรือไม่
                $hd_file_del = $request->getVar('hd_file_del'); //เก็บข้อมูล เพื่อจะนำไปเช็คว่ามีอยู่ไหม

                $fileName = url_title($post['txt_name']);
                $fileType = $post['hd_file_type'];
                $data = [
                    'filename' => $fileName,
                    'filefor' => $post['ddl_filefor'],
                    'uploadby' => 'admin'
                ];
                if($post['hd_member']){
                    $data = [
                        'filename' => $fileName,
                        'filefor' => $post['ddl_filefor'],
                        'member_id' => $post['hd_member'],
                        'uploadby' => 'admin'
                    ];
                }

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
                        $this->upload($id,$file,'uploads/files',$fileName,$fileType); //id, file, path, file name
                    }else{
                        $this->upload($id,$file,'uploads/files',$fileName,$fileType); //id, file, path, file name
                    }
                }
                if($post['hd_member']){
                    return redirect()->to('admin/member/fileupload?id='.$post['hd_member']);
                }else{
                    return redirect()->to('admin/files');
                }
            }else{
                $data['validation'] = $this->validator;
                echo view('admin/formfiles-form',$data);
            }
        }else{
            return redirect()->to('admin/files');
        }
    }

    public function upload($id,$file,$path,$name,$type)
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		helper(['form','filesystem']);
        $model = new FilesModel();
        $newName = $name.'.'.$type;

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

    public function downloadFiles()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        helper('download');
        $request = service('request');
        $model = new FilesModel();
        $post = $request->getPost();
        if($post){
            $id = $post['hd_id'];
            $file = $model->where('id',$id)->first();
            if(is_file($file['path'])){
                $type = array_pop(explode('.',$file['path']));
                $name = $file['filename'];
                $path = ROOTPATH.$file['path'];
                return $this->response->download($path, null);
            }else{
                return redirect()->to('admin/files/memberfiles');
            }
        }else{
            return redirect()->to('admin/files/memberfiles');
        }        
    }

    public function delete()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        $request = service('request');
        $model = new FilesModel();
        if($request->getPost('id')){
			$id = $request->getPost('id');
            $delImg = $model->where('id',$id)->first();
			if(is_file($delImg['path'])){
				unlink($delImg['path']); //ลบรูปเก่าออก
			}            
            $deleted = $model->where('id', $id)->delete($id);				
			echo $deleted;
            
        }else{
            return redirect()->to(site_url('admin/files'));
        }
    }    
}
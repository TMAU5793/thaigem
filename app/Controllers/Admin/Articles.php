<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\ArticlesModel;

class Articles extends Controller
{
	public function __construct()
    {
        
    }
	
	public function index()
	{	
        $model = new ArticlesModel();
		$data = [
            'meta_title' => 'บทความ',
            'info' => $model->orderBy('status DESC, created_at DESC')->findAll()
        ];
		echo view('admin/article',$data);
	}

    public function form()
    {
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }

        helper(['form']);
        $data = [
            'meta_title' => 'เพิ่มบทความ',
            'action'    =>  'save',
        ];
        echo view('admin/article-form', $data);
    }

    public function save()
    {
        helper(['form']);
        $model = new ArticlesModel();
        $request = service('request');
        $data = [
            'meta_title' => 'เพิ่มบทความ',
            'action'    =>  'save'
        ];
        $thumb = $request->getFile('txt_thumb');
        // echo $thumb->getName();
        // echo '<br> hd_thumb : '.$request->getVar('hd_thumb');

        if ($request->getMethod() == 'post') {
            $rules = [
                'txt_title' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกข้อมูลหัวข้อ'
                    ]
                ],
                'txt_desc' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกรข้อมูลรายละเอียด'
                    ]
                ],
                'hd_thumb' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณาใส่รูปภาพ Thumbnail'
                    ]
                ]
            ];
            
            if($this->validate($rules)){
                $thumb = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
                $allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
                $ext = $thumb->getExtension();
                $newName = "";

                if ($thumb->isValid() && !$thumb->hasMoved() && in_array($ext, $allowed)){
                    $newName = $thumb->getRandomName();
                    if (!is_dir('uploads/articles')) {
                        mkdir('uploads/articles', 0777, TRUE);
                        $thumb->move('uploads/articles',$newName);
                    }else{
                        $thumb->move('uploads/articles',$newName);
                    }
                }
                $data = [
                    'title' => $request->getVar('txt_title'),
                    'shortdesc' => $request->getVar('txt_shortdesc'),
                    'desc' => $request->getVar('txt_desc'),
                    'tags' => $request->getVar('txt_tags'),
                    'slug' => $request->getVar('txt_slug'),
                    'meta_title' => $request->getVar('meta_title'),
                    'meta_desc' => $request->getVar('meta_desc'),
                    'status' => $request->getVar('ddl_status'),
                    'thumbnail' => 'uploads/articles/'.$newName
                ];
                $model->save($data);
                return redirect()->to(site_url('admin/articles'));
            }else{
                $data['validation'] = $this->validator;
                echo view('admin/article-form',$data);
            }
        }else{
            return redirect()->to(site_url('admin/articles'));
        }
    }

    public function edit(){
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
        
        //include helper form
        helper(['form']);
        $request = service('request');
        $model = new ArticlesModel();
        $id = $request->getGet('id');
                
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'action'    =>  'update',
            'info'  =>  $model->where('id',$id)->first()
        ];
        echo view('admin/article-form', $data);
    }

    public function update()
    {
        helper(['form']);
        helper('filesystem');
        $request = service('request');
        $model = new ArticlesModel();
        if ($request->getMethod() == 'post') {
            $id = $request->getVar('hd_id'); //เก็บค่า id
            $thumb = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
            $hd_thumb_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
            $allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
            $ext = $thumb->getExtension();
            // echo $hd_thumb;
            // echo '<br> getName : '.$thumb->getName();

            if ($thumb->isValid() && !$thumb->hasMoved() && in_array($ext, $allowed)){
                unlink($hd_thumb_del); //ลบรูปเก่าออก
                $newName = $thumb->getRandomName();
                if (!is_dir('uploads/articles')) {
					mkdir('uploads/articles', 0777, TRUE);
                    $thumb->move('uploads/articles',$newName);
				}else{
                    $thumb->move('uploads/articles',$newName);
                }

                $thumb = [
                    'thumbnail' => 'uploads/articles/'.$newName
                ];
                $model->update($id, $thumb);
            }

            $update = [
                'title' => $request->getVar('txt_title'),
                'shortdesc' => $request->getVar('txt_shortdesc'),
                'desc' => $request->getVar('txt_desc'),
                'tags' => $request->getVar('txt_tags'),
                'slug' => $request->getVar('txt_slug'),
                'meta_title' => $request->getVar('meta_title'),
                'meta_desc' => $request->getVar('meta_desc'),
                'status' => $request->getVar('ddl_status')                
            ];
            if($model->update($id, $update)){
                return redirect()->to(site_url('admin/articles'));
            }
        }else{
            return redirect()->to(site_url('admin/articles'));
        }        
    }
}

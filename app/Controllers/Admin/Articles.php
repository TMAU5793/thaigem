<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\Admin\ArticlesModel;

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
                
                $data = [
                    'type' => $request->getVar('rd_type'),
                    'hot_article' => $request->getVar('txt_hot_article'),
                    'title' => $request->getVar('txt_title'),
                    'title_en' => $request->getVar('txt_title_en'),
                    'shortdesc' => $request->getVar('txt_shortdesc'),
                    'shortdesc_en' => $request->getVar('txt_shortdesc_en'),
                    'desc' => $request->getVar('txt_desc'),
                    'desc_en' => $request->getVar('txt_desc_en'),
                    'tags' => $request->getVar('txt_tags'),
                    'tags_en' => $request->getVar('txt_tags_en'),
                    'slug' => $request->getVar('txt_slug'),
                    'slug_en' => $request->getVar('txt_slug_en'),
                    'meta_title' => $request->getVar('meta_title'),
                    'meta_title_en' => $request->getVar('meta_title_en'),
                    'meta_desc' => $request->getVar('meta_desc'),
                    'meta_desc_en' => $request->getVar('meta_desc_en'),
                    'status' => $request->getVar('txt_status')
                ];
                $model->save($data);
                $id = $model->getInsertID();
                if ($thumb->isValid() && !$thumb->hasMoved() && in_array($ext, $allowed)){
                    
                    if (!is_dir('uploads/articles')) {
                        mkdir('uploads/articles', 0777, TRUE);
                        $this->resizeImg($id,$thumb,650,650,'uploads/articles'); //id,file,width,height,path
                    }else{
                        $this->resizeImg($id,$thumb,650,650,'uploads/articles'); //id,file,width,height,path
                    }
                }
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
            $hd_thumb = $request->getVar('hd_thumb'); //เก็บไฟล์รูปเดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนรูปใหม่หรือไม่
            $hd_thumb_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
            $allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
            $ext = $thumb->getExtension();
            
            if ($hd_thumb!=$hd_thumb_del){
                if(is_file($hd_thumb_del)){
                    unlink($hd_thumb_del); //ลบรูปเก่าออก
                }
                
                if (!is_dir('uploads/articles')) {
					mkdir('uploads/articles', 0777, TRUE);
                    $this->resizeImg($id,$thumb,650,650,'uploads/articles'); //file,width,height,path
				}else{
                    $this->resizeImg($id,$thumb,650,650,'uploads/articles'); //file,width,height,path
                }                
            }

            $update = [
                'type' => $request->getVar('rd_type'),
                'hot_article' => $request->getVar('txt_hot_article'),
                'title' => $request->getVar('txt_title'),
                'title_en' => $request->getVar('txt_title_en'),
                'shortdesc' => $request->getVar('txt_shortdesc'),
                'shortdesc_en' => $request->getVar('txt_shortdesc_en'),
                'desc' => $request->getVar('txt_desc'),
                'desc_en' => $request->getVar('txt_desc_en'),
                'tags' => $request->getVar('txt_tags'),
                'tags_en' => $request->getVar('txt_tags_en'),
                'slug' => $request->getVar('txt_slug'),
                'slug_en' => $request->getVar('txt_slug_en'),
                'meta_title' => $request->getVar('meta_title'),
                'meta_title_en' => $request->getVar('meta_title_en'),
                'meta_desc' => $request->getVar('meta_desc'),
                'meta_desc_en' => $request->getVar('meta_desc_en'),
                'status' => $request->getVar('txt_status')
            ];
            if($model->update($id, $update)){
                return redirect()->to(site_url('admin/articles'));
            }else{
                print_r($model->error());
            }
        }else{
            return redirect()->to(site_url('admin/articles'));
        }

        //print_r($request->getPost());
    }

    public function resizeImg($id,$file,$w,$h,$path)
    {
        $model = new ArticlesModel();
        $newName = $id.'-'.$file->getRandomName();

        $image = \Config\Services::image()
        ->withFile($file)
        ->fit($w, $h, 'center')
        ->save($path.'/'.$newName);

        $thumb = [
            'thumbnail' => 'uploads/articles/'.$newName
        ];
        $model->update($id, $thumb);
    }
}

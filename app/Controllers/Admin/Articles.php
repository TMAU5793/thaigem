<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\Admin\ArticlesModel;
use CodeIgniter\I18n\Time;

class Articles extends Controller
{
	public function __construct()
    {
        
    }
	
	public function index()
	{	
        $model = new ArticlesModel();
        $request = service('request');
		$keyword = $request->getGet('keyword');
		$info = $model->orderBy('status DESC, created_at DESC')->paginate(25);
		if($keyword){
            $info = $model->like('title',$keyword)->orLike('title_en',$keyword)->orderBy('status DESC, created_at DESC')->paginate(25);
        }

		$data = [
            'meta_title' => 'บทความ',
            'info' => $info,
            'pager' => $model->pager,
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

                $slug = url_title(strtolower($request->getVar('txt_slug')));
                if($request->getVar('txt_slug')==""){
                    $slug = url_title(strtolower($request->getVar('txt_title')));
                }
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
                    'slug' => $slug,
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
                        $this->resizeImg($id,$thumb,600,400,'uploads/articles'); //id,file,width,height,path
                    }else{
                        $this->resizeImg($id,$thumb,600,400,'uploads/articles'); //id,file,width,height,path
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
                    $this->resizeImg($id,$thumb,600,400,'uploads/articles'); //file,width,height,path
				}else{
                    $this->resizeImg($id,$thumb,600,400,'uploads/articles'); //file,width,height,path
                }
            }

            $slug = url_title(strtolower($request->getVar('txt_slug')));
            if($request->getVar('txt_slug')==""){
                $slug = url_title(strtolower($request->getVar('txt_title')));
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
                'slug' => $slug,
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

    public function information()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_information');
        $query = $builder->get()->getresultArray();
		$data = [
            'meta_title' => 'ข้อมูลเว็บไซต์',
            'info' => $query
        ];
		echo view('admin/web-info',$data);

        //print_r($query);
    }

    public function informationform()
    {
        helper(['form']);
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_information');
        $request = service('request');

        $getdata = $request->getGet('id');
        if($getdata){
            $builder->where('id',$getdata);
            $builder->limit(1);
            $data = [
                'meta_title' => 'อัพเดตข้อมูลเว็บไซต์',
                'action' => 'saveInformation',
                'info_single' => $builder->get()->getRow()
            ];
        }else{
            
            $data = [
                'meta_title' => 'เพิ่มข้อมูลเว็บไซต์',
                'action' => 'saveInformation'                
            ];
        }

		echo view('admin/web-info-form',$data);
    }

    public function saveInformation()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_information');
        $request = service('request');
        helper(['form']);

        $datetime = new Time('now');

        $rules = [
            'txt_title_th'          => [
                'rules' => 'required',
                'errors'    =>  [
                    'required'  =>  'กรุณากรอกข้อมูล'
                ]
            ],
            'ddl_cate' => [
                'rules' => 'required',
                'errors'    =>  [
                    'required'  =>  'กรุณากรอกข้อมูล'
                ]
            ]
        ];
        
        if(!$this->validate($rules)){
            $data['validation'] = $this->validator;
            echo view('admin/web-info-form',$data);
        }else{

            $postdata = $request->getPost();
            $status = '1';
            if($postdata['txt_status']=='off'){
                $status = '0';
            }
            $slug = url_title(strtolower($postdata['txt_title_en']));
            if($slug==''){
                $slug = url_title(strtolower($postdata['txt_title_th']));
            }
            if($postdata['hd_id']!=""){
                $arrdata = [
                    'page' => $postdata['ddl_page'],
                    'cate' => $postdata['ddl_cate'],
                    'title_th' => $postdata['txt_title_th'],
                    'title_en' => $postdata['txt_title_en'],
                    'desc_th' => $postdata['txt_desc'],
                    'desc_en' => $postdata['txt_desc_en'],
                    'slug' => $slug,
                    'seo_title_th' => $postdata['seo_title_th'],
                    'seo_desc_th' => $postdata['seo_desc_th'],
                    'seo_title_en' => $postdata['seo_title_en'],
                    'seo_desc_en' => $postdata['seo_desc_en'],
                    'status' => $status,
                    'updated_at' => $datetime
                ];
                $builder->where('id',$postdata['hd_id']);
                $query = $builder->update($arrdata);
            }else{
                $arrdata = [
                    'page' => $postdata['ddl_page'],
                    'cate' => $postdata['ddl_cate'],
                    'title_th' => $postdata['txt_title_th'],
                    'title_en' => $postdata['txt_title_en'],
                    'desc_th' => $postdata['txt_desc'],
                    'desc_en' => $postdata['txt_desc_en'],
                    'slug' => $slug,
                    'seo_title_th' => $postdata['seo_title_th'],
                    'seo_desc_th' => $postdata['seo_desc_th'],
                    'seo_title_en' => $postdata['seo_title_en'],
                    'seo_desc_en' => $postdata['seo_desc_en'],
                    'status' => $status,
                    'created_at' => $datetime,
                    'updated_at' => $datetime
                ];
                $query = $builder->insert($arrdata);
            }
            
            return redirect()->to('admin/articles/information');
        }
    }
}

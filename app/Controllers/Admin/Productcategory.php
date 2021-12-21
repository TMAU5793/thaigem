<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\Admin\ProductCategoryModel;

class Productcategory extends Controller
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

		helper('form');
		$model = new ProductCategoryModel();
        $request = service('request');
		$keyword = $request->getGet('keyword');
		$info = $model->orderby('maincate_id','ASC')->paginate(25);
		if($keyword){
            $info = $model->like('name_th',$keyword)->orLike('name_en',$keyword)->orderby('maincate_id','ASC')->paginate(25);
        }
		$data = [
            'meta_title' => 'หมวดหมู่สินค้า',
			'main_cate' => $model->where('maincate_id',0)->findAll(),
			'info' => $info,
			'pager' => $model->pager
        ];
		echo view('admin/product-category',$data);
	}

	public function form()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		helper('form');
		$model = new ProductCategoryModel();
		$data = [
            'meta_title' => 'เพิ่มหมวดหมู่สินค้า',
			'action' => 'savedata',
			'cates' => $model->where(['maincate_id'=>0,'status'=>'1'])->findAll()
        ];
		echo view('admin/product-categoryform',$data);
	}

	public function edit()
	{
		if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
		helper('form');
		$request = service('request');
		$model = new ProductCategoryModel();

		$id = $request->getGet('id');
		$getcate = $model->where('id',$id)->first();
		if($getcate){
			$data = [
				'meta_title' => 'แก้ไขหมวดหมู่สินค้า',
				'action' => 'savedata',
				'info' => $getcate,
				'cates' => $model->where(['maincate_id'=>0,'status'=>'1'])->findAll()
			];
			echo view('admin/product-categoryform',$data);
		}else{
			return redirect()->to('admin/productcategory');
		}
	}

	public function savedata()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		$model = new ProductCategoryModel();
		helper('form');
		$request = service('request');
		$post = $request->getPost();
		if($post){
			if($post['hd_id']==""){
				$rules = [
					'txt_name' => [
						'rules' => 'required|is_unique[tbl_productcategory.name_th]',
						'errors' =>  [
							'required' => 'กรุณากรอกชื่อหมวดสินค้า (TH)',
							'is_unique' => 'ชื่อหมวดหมู่สินค้าซ้ำกัน'
						]
					]
				];
			}else{
				$rules = [
					'txt_name' => [
						'rules' => 'required',
						'errors' =>  [
							'required' => 'กรุณากรอกชื่อหมวดสินค้า (TH)'
						]
					]
				];
			}
			if($this->validate($rules)){
				$result = $model->productCategory($post);
				if($result){
					$thumb = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
					$hd_thumb = $request->getVar('hd_thumb'); //เก็บไฟล์รูปเดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนรูปใหม่หรือไม่
					$hd_thumb_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
					if ($hd_thumb!=$hd_thumb_del){
						if(is_file($hd_thumb_del)){
							unlink($hd_thumb_del); //ลบรูปเก่าออก
						}
						
						if (!is_dir('uploads/product')) {
							mkdir('uploads/product', 0777, TRUE);
							$this->resizeImg($result,$thumb,400,300,'uploads/product'); //file,width,height,path
						}else{
							$this->resizeImg($result,$thumb,400,300,'uploads/product'); //file,width,height,path
						}
					}
					return redirect()->to('admin/productcategory');
				}
			}else{
				$data = [
					'validation' => $this->validator,
					'action' => 'savedata'
				];
                echo view('admin/product-categoryform',$data);
			}
		}else{
			return redirect()->to('admin/productcategory');
		}
	}

	public function resizeImg($id,$file,$w,$h,$path)
    {
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $model = new ProductCategoryModel();
        $newName = 'cate-'.$file->getRandomName();

        $image = \Config\Services::image()
        ->withFile($file)
        ->fit($w, $h, 'center')
        ->save($path.'/'.$newName);

        $thumb = [
            'thumbnail' => 'uploads/product/'.$newName
        ];
        $model->update($id, $thumb);
    }

	public function delete()
    {
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
		
        $request = service('request');
        $model = new ProductCategoryModel();
        if($request->getPost('id')){
			$id = $request->getPost('id');

			$delImg = $model->where('id',$id)->first();
			if(is_file($delImg['thumbnail'])){
				unlink($delImg['thumbnail']); //ลบรูปเก่าออก
			}            
            $deleted = $model->where('id', $id)->delete($id);				
			echo TRUE;
            
        }else{
            return redirect()->to(site_url('admin/productcategory'));
        }
    }
}
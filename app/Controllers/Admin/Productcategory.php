<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\Admin\ProductCategoryModel;

class Productcategory extends Controller
{

	public function index()
	{	
		helper('form');
		$model = new ProductCategoryModel();
		$data = [
            'meta_title' => 'หมวดหมู่สินค้า',
			//'info' => $model->findAll()
			'info' => $model->paginate(25),
			'pager' => $model->pager
        ];
		echo view('admin/product-category',$data);
	}

	public function form()
	{
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
		if (!session()->get('logged_admin')) {
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
}
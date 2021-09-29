<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\Admin\BusinessModel;

class Business extends Controller
{

	public function index()
	{	
		helper('form');
		$model = new BusinessModel();
		$data = [
            'meta_title' => 'ประเภทธุรกิจ',
			'main_type' => $model->where('main_type',0)->findAll(),
			'info' => $model->orderby('main_type','ASC')->paginate(25),
			'pager' => $model->pager
        ];
		echo view('admin/business',$data);
	}

	public function form()
	{
		helper('form');
		$model = new BusinessModel();
		$data = [
            'meta_title' => 'เพิ่มประเภทธุรกิจ',
			'action' => 'savedata',
			'cates' => $model->where(['main_type'=>0,'status'=>'1'])->findAll()
        ];
		echo view('admin/business-form',$data);
	}

	public function edit()
	{
		if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
		helper('form');
		$request = service('request');
		$model = new BusinessModel();

		$id = $request->getGet('id');
		$getcate = $model->where('id',$id)->first();
		if($getcate){
			$data = [
				'meta_title' => 'แก้ไขประเภทธุรกิจ',
				'action' => 'savedata',
				'info' => $getcate,
				'cates' => $model->where(['main_type'=>0,'status'=>'1'])->findAll()
			];
			echo view('admin/business-form',$data);
		}else{
			return redirect()->to('admin/business');
		}
	}

	public function savedata()
	{
		$model = new BusinessModel();
		helper('form');
		$request = service('request');
		$post = $request->getPost();
		if($post){
			if($post['hd_id']==""){
				$rules = [
					'txt_name' => [
						'rules' => 'required|is_unique[tbl_business.name_th]',
						'errors' =>  [
							'required' => 'กรุณากรอกชื่อประเภทธุรกิจ (TH)',
							'is_unique' => 'ชื่อประเภทธุรกิจซ้ำกัน'
						]
					]
				];
			}else{
				$rules = [
					'txt_name' => [
						'rules' => 'required',
						'errors' =>  [
							'required' => 'กรุณากรอกชื่อประเภทธุรกิจ (TH)'
						]
					]
				];
			}
			if($this->validate($rules)){
				$result = $model->businessAdd($post);
				if($result){
					return redirect()->to('admin/business');
				}else{
                    $data = [
                        'db_err' => 'มีข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง',
                        'action' => 'savedata'
                    ];
                }
			}else{
				$data = [
					'validation' => $this->validator,
					'action' => 'savedata'
				];
			}
		}else{
			return redirect()->to('admin/business');
		}

        echo view('admin/business-form',$data);
	}
}
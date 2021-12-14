<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\MemberModel;
use App\Models\Account\MemberModel as acMemberModel;

class Member extends Controller
{
	public function __construct()
    {
        
    }
	
	public function index()
	{
		return redirect()->to('admin/member/dealer');
	}

	public function dealer()
	{
		$model = new MemberModel();
		$request = service('request');
		$keyword = $request->getGet('keyword');
		$status = $request->getGet('status');
		$info = [];
		if($keyword!='' || $status!=''){
			$info = $model->select('*,tbl_member.status as approve')->join('tbl_address as B','B.member_id = tbl_member.id')
			->where(['tbl_member.type'=>'dealer','tbl_member.status'=>$status])->like('tbl_member.company',$keyword)->paginate(25);
		}else{
			$info = $model->select('*,tbl_member.status as approve')->join('tbl_address as B','B.member_id = tbl_member.id')
                ->where('tbl_member.type','dealer')->paginate(25);
		}
		$data = [
            'meta_title' => 'สมาชิกเว็บไซต์',
			'info' => $info,
            'pager' => $model->pager,
			'active' => 'dealer'
        ];
		//print_r($info);
		echo view('admin/member',$data);
	}

	public function subscribe()
	{
		$model = new MemberModel();
		$request = service('request');
		
		$keyword = $request->getGet('keyword');
		$status = $request->getGet('status');
		$info = [];
		if($keyword!='' || $status!=''){
			if($status=='2'){
				$status = '1';
			}elseif($status=='1'){
				$status = '';
			}else{
				$status = '0';
			}
			$info = $model->select('*,tbl_member.status as approve')->join('tbl_address as B','B.member_id = tbl_member.id')
			->where(['tbl_member.type'=>'member','tbl_member.status'=>$status])->like('tbl_member.company',$keyword)->paginate(25);
		}else{
			$info = $model->select('*,tbl_member.status as approve')->join('tbl_address as B','B.member_id = tbl_member.id')
                ->where('tbl_member.type','member')->paginate(25);
		}
		$data = [
            'meta_title' => 'สมาชิกเว็บไซต์',
			'info' => $info,
            'pager' => $model->pager,
			'active' => 'member'
        ];
		echo view('admin/member',$data);
	}

	public function form()
	{
		
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }

		helper(['form']);
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM tbl_provinces');
		$results = $query->getResultArray();

		$data = [
            'meta_title' => 'เพิ่มบัญชีสมาชิกเว็บไซต์',
			'action' => 'save',
			'provinces' => $results
        ];
		echo view('admin/member-form',$data);
	}

	public function edit()
    {
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
        
        //include helper form
        helper(['form']);
        $request = service('request');
        $model = new MemberModel();
		$acmbModel = new acMemberModel();
        $id = $request->getGet('id');
        $address = $acmbModel->getAddressById($id);
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'action'    =>  'update',
            'info_member'  =>  $model->where('id',$id)->first(),
			'province' => $acmbModel->getProvinceById($address->province_id),
			'amphure' => $acmbModel->getAmphureById($address->amphure_id),
			'district' => $acmbModel->getDistrictById($address->district_id),
			'address' =>  $address
        ];
        echo view('admin/member-form', $data);
    }

	public function save()
	{
		//print_r($_POST);
		helper(['form']);
		$request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url('admin/member'));
        }
        $img_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
        $data = [
            'meta_title' => 'เพิ่มบัญชีสมาชิกเว็บไซต์',
            'action' => 'save'
        ];
        // $rules = [
        //     'txt_account' => [
        //         'rules' => 'required|valid_email|is_unique[tbl_member.account]',
        //         'errors' =>  [
        //             'required' => 'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
        //             'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
        //             'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
        //         ]
        //     ],
        //     'txt_password' => [
        //         'rules' => 'required|min_length[6]|max_length[200]',
        //         'errors' => [
        //             'required' => 'กรุณากรอกรหัสผ่าน',
        //             'min_length' => 'รหัสผ่านอย่างน้อย 6 ตัวอักษร'
        //         ]
        //     ],
        //     'txt_password_cf' => [
        //         'rules' => 'matches[txt_password]',
        //         'errors' => [
        //             'matches' => 'รหัสผ่านไม่ตรงกัน'
        //         ]
		// 	],
		// 	'txt_name' => [
		// 		'rules' => 'required',
		// 		'errors' => [
		// 			'required' => 'กรุณากรอกชื่อ',
		// 		]
		// 	],
		// 	'txt_lastname' => [
		// 		'rules' => 'required',
		// 		'errors' => [
		// 			'required' => 'กรุณากรอกนามสกุล',
		// 		]
		// 	],
		// 	'txt_phone' => [
		// 		'rules' => 'required',
		// 		'errors' => [
		// 			'required' => 'กรุณากรอกเบอร์โทร',
		// 		]
		// 	]
        // ];
        
        // if($this->validate($rules)){
            $model = new MemberModel();			

            $data = [
                'account' => $request->getVar('txt_account'),
                'password' => password_hash($request->getVar('txt_password'), PASSWORD_DEFAULT),
                'name' => $request->getVar('txt_name'),
                'lastname' => $request->getVar('txt_lastname'),
				'email' => $request->getVar('txt_account'),
                'phone' => $request->getVar('txt_phone'),
				'type' => $request->getVar('rd_type'),
				'dealer_code' => $request->getVar('dealer_code'),
				'renew' => $request->getVar('member_expired'),
				'expired' => $request->getVar('member_expired'),
                'status' => $request->getVar('ddl_status')
            ];
            $model->save($data);
			$id = $model->getInsertID();
			$profile = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
			$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
			$ext = $profile->getExtension();

			if ($profile->isValid() && !$profile->hasMoved() && in_array($ext, $allowed)){
				$this->upload($id,$profile,$img_del);
			}
            return redirect()->to(site_url('admin/member'));
        // }else{
        //     $data['validation'] = $this->validator;
        //     echo view('admin/member-form',$data);
        // }
	}

	public function update()
	{
		helper(['form','filesystem']);
		$model = new MemberModel();
		$request = service('request');

		
        if ($request->getMethod() == 'post') {
			$id = $request->getVar('hd_id');
			$member = $model->where('id',$id)->first();

			$update = [];
			if($member['member_start']==null){
				$update = [
					'type' => $request->getVar('rd_type'),
					'dealer_code' => $request->getVar('dealer_code'),
					'member_start' => $request->getVar('member_start'),
					'member_expired' => $request->getVar('member_expired'),
					'status' => $request->getVar('ddl_status')
				];
				$result = $model->update($id, $update);				
			}else{				
				$update = [
					'type' => $request->getVar('rd_type'),
					'dealer_code' => $request->getVar('dealer_code'),
					'renew' => $request->getVar('member_start'),
					'member_expired' => $request->getVar('member_expired'),
					'status' => $request->getVar('ddl_status')
				];
				$result = $model->update($id, $update);
			}
			if($result){
				return redirect()->to(site_url('admin/member'));
			}else{
				print_r($model->errors());
			}
		}else{
			return redirect()->to(site_url('admin/member'));
        }
	}
	
	public function upload($id,$profile,$img_del)
	{
		helper(['form','fileystem']);
		$model = new MemberModel();
		
		$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
		$ext = $profile->getExtension();

		if ($profile->isValid() && !$profile->hasMoved() && in_array($ext, $allowed)){
			if($img_del){
				unlink($img_del); //ลบรูปเก่าออก
			}
			$newName = $profile->getRandomName();
			if (!is_dir('uploads/member/'.$id)) {
				mkdir('uploads/member/'.$id, 0777, TRUE);
				$profile->move('uploads/member/'.$id,$newName);
			}else{
				$profile->move('uploads/member/'.$id,$newName);
			}
			$thumb = [
				'profile' => 'uploads/member/'.$id.'/'.$newName
			];
			$model->update($id, $thumb);
		}
	}

	public function search()
	{
		// $model = new MemberModel();
		// $request = service('request');
		// $keyword = $request->getGet('keyword');
		// $info = $model->select('*,tbl_member.status as approve')->join('tbl_address as B','B.member_id = tbl_member.id')
        //         ->where('tbl_member.type','dealer')->paginate(25);
		// $data = [
        //     'meta_title' => 'สมาชิกเว็บไซต์',
		// 	'info' => $info,
        //     'pager' => $model->pager,
		// 	'active' => 'dealer'
        // ];
		// //print_r($info);
		// echo view('admin/member',$data);
	}
}

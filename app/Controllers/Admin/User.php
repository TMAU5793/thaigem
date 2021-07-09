<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{
	protected $session;
	public function __construct()
    {
        $this->session = session();
		// $logged_data = [
		// 	'logged_admin'     => TRUE
		// ];
		// $session->set($logged_data);
		//end session login
    }

	public function index()
	{
		$data = [
            'meta_title' => 'ลงชื่อใช้งาน | ระบบจัดการข้อมูล'
        ];
		echo view('admin/login',$data);
	}

	public function login()
    {
        helper(['form']);
        $request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url('admin'));
        }

		$rules = [
            'adminEmail'          => [
                'rules' => 'required|valid_email',
                'errors'    =>  [
                    'required'  =>  'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
                    'valid_email'   =>  'รูปแบบอีเมลไม่ถูกต้อง',
                    'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
                ]
            ],
            'adminPassword'       => [
                'rules' =>  'required|min_length[6]|max_length[200]|validateAdmin[adminEmail,adminPassword]',
                'errors'    =>  [
                    'required'  =>  'กรุณากรอกรหัสผ่าน',
                    'min_length'   =>  'รหัสผ่านอย่างน้อย 6 ตัวอักษร',
					'validateAdmin' => 'รหัสผ่านไม่ถูกต้อง'
                ]
            ]         
        ];
        
        if($this->validate($rules)){
			$model = new UserModel();  
			$admin = $model->where('account', $request->getVar('adminEmail'))->first();
			print_r($admin);
		}else{
			$data['validation'] = $this->validator;
            echo view('admin/login',$data);
		}
    }

	public function logout()
    {
		$this->session->destroy();
		return redirect()->to('admin');
    }

}

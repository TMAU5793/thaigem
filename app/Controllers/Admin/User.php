<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{

	public function index()
	{
        if(session()->get('admindata')){
            return redirect()->to('admin/account');
        }
        helper(['form']);
		$data = [
            'meta_title' => 'ลงชื่อใช้งาน | ระบบจัดการข้อมูล'
        ];
		echo view('admin/login',$data);
	}

	public function login()
    {
        helper(['form']);
        $request = service('request');
        $model = new UserModel();
        if ($request->getMethod() == 'post') {

            $rules = [
                'adminEmail' => [
                    'rules' => 'required|valid_email|checkedEmail[adminEmail]|checkedStatus[adminEmail]',
                    'errors' =>  [
                        'required' => 'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
                        'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                        'checkedEmail' => 'ไม่พบอีเมลผู้ใช้นี้',
                        'checkedStatus' => 'บัญชีผู้ใช้ถูกปิดใช้งาน'
                    ]
                ],
                'adminPassword' => [
                    'rules' => 'required|min_length[6]|max_length[200]|checkedPassword[adminEmail,adminPassword]',
                    'errors' =>  [
                        'required' => 'กรุณากรอกรหัสผ่าน',
                        'min_length' => 'รหัสผ่านอย่างน้อย 6 ตัวอักษร',
                        'checkedPassword' => 'รหัสผ่านไม่ถูกต้อง'
                    ]
                ]
            ];
            
            if($this->validate($rules)){
                $admin = $model->where('account', $request->getVar('adminEmail'))->first();
                $sess = [
                    'id' => $admin['id'],
                    'name' => $admin['name'],
                    'lastname' => $admin['lastname'],
                    'rules' => $admin['rules'],
                    'logged_admin' => TRUE
                ];

                session()->set('admindata',$sess);
                return redirect()->to(site_url('admin/dashboard'));
            }else{
                $data['validation'] = $this->validator;
                echo view('admin/login',$data);
            }
        }else{
            return redirect()->to(site_url('admin'));
        }
    }

	public function logout()
    {
		session()->remove('admindata');
        //session()->destroy();
		return redirect()->to('admin');
    }

}

<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{
	public function index()
	{
        $session = session();
		$logged_data = [
			'logged_admin'     => FALSE
		];
		$session->set($logged_data);
		//end session login

		$data = [
            'meta_title' => 'ลงชื่อใช้งาน | ระบบจัดการข้อมูล'
        ];
		echo view('admin/login',$data);
	}

	public function login()
    {
        
    }

}

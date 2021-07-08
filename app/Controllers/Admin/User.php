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
        
    }

	public function logout()
    {
		$this->session->destroy();
		return redirect()->to('admin');
    }

}

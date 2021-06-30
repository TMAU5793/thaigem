<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
	public function index()
	{
		$session = session();
		$logged_data = [
			'logged_admin'     => TRUE
		];
		$session->set($logged_data);
		//end session login

		$data = [
            'meta_title' => 'ระบบจัดการข้อมูล'
        ];
		echo view('admin/dashboard',$data);
	}
}

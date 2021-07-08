<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
	public function __construct()
    {
        // $session = session();
		// $logged_data = [
		// 	'logged_admin'     => TRUE
		// ];
		// $session->set($logged_data);
		//end session login
    }
	
	public function index()
	{	
		$data = [
            'meta_title' => 'ระบบจัดการข้อมูล'
        ];
		echo view('admin/dashboard',$data);
	}
}

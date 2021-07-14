<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
	public function __construct()
    {
        
    }
	
	public function index()
	{	
		$data = [
            'meta_title' => 'ระบบจัดการข้อมูล'
        ];
		echo view('admin/dashboard',$data);
	}
}

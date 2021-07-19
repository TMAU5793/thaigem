<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Member extends Controller
{
	public function __construct()
    {
        
    }
	
	public function index()
	{	
		$data = [
            'meta_title' => 'สมาชิกเว็บไซต์'
        ];
		echo view('admin/member',$data);
	}
}

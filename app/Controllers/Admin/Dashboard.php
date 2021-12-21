<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
	protected $logged;
	public function __construct()
    {
        $admindata = session()->get('admindata');
        if($admindata){
            $this->logged = $admindata;
        }
    }
	
	public function index()
	{	
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
		
		$data = [
            'meta_title' => 'ระบบจัดการข้อมูล'
        ];
		echo view('admin/dashboard',$data);
	}
}

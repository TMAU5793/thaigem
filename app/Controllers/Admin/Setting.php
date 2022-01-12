<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Setting extends Controller
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
        echo view('admin/setting');
    }
}
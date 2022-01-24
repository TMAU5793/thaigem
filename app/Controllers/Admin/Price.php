<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Price extends Controller
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
        return view('admin/price');
    }
}
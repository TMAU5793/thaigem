<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
	public function index()
	{
		echo view('admin/header');
		echo view('admin/sidemenu');
		echo view('admin/dashboard');
		echo view('admin/footer');
	}
}

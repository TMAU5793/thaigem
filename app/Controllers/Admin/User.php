<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class User extends Controller
{
	public function index()
	{
		echo view('admin/header');
		echo view('admin/login');
		echo view('admin/footer');
	}
}

<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\ProductModel;

class Product extends Controller
{
	public function __construct()
    {
        if (!session()->get('logged_admin')) {
            return redirect()->to('/admin');
        }
    }
	
	public function index()
	{	
      	
	}

	public function category()
	{
		$data = [
            'meta_title' => 'หมวดหมู่สินค้า'
        ];
		echo view('admin/product-category',$data);
	}

	public function categoryform()
	{
		$data = [
            'meta_title' => 'เพิ่มหมวดหมู่สินค้า'
        ];
		echo view('admin/product-categoryform',$data);
	}
}
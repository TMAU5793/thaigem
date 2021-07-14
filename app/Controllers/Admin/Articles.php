<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Articles extends Controller
{
	public function __construct()
    {
        
    }
	
	public function index()
	{	
		$data = [
            'meta_title' => 'บทความ'
        ];
		echo view('admin/article',$data);
	}

    public function form()
    {
        if (!session()->get('logged_admin')) {
            return redirect()->to('/admin');
        }

        helper(['form']);
        $request = service('request');
        $data = [
            'meta_title' => 'เพิ่มบทความ',
            'action'    =>  'save',
        ];
        echo view('admin/article-form', $data);
    }

    public function save()
    {
        helper(['form']);
        $request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url('admin/articles'));
        }

        print_r($request->getPost());
    }
}

<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\WebboardModel;

class Webboard extends Controller
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

        $model = new WebboardModel();
        $data = [
            'meta_title' => 'เว็บบอร์ด',
            'info' => $model->findAll(),
            'pager' => $model->pager,
        ];

        echo view('admin/webboard',$data);
    }
}
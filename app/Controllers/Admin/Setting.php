<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\SettingModel;

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

    public function updateAdvisory()
    {
        $request = service('request');
        $model = new SettingModel();

        $post = $request->getPost();
        if($post){
            $date = date('Y-m-d H:i:s');
            $data = [
                'page' => $post['page'],
                'desc' => $post['subject'],
                'created_at' => $date,
                'updated_at' => $date
            ];
            $page = $model->where('page',$post['page'])->first();
            if($page){
                $db = db_connect();
                $setting = $db->table('tbl_setting');
                $setting->where('page',$post['page']);
                $setting->update($data);
            }else{
                $model->save($data);
            }
            echo true;
        }

        return redirect()->to('admin/articles/advisory');
    }
}
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
        //echo view('admin/setting');
        return redirect()->to('admin/productcategory');
    }

    public function subjectText()
    {
        $request = service('request');
        $model = new SettingModel();

        $page = $request->getGet('p');
        if($page=='advisory'){
            $burl = 'admin/articles/advisory';
        }
        if($page=='director'){
            $burl = 'admin/articles/director';
        }
        $data = [
            'meta_title' => 'อัพเดตหัวข้อเว็บเพจ',
            'page' => $page,
            'info' => $model->where('page',$page)->first(),
            'burl' => $burl
        ];
        return view('admin/subject-text',$data);
    }

    public function updateSubject()
    {
        $request = service('request');
        $model = new SettingModel();

        $post = $request->getPost();
        if($post){
            $date = date('Y-m-d H:i:s');
            $status = ($post['cb_status']=='on'?'1':'0');            
            $page = $model->where('page',$post['hd_page'])->first();
            if($page){
                $db = db_connect();
                $setting = $db->table('tbl_setting');
                $data = [
                    'page' => $post['hd_page'],
                    'desc' => $post['subject_th'],
                    'desc_en' => $post['subject_en'],
                    'status' => $status,
                    'updated_at' => $date
                ];
                $setting->where('page',$post['hd_page']);
                $setting->update($data);
            }else{
                $data = [
                    'page' => $post['hd_page'],
                    'desc' => $post['subject_th'],
                    'desc_en' => $post['subject_en'],
                    'status' => $status,
                    'created_at' => $date,
                    'updated_at' => $date
                ];
                $model->save($data);
            }
            return redirect()->to($post['hd_burl']);
        }

        return redirect()->to('admin/productcategory');
    }
}
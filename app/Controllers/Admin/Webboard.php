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
        $info = $model->select('*, tbl_webboard.status as wb_status, tbl_webboard.id as wb_id')
                ->join('tbl_member','tbl_member.id = tbl_webboard.member_id')
                ->paginate(25);
        $data = [
            'meta_title' => 'เว็บบอร์ด',
            'info' => $info,
            'pager' => $model->pager,
        ];

        echo view('admin/webboard',$data);
    }

    public function info()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        
        $model = new WebboardModel();
        $request = service('request');
        $db = db_connect();
        $reply = $db->table('tbl_webboard_reply');
        $id = $request->getGet('id');

        $info = $model->select('*, tbl_webboard.status as wb_status, tbl_webboard.id as wb_id')
                ->join('tbl_member','tbl_member.id = tbl_webboard.member_id')
                ->where('tbl_webboard.id',$id)
                ->first();
            
        $reply = $reply->select('*, tbl_webboard_reply.status as rp_status, tbl_webboard_reply.id as rp_id')
                ->join('tbl_member','tbl_member.id = tbl_webboard_reply.member_id')
                ->where('tbl_webboard_reply.webboard_id',$id)
                ->get()->getResultArray();
        $data = [
            'meta_title' => $info['topic'],
            'info' => $info,
            'reply' => $reply
        ];
        echo view('admin/webboard-info',$data);
    }

    public function delete()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        
        $request = service('request');
        $model = new WebboardModel();
        if($request->getPost('id')){
			$id = $request->getPost('id');
            $deleted = $model->where('id', $id)->delete($id);
            if($deleted){
                $db = db_connect();
                $reply = $db->table('tbl_webboard_reply');
                $reply->where('webboard_id',$id);
                $reply->delete();
            }
			echo TRUE;            
        }else{
            return redirect()->to(site_url('admin/articles'));
        }
    }
}
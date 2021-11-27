<?php

namespace App\Controllers;
use App\Models\WebboardModel;
use App\Models\WebboardReplyModel;
use App\Models\MemberModel;
use App\Models\ProvinceModel;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\BusinessModel;
use App\Models\Account\MemberModel as MemberFunctionModel;

class Community extends BaseController
{
    protected $member_id;
    protected $userdata;
    protected $lang;
    public function __construct()
    {
        $sess = session()->get('userdata');
        if($sess){
            $this->userdata = $sess;
            $this->member_id = $sess['id'];
        }

        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }
    }

	public function index()
	{   
        helper('text');
        $model = new WebboardModel();
        $mbModel = new MemberModel();
        $data = [
            'meta_title' => 'Community',
            'info' => $model->where('status','1')->orderby('created_at','DESC')->paginate(9),
            'pager' => $model->pager,
            'member' => $mbModel->findAll(),
            'userdata' => $this->userdata
        ];
        //print_r($data['member']);
        echo view('front/community', $data);
	}

    public function post()
    {
        $uri = service('uri');
        $segment3 = $uri->getSegment(3);
        $rpmodel = new WebboardReplyModel();
        $wbModel = new WebboardModel();
        $mbModel = new MemberModel();
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();
        $pvModel = new ProvinceModel();
        $mbFunction = new MemberFunctionModel();

        $webboard = $wbModel->where('id',$segment3)->first();
        if($webboard){
            $member = $mbModel->where('id',$webboard['member_id'])->first();
            $category = $cateModel->where('id',$member['product_type'])->first();
            $business = $bnModel->where('id',$member['business_type'])->first();
            $address = $mbFunction->getAddressById($webboard['member_id']);
            $data = [
                'lang' => $this->lang,
                'meta_title' => $webboard['topic'],
                'webboard' => $webboard,
                'member' => $member,
                'users' => $member = $mbModel->findAll(),
                'category' => $category,
                'business' => $business,
                'province' => $pvModel->where('code',$member['province'])->first(),
                'reply' => $rpmodel->where(['webboard_id'=>$segment3,'status'=>'1'])->findAll(),
                'replyhide' => $rpmodel->where(['webboard_id'=>$segment3,'status'=>'0'])->findAll(),
                'province' => $mbFunction->getProvinceById($address->province_id)
            ];
            $sql = "UPDATE tbl_webboard SET view=view+1 WHERE id = '$segment3'";
            $wbModel->query($sql);
            
            echo view('front/community-desc', $data);
        }else{
            return redirect()->to('community');
        }
    }

    public function reply()
    {
        $model = new WebboardReplyModel();
        $wbModel = new WebboardModel();
        $request = service('request');
        $post = $request->getPost();
        
        if($post['hd_member']){
            $data = [
                'member_id' => $post['hd_member'],
                'webboard_id' => $post['hd_webboard'],
                'reply' => $post['txt_reply']                
            ];
            $qurey = $model->insert($data);
            if($qurey){
                $id = $post['hd_webboard'];
                $sql = "UPDATE tbl_webboard SET reply=reply+1 WHERE id = '$id'";
                $wbModel->query($sql);
                return redirect()->to($post['hd_burl']);
            }
        }else{
            return redirect()->to('community');
        }
    }

    public function delete()
    {
        $request = service('request');
        $post = $request->getPost();
        $model = new WebboardReplyModel();
        $wbModel = new WebboardModel();

        if($post){            
            $id = $request->getPost('id');
            $deleted = $model->where('id', $id)->delete($id);
            if($deleted){
                $sql = "UPDATE tbl_webboard SET reply=reply-1 WHERE id = '$id'";
                $wbModel->query($sql);
                echo true;
            }
        }
    }

    public function hideReply()
    {
        $request = service('request');
        $post = $request->getPost();
        $model = new WebboardReplyModel();

        if($post){
            $id = $request->getPost('id');
            $status = $request->getPost('status');
            $sql = "UPDATE tbl_webboard_reply SET status='$status' WHERE id = '$id'";
            if($model->query($sql)){
                echo true;
            }
        }
    }

    public function search()
    {
        helper('text');
        $request = service('request');
        $wbModel = new WebboardModel();
        $mbModel = new MemberModel();
        $get = $request->getGet();

        if($get && $get['txt_keyword']!=""){
            $keyword = $get['txt_keyword'];
            $result = $wbModel->like('topic',$keyword)->where('status','1')->findAll();
            
            $data = [
                'meta_title' => 'Community',
                'info' => $result,
                'member' => $mbModel->findAll(),
                'keyword' => $keyword
            ];
            //print_r($result);
            echo view('front/community', $data);
        }else{
            return redirect()->to('community');
        }
    }
}

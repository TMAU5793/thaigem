<?php

namespace App\Controllers;
use App\Models\WebboardModel;
use App\Models\MemberModel;

class Community extends BaseController
{
	public function index()
	{   
        helper('text');
        $model = new WebboardModel();
        $mbModel = new MemberModel();
        $data = [
            'meta_title' => 'Community',
            'info' => $model->where('status','1')->findAll(),
            'member' => $mbModel->findAll()
        ];
        //print_r($data['member']);
        echo view('front/community', $data);
	}

    public function post()
    {
        $uri = service('uri');
        $segment3 = $uri->getSegment(3);
        $wbModel = new WebboardModel();
        
        $data = [
            'meta_title' => 'Community title'
        ];
        
        echo view('front/community-desc', $data);
    }
}

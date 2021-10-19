<?php

namespace App\Controllers;

class About extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'About US'
        ];
        
        echo view('front/about', $data);
	}

    public function story()
    {
        $data = [
            'meta_title' => 'ประวัติสมาคมผู้ค้าอัญมณีไทยและเครื่องประดับ'
        ];
        
        echo view('front/about', $data);
    }

    public function condition()
    {
        $data = [
            'meta_title' => 'ข้อบังคับสมาคมผู้ค้าอัญมณีไทยและเครื่องประดับ'
        ];
        
        echo view('front/about', $data);
    }

    public function advisor()
    {
        $data = [
            'meta_title' => 'รายนามที่ปรึกษาสมาคมฯ'
        ];
        
        echo view('front/about', $data);
    }

    public function policy()
    {
        $data = [
            'meta_title' => 'นโยบายนายกสมาคม 62-64'
        ];
        
        echo view('front/about', $data);
    }

    public function benefit()
    {
        $data = [
            'meta_title' => 'สิทธิประโยชน์การเป็นสมาชิกสมาคมผู้ค้าอัญมณีไทยและเครื่องประดับ'
        ];
        
        echo view('front/about', $data);
    }
}

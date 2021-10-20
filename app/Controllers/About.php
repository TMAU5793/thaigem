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

    public function history()
    {
        $data = [
            'meta_title' => 'ประวัติสมาคมผู้ค้าอัญมณีไทยและเครื่องประดับ'
        ];
        
        echo view('template/information', $data);
    }

    public function regulation()
    {
        $data = [
            'meta_title' => 'ข้อบังคับสมาคมผู้ค้าอัญมณีไทยและเครื่องประดับ'
        ];
        
        echo view('template/information', $data);
    }

    public function advisory()
    {
        $data = [
            'meta_title' => 'รายนามที่ปรึกษาสมาคมฯ'
        ];
        
        echo view('template/information', $data);
    }

    public function policy()
    {
        $data = [
            'meta_title' => 'นโยบายนายกสมาคม 62-64'
        ];
        
        echo view('template/information', $data);
    }    

    public function directors()
    {
        $data = [
            'meta_title' => 'รายนามคณะกรรมการสมาคมฯ วาระ 2562-2564'
        ];
        
        echo view('template/information', $data);
    }
}

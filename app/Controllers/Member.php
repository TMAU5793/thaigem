<?php

namespace App\Controllers;

class Member extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'Member'
        ];
        
        echo view('front/member', $data);
	}

    public function desc()
    {
        $data = [
            'meta_title' => 'Member Title',
            'meta_desc' => 'Member Description'
        ];
        
        echo view('front/member-desc', $data);
    }
}

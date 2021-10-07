<?php

namespace App\Controllers;

class Community extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'Community'
        ];
        
        echo view('front/community', $data);
	}

    public function desc()
    {
        $data = [
            'meta_title' => 'Community title'
        ];
        
        echo view('front/community-desc', $data);
    }
}

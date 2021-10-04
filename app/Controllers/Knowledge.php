<?php

namespace App\Controllers;

class Knowledge extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'Knowledge'
        ];
        
        echo view('front/knowledge', $data);
	}

    public function desc()
    {
        $data = [
            'meta_title' => 'Knowledge Title',
            'meta_desc' => 'Knowledge Description'
        ];
        
        echo view('front/knowledge-desc', $data);
    }
}

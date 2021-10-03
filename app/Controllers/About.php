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
}

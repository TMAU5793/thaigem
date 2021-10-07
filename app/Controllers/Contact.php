<?php

namespace App\Controllers;

class Contact extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'Contact US'
        ];
        
        echo view('front/contact', $data);
	}
}

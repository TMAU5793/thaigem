<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'Thai Gem and Jewelry Traders Association'
        ];
        
        echo view('front/home', $data);
	}
}

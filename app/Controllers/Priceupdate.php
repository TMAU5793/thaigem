<?php

namespace App\Controllers;

class Priceupdate extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'Price update'
        ];
        
        echo view('front/price-update', $data);
	}
}

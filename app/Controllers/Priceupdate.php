<?php

namespace App\Controllers;

class Priceupdate extends BaseController
{
    protected $lang;
    public function __construct() {

        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }
    }

	public function index()
	{        
        $data = [
            'meta_title' => 'Price update',
            'lang' => $this->lang,
        ];
        
        echo view('front/price-update', $data);
	}
}

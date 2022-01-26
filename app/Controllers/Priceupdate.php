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
        $db = db_connect();
        $tbl_price = $db->table('tbl_price');

        $data = [
            'meta_title' => 'Price update',
            'lang' => $this->lang,
            'price' => $tbl_price->where('status','1')->get()->getResultArray()
        ];
        
        echo view('front/price-update', $data);
	}
}

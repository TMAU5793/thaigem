<?php

namespace App\Controllers;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\EventModel;
use App\Models\MemberModel;
use App\Models\Account\AlbumModel;

class Home extends BaseController
{
    protected $lang;
    public function __construct() {
        $this->lang = session()->get('lang');
        if($this->lang==""){
            $this->lang = 'en';
        }
    }

	public function index()
	{        
        helper('text');
        $ctModel = new ProductCategoryModel();
        $evModel = new EventModel();
        $mbModel = new MemberModel();
        $abModel = new AlbumModel();
        $data = [
            'meta_title' => 'Thai Gem and Jewelry Traders Association',
            'lang' => $this->lang,
            'catergory' => $ctModel->where(['maincate_id'=>'0','status'=>'1'])->findAll(),
            'events' => $evModel->where(['home_show'=>'on','status'=>'on'])->findAll(),
            'dealers' => $mbModel->where(['type'=>'dealer','status'=>'2'])->findAll(),
            'albums' => $abModel->findAll()
        ];
        
        echo view('front/home', $data);
	}
}

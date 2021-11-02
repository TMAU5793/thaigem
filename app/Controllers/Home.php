<?php

namespace App\Controllers;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\EventModel;
use App\Models\MemberModel;
use App\Models\Account\AlbumModel;
use App\Models\BookingModel;
use App\Models\KnowledgeModel;

class Home extends BaseController
{
    protected $lang;
    protected $member_id;
    protected $userdata;
    public function __construct() {        
        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }

        $usersess = session()->get('userdata');
        if($usersess){
            $this->userdata = $usersess;
            $this->member_id = $usersess['id'];
        }
    }

	public function index()
	{        
        helper('text');
        $ctModel = new ProductCategoryModel();
        $evModel = new EventModel();
        $mbModel = new MemberModel();
        $abModel = new AlbumModel();
        $bkModel = new BookingModel();
        $acModel= new KnowledgeModel();

        $data = [
            'meta_title' => 'Thai Gem and Jewelry Traders Association',
            'lang' => $this->lang,
            'catergory' => $ctModel->where(['maincate_id'=>'0','status'=>'1'])->findAll(6),
            'events' => $evModel->where(['home_show'=>'on','status'=>'on'])->findAll(),
            'dealers' => $mbModel->where(['type'=>'dealer','status'=>'2'])->findAll(),
            'albums' => $abModel->findAll(),
            'member' => $mbModel->where('id',$this->member_id)->first(),
            'articles' => $acModel->where('status','on')->orderby('created_at','DESC')->findAll(3)
        ];
        
        
        echo view('front/home', $data);
	}
}

<?php

namespace App\Controllers;
use App\Models\BannerModel;

class Policy extends BaseController
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
		$bannerModel = new BannerModel();
        $banner = $bannerModel->where('page','about')->first();
		$data = [
			'banner' => $banner
		];

        return view('template/policy',$data);
	}

    public function cookie()
    {
        $cookie_name = "policy";
        $cookie_value = "popup";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        return TRUE;
    }
}

<?php

namespace App\Controllers;

class Thaigem extends BaseController
{
	public function heplCenter()
	{        
        $data = [
            'meta_title' => 'Help center'
        ];
        
        echo view('front/help-center', $data);
	}

    public function privacy()
	{        
        $data = [
            'meta_title' => 'Privacy Policy'
        ];
        
        echo view('front/help-center', $data);
	}

    public function terms()
	{        
        $data = [
            'meta_title' => 'Terms Of Services'
        ];
        
        echo view('front/help-center', $data);
	}

    public function checkedSess()
    {
        $sess = session()->get('userdata');
        if($sess){
            return true;
        }else{
            return redirect()->to('');
        }
    }

}

<?php

namespace App\Controllers;
use App\Models\NewsletterModel;

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

    public function newsLetter()
    {
        $request = service('request');
        $model = new NewsletterModel();
        $post = $request->getPost();
        
        if($post){
            $rules = [
                'news_email' => [
                    'rules' => 'required|valid_email|is_unique[tbl_newsletter.email]',
                    'errors'    =>  [
                        'required'  =>  'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
                        'valid_email'   =>  'รูปแบบอีเมลไม่ถูกต้อง',
                        'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
                    ]
                ]
            ];
            
            if($this->validate($rules)){
                $ckd = $model->where('email',$post['news_email'])->first();
                if(!$ckd){
                    $data = [
                        'email' => $post['news_email'],
                    ];
                    $model->save($data);
                }
                return redirect()->to('')->with('msg_newsletter',TRUE);
            }else{
                $data['errors_newsleeter'] = $this->validator;
                echo view('front/home',$data);
            }
        }else{
            return redirect()->to('');
        }
    }

}

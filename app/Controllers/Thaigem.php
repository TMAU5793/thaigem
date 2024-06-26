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

    public function mailContact()
    {
        $email = \Config\Services::email();
        $request = service('request');
        $postdata = $request->getPost();
        //print_r($postdata);
        if($postdata && $postdata['txt_email']!=""){
            $mailTo = 'info@thaigemjewelry.org';
            // $mailCC = 'jan@grasp.asia';
            // $mailBCC = 'thip@grasp.asia';

            $email->setFrom($postdata['txt_email'], $postdata['txt_name']);
            $email->setTo($mailTo);
            // $email->setCC($mailCC);
            // $email->setBCC($mailBCC);
            if($this->lang=='en'){
                $email->setSubject('Contact form '.$postdata['txt_email']);
                $msg = "<strong>Contact form ".$postdata['txt_email']."</strong>";
                $msg .= "<p>Name : ".$postdata['txt_name']."</p>";
                $msg .= "<p>Phone : ".$postdata['txt_phone']."</p>";
                $msg .= "<p>".$postdata['txt_message']."</p>";
            }else{
                $email->setSubject('ติดต่อจาก '.$postdata['txt_email']);
                $msg = "<strong>ติดต่อจาก ".$postdata['txt_email']."</strong>";
                $msg .= "<p>ชื่อ : ".$postdata['txt_name']."</p>";
                $msg .= "<p>เบอร์โทร : ".$postdata['txt_phone']."</p>";
                $msg .= "<p>".$postdata['txt_message']."</p>";
            }
            $email->setMessage($msg);
            //echo $msg;
            if($email->send()){
                return redirect()->to('')->with('msg_done','true');
            }else{
                $email->printDebugger();
            }
        }else{
            return redirect()->to('');
        }
    }

    public function testMail()
    {
        $email = \Config\Services::email();
        $request = service('request');
        $mailTo = 'thip@grasp.asia';

        $email->setFrom('thip@grasp.asia', 'thip@grasp.asia');
        $email->setTo($mailTo);
        // $email->setCC($mailCC);
        // $email->setBCC($mailBCC);
        $email->setSubject('Test Mail');
        $email->setMessage('Test Mail');
        //echo $msg;
        if($email->send()){
            //return redirect()->to('')->with('msg_done','true');
        }else{
            $email->printDebugger();
        }
    }

}

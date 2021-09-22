<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\AccountModel;
  
class Account extends Controller
{   
    public function __construct()
    {
        $sess_account = [
            'logged_member' => TRUE
        ];

        //session()->set($sess_account);
    }
    
    public function index()
    {   
        $data = [
            'ac_account' => TRUE
        ];
        
        echo view('account/ac-account',$data);
    }

    public function register()
    {
        helper(['form']);
        $validation =  \Config\Services::validation();
        $model = new AccountModel();
        $request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url());
        }
        
        $signup_valid = [
            'txt_username' => [
                'rules' => 'required|valid_email|is_unique[tbl_member.account]',
                'errors'    =>  [
                  'required'  =>  'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
                  'valid_email'   =>  'รูปแบบอีเมลไม่ถูกต้อง',
                  'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
                ]
            ],
            'txt_name' => [
                'rules' => 'required',
                'errors'    =>  [
                  'required'  =>  'กรุณากรอกชื่อ'
                ]
            ],
            'txt_password'       => [
                'rules' =>  'required|min_length[6]|max_length[200]',
                'errors'    =>  [
                  'required'  =>  'กรุณากรอกรหัสผ่าน',
                  'min_length'   =>  'รหัสผ่านอย่างน้อย 6 ตัวอักษร'
                ]
            ],
            'txt_confirm_password'    => [
                'rules' =>  'matches[txt_password]',
                'errors'    =>  [
                  'matches'  =>  'รหัสผ่านไม่ตรงกัน'
                ]
            ],
            'cb_term'    => [
                'rules' =>  'required',
                'errors'    =>  [
                  'required'  =>  'กดยอมรับเงื่อนไข สำหรับการลงทะเบียน'
                ]
            ]
        ];

		if($this->validate($signup_valid)){
            $result = $model->register($request->getPost());
            //print_r($result);
        }else{
            $data['signup_valid'] = $this->validator;
            echo view('front/home',$data);
        }
    }    
}
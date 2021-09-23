<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\AccountModel;
  
class Account extends Controller
{   
    public function __construct()
    {
        
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
        $model = new AccountModel();
        $request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url());
        }
        if(session()->get('logged_member')){
            return redirect()->to('account');
        }
        //print_r($request->getPost());

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
            if($result){
                echo $result;
                $member = $model->where('id', $result)->first();
                $sess = [
                    'id' => $member['id'],
                    'account' => $member['account'],
                    'name' => $member['name'],
                    'lastname' => $member['lastname'],
                    'email' => $member['email'],
                    'logged_member' => TRUE
                ];

                session()->set($sess);
                return redirect()->to(site_url('account'));
            }
        }else{
            $data['signup_valid'] = $this->validator;
            echo view('front/home',$data);
        }
    }

    public function login()
    {
        helper(['form']);
        $model = new AccountModel();
        $request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url());
        }

        if(session()->get('logged_member')){
            return redirect()->to('account');
        }

        $rules = [
            'txt_username' => [
                'rules' => 'required|valid_email|memberAccount[txt_username]|memberStatus[txt_username]',
                'errors' =>  [
                    'required' => 'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
                    'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                    'memberAccount' => 'ไม่พบบัญชีผู้ใช้นี้',
                    'memberStatus' => 'บัญชีผู้ใช้ถูกปิดใช้งาน'
                ]
            ],
            'txt_password' => [
                'rules' => 'required|min_length[6]|max_length[200]|memberPassword[txt_username,txt_password]',
                'errors' =>  [
                    'required' => 'กรุณากรอกรหัสผ่าน',
                    'min_length' => 'รหัสผ่านอย่างน้อย 6 ตัวอักษร',
                    'memberPassword' => 'รหัสผ่านไม่ถูกต้อง'
                ]
            ]
        ];

        if($this->validate($rules)){
            $member = $model->where('account', $request->getVar('txt_username'))->first();
            $sess = [
                'id' => $member['id'],
                'account' => $member['account'],
                'name' => $member['name'],
                'lastname' => $member['lastname'],
                'email' => $member['email'],
                'logged_member' => TRUE
            ];

            session()->set($sess);
            return redirect()->to(site_url('account'));
        }else{
            $data['signin_valid'] = $this->validator;
            echo view('front/home',$data);
        }
    }

    public function logout()
    {
        $sess = [
            'id' => '',
            'account' => '',
            'name' => '',
            'lastname' => '',
            'email' => '',
            'logged_member' => FALSE
        ];

        session()->set($sess);
		return redirect()->to('');
    }
}
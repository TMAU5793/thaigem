<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\AccountModel;
use App\Models\Account\MemberModel;
use CodeIgniter\I18n\Time;
  
class Account extends Controller
{   
    public function __construct()
    {
        
    }
    
    public function index()
    {   
        $model = new AccountModel();
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
        if(session()->get('userdata')['logged_member']){
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

                session()->set('userdata',$sess);
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

        if(session()->get('userdata')){
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
            $model
                ->where('account', $member['account'])
                ->set('last_login' , new Time('now'))
                ->update();
            session()->set('userdata',$sess);
            return redirect()->to(site_url('account'));
        }else{
            $data['signin_valid'] = $this->validator;
            echo view('front/home',$data);
        }
    }

    public function loginFacebook()
    {
        $request = service('request');
        $model = new AccountModel();

        $post = $request->getPost();
        if(!$post){
            return redirect()->to('');
        }
        
        $account = $model->where('account', $post['id'])->first();
        
        if(!$account){
            $formdata = [
                'account' => $post['id'],
                'name' => $post['name'],
                'email' => $post['email'],
                'type' => 'facebook'
            ];
            $result = $model->socialSignin($formdata);
            if($result){
                $arrdata = [
                    'id' => $result,
                    'account' => $post['id'],
                    'name' => $post['name'],
                    'email' => $post['email'],
                    'type' => 'facebook',
                    'logged_member' => TRUE
                ];
                session()->set('userdata',$arrdata);
                echo true;
            }
        }else{
            $arrdata = [
                'id' => $account['id'],
                'account' => $post['id'],
                'name' => $post['name'],
                'email' => $post['email'],
                'type' => 'facebook',
                'logged_member' => TRUE
            ];
            $model
                ->where('account', $post['id'])
                ->set('last_login' , new Time('now'))
                ->update();
            session()->set('userdata',$arrdata);
            echo true;
        }
    }

    public function loginGoogle()
    {
        $model = new AccountModel();
        require_once APPPATH.'Libraries/vendor/autoload.php';

        // init configuration
        $clientID = '685479072452-0opq35kbticpb9otft4om75sfn9eega8.apps.googleusercontent.com';
        $clientSecret = 'U6pS4afPkv9GC_Ip2uxtbd39';
        $redirectUri = site_url('logingoogle');

        // create Client Request to access Google API
        $client = new \Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        // authenticate code from Google OAuth Flow
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            
            // get profile info
            $google_oauth = new \Google_Service_Oauth2($client);
            $userdata = $google_oauth->userinfo->get();
            
            $account = $model->where('account', $userdata->id)->first();
            if(!$account){
                $formdata = [
                    'account' => $userdata->id,
                    'name' => $userdata->name,
                    'email' => $userdata->email,
                    'profile_pic' => $userdata->picture,
                    'type' => 'google',
                ];
                $result = $model->socialSignin($formdata);
                if($result){
                    $arrdata = [
                        'id' => $result,
                        'account' => $userdata->id,
                        'name' => $userdata->name,
                        'email' => $userdata->email,
                        'profile_pic' => $userdata->picture,
                        'type' => 'google',
                        'logged_member' => TRUE
                    ];
                    session()->set('userdata',$arrdata);
                    return redirect()->to(site_url('account'));
                }
            }else{
                $arrdata = [
                    'id' => $account['id'],
                    'account' => $userdata->id,
                    'name' => $userdata->name,
                    'email' => $userdata->email,
                    'profile_pic' => $userdata->picture,
                    'type' => 'google',
                    'logged_member' => TRUE
                ];
                $model
                    ->where('account', $userdata->id)
                    ->set('last_login' , new Time('now'))
                    ->update();
                session()->set('userdata',$arrdata);
                return redirect()->to(site_url('account'));
            }
            
        }else{
            return redirect()->to($client->createAuthUrl());
        }
    }

    public function logout()
    {
        session()->remove('userdata');
		return redirect()->to('');
    }
}
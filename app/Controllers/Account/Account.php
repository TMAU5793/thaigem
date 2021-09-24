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

            session()->set('userdata',$sess);
            return redirect()->to(site_url('account'));
        }else{
            $data['signin_valid'] = $this->validator;
            echo view('front/home',$data);
        }
    }

    public function loginFacebook()
    {
        // $request = service('request');
        // $data = [];
        // require_once APPPATH.'Libraries/vendor/autoload.php';
        // $facebook = new \Facebook\Facebook([
        //     'app_id' => '367105081821305',
        //     'app_secret' => '788cad6087512fb28a8fdfad62dcbca3',
        //     'default_graph_version' => 'v12.0'
        // ]);
        // $fb_helper = $facebook->getRedirectLoginHelper();
        // if($request->getVar('state')){
        //     $fb_helper->getPersistentDataHandler()->set('state',$request->getVar('state'));
        // }
        // if($request->getVar('code')){
        //     if(session()->get('access_token')){
        //         $access_token = session()->get('access_token');
        //     }else{
        //         $access_token = $fb_helper->getAccessToken();
        //         session()->set('access_token',$access_token);
        //         $facebook->setDefaultAccessToken(session()->get('access_token'));
        //     }
        //     $graph_response = $facebook->get('/me?fields=name,email',$access_token);
        //     $fb_user_info = $graph_response->getGraphUser();

        //     if(!empty($fb_user_info['id'])){
        //         $fbdata = [
        //             'profile_pic' => 'http://graph.facebook.com/'.$fb_user_info['id'].'/picture',
        //             'user_name' => $fb_user_info['name'],
        //             'email' => $fb_user_info['email'],
        //             'userid' => $fb_user_info['id'],
        //             'logged_member' => TRUE
        //         ];

        //         session()->set('userdata',$fbdata);

        //         print_r(session()->get('userdata'));
        //     }
        // }else{
        //     //return redirect()->to('');
        //     print_r(session()->get('userdata'));
        // }
        //echo 'Login Facebook';
        echo view('account/ac-login');
    }

    public function loginGoogle()
    {
        $request = service('request');
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
            $email =  $userdata->email;
            $name =  $userdata->name;
            print_r($userdata);
        
            // now you can use this profile info to create account in your website and make user logged in.
        } else {
            echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
        }
    }

    public function logout()
    {
        session()->remove('userdata');
		return redirect()->to('');
    }
}
<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\AccountModel;
use App\Models\Account\AlbumModel;
use App\Models\Account\MemberModel;
use App\Models\FunctionModel;
use CodeIgniter\I18n\Time;
  
class Account extends Controller
{   
    protected $member_id;
    protected $udata;
    protected $lang;
    public function __construct()
    {
        helper(['form','text']);
        $sess = session()->get('userdata');
        if($sess){
            $this->udata = $sess;
            $this->member_id = $sess['id'];
        }

        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }
    }
    
    public function index()
    {   
        if($this->member_id!="" && $this->udata['user_type']=='dealer'){
            $model = new AccountModel();
            $albummodel = new AlbumModel();
            $mbModel = new MemberModel();
            $info = $model->join('tbl_member_business as B','B.member_id = tbl_member.id')
                        ->where('tbl_member.id',$this->member_id)->first();
            if(!$info){
                $info = $model->where('id',$this->member_id)->first();
            }
            $data = [
                'ac_account' => TRUE,
                'lang' => $this->lang,
                'info' => $info,
                'album' => $albummodel->where('member_id',$this->member_id)->findAll(),
                'address' => $mbModel->getAddress(),
                'province' => $mbModel->getProvince(),
                'amphure' => $mbModel->getAmphure(),
                'district' => $mbModel->getDistrict(),
                'social' => $mbModel->getSocial(),
                'membercontact' => $mbModel->getMemberContact(),
                'memberbusiness' => $mbModel->getMemberBusiness()
            ];
            // print_r($model->error());
            // print_r($info);
            echo view('account/ac-account',$data);
        }else{
            return redirect()->to('');
        }
    }
    
    public function register()
    {
        
        helper(['form']);
        $model = new AccountModel();
        $mbModel = new MemberModel();
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
                $member = $model->where('id', $result)->first();
                $mbModel->notiDealer($member);
                $this->emailRegister($member['account']);
                $sess = [
                    'id' => $member['id'],
                    'code' => $member['code'],
                    'account' => $member['account'],
                    'name' => $member['name'],
                    'lastname' => $member['lastname'],
                    'email' => $member['email'],
                    'user_type' => $member['type'],
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

    public function emailRegister($account=null)
    {
        $email = \Config\Services::email();
                
        $email->setFrom('info@thaigemjewelry.org', 'Thai gem and jewelry');
        $email->setTo($account);                
        $email->setSubject(($this->lang=='en'?'Register account complete':'การสมัครสมาชิกเรียบร้อย'));
        $msg = "<p>ท่านได้ทำการสร้างบัญชีสำหรับใช้งานเว็บไซต์สมาคมอัญมณีเรียบร้อยแล้ว ชื่อบัญชี : ".$account."</p>";
        $msg .= "สามารถเข้าใช้งานได้ที่ <a href=\"".site_url()."\">".lang('GlobalLang.website')."</a>";
        $email->setMessage($msg);
        //echo $msg;
        if($email->send()){
            return true;
        }else{
            $email->printDebugger();
        }
    }

    public function login()
    {
        //helper(['form','text']);
        $model = new AccountModel();
        $request = service('request');
        if (!$request->getPost()) {
            return redirect()->to(site_url());
        }

        if(session()->get('userdata')){
            return redirect()->to('account');
        }

        $rules = [
            'txt_username' => [
                'rules' => 'required|memberAccount[txt_username]|memberStatus[txt_username]',
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
            if($member['code']==''){
                $str_rand = random_string('alnum', 11);
                $model
                    ->where('account', $member['account'])
                    ->set('code' , $str_rand)
                    ->update();
            }
            $sess = [
                'id' => $member['id'],
                'code' => ($member['code']==''?$str_rand:$member['code']),
                'account' => $member['account'],
                'name' => $member['name'],
                'lastname' => $member['lastname'],
                'email' => $member['email'],
                'user_type' => $member['type'],
                'logged_member' => TRUE
            ];
            $model
                ->where('account', $member['account'])
                ->set('last_login' , new Time('now'))
                ->update();
            session()->set('userdata',$sess);
            return redirect()->to('account');
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
        $str_rand = random_string('alnum', 11);

        if(!$account){
            $formdata = [
                'code' => $str_rand,
                'account' => $post['id'],                
                'name' => $post['name'],
                'email' => $post['email'],
                'type' => 'facebook'
            ];
            $result = $model->socialSignin($formdata);
            if($result){
                $arrdata = [
                    'id' => $result,
                    'code' => $str_rand,
                    'account' => $post['id'],
                    'name' => $post['name'],
                    'email' => $post['email'],
                    'type' => 'facebook',
                    'user_type' => 'member',
                    'logged_member' => TRUE
                ];
                session()->set('userdata',$arrdata);
                echo true;
            }
        }else{
            if($account['code']==''){
                $model
                    ->where('account', $post['id'])
                    ->set('code' , $str_rand)
                    ->update();
            }
            $arrdata = [
                'id' => $account['id'],
                'code' => ($account['code']==''? $str_rand: $account['code']),
                'account' => $post['id'],
                'name' => $post['name'],
                'email' => $post['email'],
                'type' => 'facebook',
                'user_type' => 'member',
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
            $str_rand = random_string('alnum', 11);

            if(!$account){
                $formdata = [
                    'code' => $str_rand,
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
                        'code' => $str_rand,
                        'account' => $userdata->id,
                        'name' => $userdata->name,
                        'email' => $userdata->email,
                        'profile_pic' => $userdata->picture,
                        'type' => 'google',
                        'user_type' => 'member',
                        'logged_member' => TRUE
                    ];
                    session()->set('userdata',$arrdata);
                    return redirect()->to(site_url('account'));
                }
            }else{
                if($account['code']==''){
                    $model
                        ->where('account', $post['id'])
                        ->set('code' , $str_rand)
                        ->update();
                }
                $arrdata = [
                    'id' => $account['id'],
                    'code' => ($account['code']==''? $str_rand: $account['code']),
                    'account' => $userdata->id,
                    'name' => $userdata->name,
                    'email' => $userdata->email,
                    'profile_pic' => $userdata->picture,
                    'type' => 'google',
                    'user_type' => 'member',
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

    public function updateNoti()
    {
        $memberFucntion = new MemberModel();
        $request = service('request');
        $member = $request->getPost('id');
        if($member){
            $memberFucntion->updateNoti($member);
            echo true;
        }
    }

    public function logout()
    {
        session()->remove('userdata');
		return redirect()->to('');
    }
}
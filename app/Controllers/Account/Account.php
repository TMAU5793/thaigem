<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\AccountModel;
use App\Models\Account\AlbumModel;
use App\Models\Account\MemberModel;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\EventModel;
use App\Models\MemberModel as MemberModel2;
use App\Models\BookingModel;
use App\Models\KnowledgeModel;
use App\Models\MemberBusinessModel;
use App\Models\BannerModel;

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
        if($this->member_id!=""){
            $model = new AccountModel();
            $albummodel = new AlbumModel();
            $mbModel = new MemberModel();
                        
            $info = $model->select('*, tbl_member.id as m_id, tbl_member.dealer_code as m_code, tbl_member.status as m_status')
                        ->join('tbl_member_business','tbl_member.id = tbl_member_business.member_id')
                        ->where('tbl_member.id',$this->member_id)->first();
            if(!$info){
                $info = $model->select('*, tbl_member.id as m_id, tbl_member.dealer_code as m_code, tbl_member.status as m_status')->where('id',$this->member_id)->first();
            }
            $dealer_code = $info['m_code'];
            if($dealer_code==''){
                $dealer_code = $info['m_id'];
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
                'membercontact' => $mbModel->getMemberContactById($info['m_id']),
                'memberbusiness' => $mbModel->getMemberBusiness(),
                'shareImg' => $info['profile'],
                'terms' => $info['terms']
            ];
            // print_r('<pre>');
            // print_r($info);
            // print_r('</pre>');
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
                'required'  =>  lang('validateLang.account-email'),
                'valid_email'   =>  lang('validateLang.email-format'),
                'is_unique' => lang('validateLang.email-used')
                ]
            ],
            'txt_company' => [
                'rules' => 'required',
                'errors'    =>  [
                'required'  =>  lang('validateLang.valid-company')
                ]
            ],
            'txt_name' => [
                'rules' => 'required',
                'errors'    =>  [
                'required'  =>  lang('validateLang.enter-name')
                ]
            ],
            'txt_password'       => [
                'rules' =>  'required|min_length[6]|max_length[200]',
                'errors'    =>  [
                'required'  =>  lang('validateLang.enter-pwd'),
                'min_length'   =>  lang('validateLang.pwd-character')
                ]
            ],
            'txt_confirm_password'    => [
                'rules' =>  'matches[txt_password]',
                'errors'    =>  [
                'matches'  =>  lang('validateLang.pwd-match')
                ]
            ],
            'cb_term'    => [
                'rules' =>  'required',
                'errors'    =>  [
                'required'  =>  lang('validateLang.accept-terms')
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
                //return redirect()->to(site_url('account'));
                $edit_id = $member['id'];
                if($member['code']!=''){
                    $edit_id = 'TGJTA-'.$member['code'];
                }
                if($member['type']=='dealer'){
                    return redirect()->to('account/member/edit?u='.$edit_id);
                }else{
                    return redirect()->to('account/member/account?u='.$edit_id);
                }
            }
        }else{
            $ctModel = new ProductCategoryModel();
            $evModel = new EventModel();
            $mbModel = new MemberModel2();
            $abModel = new AlbumModel();
            $acModel= new KnowledgeModel();
            $mbBusiness = new MemberBusinessModel();
            $banner = new BannerModel();
            $db = db_connect();
            $tbl_price = $db->table('tbl_price');
            $tbl_month = $db->table('tbl_month');
            
            $cate_prod = $mbBusiness->join('tbl_productcategory as cate', 'cate.id = tbl_member_business.cate_id')
                                    ->where('tbl_member_business.type','product')
                                    ->findAll();

            $cate_bus = $mbBusiness->join('tbl_business as cate', 'cate.id = tbl_member_business.cate_id')
                                    ->where('tbl_member_business.type','business')
                                    ->findAll();

            $info = $mbModel->join('tbl_member_business as tbl1','tbl1.dealer_code = tbl_member.dealer_code')
                    ->where(['tbl_member.member_home'=>'1','tbl_member.status'=>'2'])->findAll(9);

            $data = [
                'meta_title' => 'Thai Gem and Jewelry Traders Association',
                'lang' => $this->lang,
                'catergory' => $ctModel->where(['maincate_id'=>'0','status'=>'1'])->orderBy('sortby ASC')->findAll(6),
                'events' => $evModel->where(['home_show'=>'on','status'=>'on'])->findAll(),
                'dealers' => $info,
                'albums' => $abModel->findAll(),
                'member' => $mbModel->where('id',$this->member_id)->first(),
                'articles' => $acModel->where('status','on')->orderby('created_at','DESC')->findAll(3),
                'cate_prod' => $cate_prod,
                'cate_bus' => $cate_bus,
                'userdata' => $this->userdata,
                'banner' => $banner->where('page','home')->orderBy('sortby ASC')->findAll(5),
                'adsbanner' => $banner->where(['page'=>'ads','status'=>'1'])->orderBy('sortby ASC, created_at DESC')->groupBy('position')->findAll(),
                'tbl_price' => $tbl_price->where('status','1')->orderBy('created_at DESC')->get()->getResultArray(),
                'month' => $tbl_month->get()->getResultArray(),
                'signin_valid' => $this->validator
            ];
            echo view('front/home',$data);
        }
    }

    public function emailRegister($account=null)
    {
        $email = \Config\Services::email();
                
        $email->setFrom('info@thaigemjewelry.org', 'Thai gem and jewelry');
        $email->setTo($account);
        //$email->setCC('info@thaigemjewelry.org');
        $email->setSubject(($this->lang=='en'?'Register account complete':'การสมัครสมาชิกเรียบร้อย'));
        if($this->lang=='en'){
            $msg = "<p>An account has been created for using the Thai gem and Jewelry Traders Association website. Account : ".$account."</p>";
            $msg .= "Click link to website <a href=\"".site_url()."\">".lang('GlobalLang.website')."</a>";
        }else{
            $msg = "<p>การสร้างบัญชีสำหรับใช้งานเว็บไซต์สมาคมอัญมณีเรียบร้อยแล้ว ชื่อบัญชี : ".$account."</p>";
            $msg .= "สามารถเข้าใช้งานได้ที่ <a href=\"".site_url()."\">".lang('GlobalLang.website')."</a>";
        }
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
        helper(['form','text']);
        $model = new AccountModel();
        $request = service('request');
        if (!$request->getPost()) {
            return redirect()->to(site_url());
        }

        if(session()->get('userdata')){
            return redirect()->to('account');
        }

        $post = $request->getPost();
        $rules = [
            'txt_username' => [
                'rules' => 'required|memberAccount[txt_username]|memberStatus[txt_username]',
                'errors' =>  [
                    'required' => lang('validateLang.account-email'),
                    'valid_email' => lang('validateLang.email-format'),
                    'memberAccount' => lang('validateLang.not-account'),
                    'memberStatus' => lang('validateLang.account-disabled')
                ]
            ],
            'txt_password' => [
                'rules' => 'required|min_length[6]|max_length[200]|memberPassword[txt_username,txt_password]',
                'errors' =>  [
                    'required' => lang('validateLang.enter-pwd'),
                    'min_length' => lang('validateLang.pwd-character'),
                    'memberPassword' => lang('validateLang.pwd-incorrect')
                ]
            ]
        ];

        if($this->validate($rules)){
            $db = db_connect();
            $tbl = $db->table('tbl_member');
            $member = $model->where('account', $request->getVar('txt_username'))->first();
            if($member['code']==''){
                $str_rand = random_string('alnum', 11);
                $tbl->where('account', $member['account'])->set('code' , $str_rand)->update();
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

            $tbl->where('account', $member['account'])
                ->set('last_login' , new Time('now'))
                ->update();
            session()->set('userdata',$sess);
            if($post['hd_member']==''){
                return redirect()->to('account');
            }else{
                return redirect()->to(site_url('member/id/'.$post['hd_member']));
            }
        }else{
            $ctModel = new ProductCategoryModel();
            $evModel = new EventModel();
            $mbModel = new MemberModel2();
            $abModel = new AlbumModel();
            $acModel= new KnowledgeModel();
            $mbBusiness = new MemberBusinessModel();
            $banner = new BannerModel();
            $db = db_connect();
            $tbl_price = $db->table('tbl_price');
            $tbl_month = $db->table('tbl_month');
        
            $cate_prod = $mbBusiness->join('tbl_productcategory as cate', 'cate.id = tbl_member_business.cate_id')
                                    ->where('tbl_member_business.type','product')
                                    ->findAll();

            $cate_bus = $mbBusiness->join('tbl_business as cate', 'cate.id = tbl_member_business.cate_id')
                                    ->where('tbl_member_business.type','business')
                                    ->findAll();

            $info = $mbModel->join('tbl_member_business as tbl1','tbl1.dealer_code = tbl_member.dealer_code')
                    ->where(['tbl_member.member_home'=>'1','tbl_member.status'=>'2'])->findAll(9);

            $data = [
                'meta_title' => 'Thai Gem and Jewelry Traders Association',
                'lang' => $this->lang,
                'catergory' => $ctModel->where(['maincate_id'=>'0','status'=>'1'])->orderBy('sortby ASC')->findAll(6),
                'events' => $evModel->where(['home_show'=>'on','status'=>'on'])->findAll(),
                'dealers' => $info,
                'albums' => $abModel->findAll(),
                'member' => $mbModel->where('id',$this->member_id)->first(),
                'articles' => $acModel->where('status','on')->orderby('created_at','DESC')->findAll(3),
                'cate_prod' => $cate_prod,
                'cate_bus' => $cate_bus,
                'userdata' => $this->userdata,
                'banner' => $banner->where('page','home')->orderBy('created_at DESC')->findAll(5),
                'adsbanner' => $banner->where(['page'=>'ads','status'=>'1'])->orderBy('sortby ASC, created_at DESC')->groupBy('position')->findAll(),
                'signin_valid' => $this->validator,
                'tbl_price' => $tbl_price->where('status','1')->orderBy('created_at DESC')->get()->getResultArray(),
                'month' => $tbl_month->get()->getResultArray()
            ];

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
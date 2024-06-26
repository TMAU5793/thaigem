<?php

namespace App\Controllers;
use App\Models\MemberModel;
use App\Models\Account\MemberModel as AcMemberModel;
use App\Models\ProvinceModel;
use App\Models\Account\AlbumModel;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\BusinessModel;
use App\Models\MemberBusinessModel;
use App\Models\BannerModel;
use App\Models\SettingModel;
use DateTime;

//use CodeIgniter\I18n\Time;

class Member extends BaseController
{
    protected $lang;
    protected $db;
    protected $userdata;
    public function __construct() {
        helper('text');
        $this->db = \Config\Database::connect();
        $this->lang = session()->get('lang');
        if($this->lang==""){
            $this->lang = 'en';
        }

        $sess = session()->get('userdata');
        if($sess){
            $this->userdata = $sess;
        }
    }

	public function index()
	{   
        $request = service('service');
        $pager = service('pager');
        $model = new MemberModel();
        $albumModel = new AlbumModel();
        $pvModel = new ProvinceModel();
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();
        $mbModel = new AcMemberModel();
        $mbBusiness = new MemberBusinessModel();
        $settingModel = new SettingModel();
        $cate_prod = $mbBusiness->findAll();

        $mb_filter =  $settingModel->where('type','member_filter')->first();
        if($mb_filter['desc']=='2'){
            //ระยะเวลาการเป็นสมาชิก จากมากไปน้อย
            $info = $model->select('*,id as m_id')->where(['tbl_member.type'=>'dealer','tbl_member.status'=>'2'])->orderBy('tbl_member.member_start','ASC')->paginate(20);
        }elseif($mb_filter['desc']=='3'){
            //ระยะเวลาการเป็นสมาชิก จากน้อยไปมาก
            $info = $model->select('*,id as m_id')->where(['tbl_member.type'=>'dealer','tbl_member.status'=>'2'])->orderBy('tbl_member.member_start','DESC')->paginate(20);
        }elseif($mb_filter['desc']=='4'){
            //การสุ่ม
            $info = $model->select('*,id as m_id')->where(['tbl_member.type'=>'dealer','tbl_member.status'=>'2'])->orderBy('tbl_member.id','RANDOM')->paginate(20);
        }else{
            //อัพเดตล่าสุด
            $info = $model->select('*,id as m_id')->where(['tbl_member.type'=>'dealer','tbl_member.status'=>'2'])->orderBy('tbl_member.updated_at','DESC')->paginate(20);
        }
                
        $data = [
            'meta_title' => 'Member directory',
            'lang' => $this->lang,
            'info' => $info,
            'pager' => $model->pager,
            'album' => $albumModel->findAll(),
            'province' => $pvModel->orderBy('sortby ASC, name_'.$this->lang.' ASC')->findAll(),
            'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
            'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
            'cate_prod' => $cate_prod,
            'userdata' => $this->userdata
        ];
        // print_r('<pre>');
        // print_r($result);
        // print_r('</pre>');
        echo view('front/member', $data);
	}

    public function id()
    {
        $sess = session()->get('userdata');
        if(!$sess){
            return redirect()->to('member');
        }

        $uri = service('uri');
        $segment3 = $uri->getSegment(3);
        $model = new MemberModel();
        $albumModel = new AlbumModel();
        $mbModel = new AcMemberModel();
        $mbBusiness = new MemberBusinessModel();
        
        if($segment3){
            
            $member = $model->where(['status'=>'2','code'=>$segment3])->first();
            if(!$member){
                $member = $model->where(['status'=>'2','id'=>$segment3])->first();
                if(!$member){
                    return redirect()->to('member');
                }
            }
            //echo $member['id'];
            $data = [
                'meta_title' => ($member['company']!=''?$member['company']:'TGJTA Member'),
                'meta_desc' => $member['about'],
                'shareImg' => $member['profile'],
                'lang' => $this->lang,
                'info' => $member,
                'album' => $albumModel->where('member_id',$member['id'])->findAll(),
                'address' => $mbModel->getAddressById($member['id']),
                'province' => $mbModel->getProvince(),
                'amphure' => $mbModel->getAmphure(),
                'district' => $mbModel->getDistrict(),
                'social' => $mbModel->getSocialById($member['id']),
                'membercontact' => $mbModel->getMemberContactById($member['id']),
                'memberbusiness' => $mbModel->getMemberBusinessById($member['id']),
                'pMaincate' => $mbModel->getProductMainType(),
                'pSubcate' => $mbModel->getProductType(),
                'bMaincate' => $mbModel->getBusinessMainType(),
                'bSubcate' => $mbModel->getBusinessType(),
                'cate_prod' => $mbBusiness->where('member_id',$member['id'])->first(),
            ];
            
            // print_r('<pre>');
            // print_r($member);
            // print_r('</pre>');
            echo view('front/member-desc', $data);
        }else{
            return redirect()->to('member');
        }
    }

    public function search()
    {
        helper('text');
        $request = service('request');
        $mbModel = new MemberModel();
        $albumModel = new AlbumModel();
        $pvModel = new ProvinceModel();
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();
        $mbBusiness = new MemberBusinessModel();
        $get = $request->getGet();

        if($get){
            $pager = \Config\Services::pager();
            
            $search_arr = [
                'keyword' => $get['txt_keyword'],
                'product' => $get['ddl_product_type'],
                'business' => $get['ddl_business'],
                'province' => $get['ddl_province'],
                'duration' => $get['ddl_duration'],
                'employee' => $get['ddl_employee']
            ];
            if($search_arr['keyword'] == '' && $search_arr['product'] == '' && $search_arr['business'] == '' && $search_arr['province'] == '' && $search_arr['duration'] == '' && $search_arr['employee'] == ''){
                return redirect()->to('member');
            }else if ($search_arr['keyword'] != '' && $search_arr['product'] == '' && $search_arr['business'] == '' && $search_arr['province'] == '' && $search_arr['duration'] == '' && $search_arr['employee'] == ''){
                $info = $mbModel->searchMember($search_arr);
                $page=(int)(($request->getVar('page')!==null)?$request->getVar('page'):1)-1;
                $perPage =  20;
                $total = count($info);
                $pager->makeLinks($page+1, $perPage, $total);
                $offset = $page * $perPage;
                $result = $mbModel->searchMember($search_arr,$perPage,$offset);
            }else{
                $info = $mbModel->searchMember($search_arr);
                $page=(int)(($request->getVar('page')!==null)?$request->getVar('page'):1)-1;
                $perPage =  20;
                $total = count($info);
                $pager->makeLinks($page+1, $perPage, $total);
                $offset = $page * $perPage;
                $result = $mbModel->searchMember($search_arr,$perPage,$offset);
                $avd = TRUE;
            }
            
            $cate_prod = $mbBusiness->findAll();

            $data = [
                'meta_title' => 'Member',
                'lang' => $this->lang,
                'info' => $result,
                'pager' => $pager,
                'album' => $albumModel->findAll(),
                'province' => $pvModel->orderBy('sortby ASC, name_'.$this->lang.' ASC')->findAll(),
                'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
                'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
                'avd' => $avd,
                'cate_prod' => $cate_prod,
                'userdata' => $this->userdata
            ];
            // print_r('<pre>');
            // print_r($result);
            // print_r('</pre>');            
            echo view('front/member', $data);
        }else{
            return redirect()->to('member');
        }
    }

    public function filter()
    {
        helper('text');
        $pager = \Config\Services::pager();
        $request = service('request');
        $mbModel = new MemberModel();
        $albumModel = new AlbumModel();
        $pvModel = new ProvinceModel();
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();
        $mbnModel = new MemberBusinessModel();
        $mbBusiness = new MemberBusinessModel();

        $id = $request->getGet('c');
        
        $cate_prod = $mbBusiness->findAll();

        if($id){

            $info = $mbModel->filterMember($id);
            $page = intval($_GET['page']);
            $page_size = 20;
            $total_records = count($info);
            $total_page   = ceil($total_records / $page_size);
            if ($page > $total_page) {
                $page = $total_page;
            }
            if ($page < 1) {
                $page = 1;
            }
            $offset = ($page - 1) * $page_size;
            $result = array_slice($info, $offset, $page_size);

            $data = [
                'meta_title' => 'Filter Member',
                'lang' => $this->lang,
                'info' => $result,
                'page' => $page,
                'total_page' => $total_page,
                'album' => $albumModel->findAll(),
                'province' => $pvModel->orderBy('sortby ASC, name_'.$this->lang.' ASC')->findAll(),
                'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
                'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
                'cate_prod' => $cate_prod,
                'userdata' => $this->userdata
            ];

            // print_r('<pre>');
            // print_r($info);
            // print_r('</pre>');
            echo view('front/member', $data);
                        
        }else{
            return redirect()->to('member');
        }
    }

    public function privileges()
    {
        $banner = new BannerModel();
        $query = $this->getInformation('member','1'); //page, data category
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query,
            'banner' => $banner->where('page','member')->first()
        ];
        
        echo view('template/information', $data);
    }

    public function membership()
    {
        $banner = new BannerModel();
        $query = $this->getInformation('member','2'); //page, data category
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query,
            'banner' => $banner->where('page','member')->first()
        ];
        
        echo view('template/apply-member', $data);
    }

    public function getInformation($page,$cate)
    {
        $builder = $this->db->table('tbl_information');
        $builder->where(['page'=>$page,'cate'=>$cate]);
        $builder->limit(1);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function forgotpassword()
    {
        $data = [
            'meta_title' => lang('GlobalLang.forgot'),
            'lang' => $this->lang,
        ];
        
        echo view('front/forgot-password', $data);
    }

    public function reset_password()
    {
        helper('date');
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_token');
        $request = service('request');

        $date_now = date("Y-m-d H:i:s");
        $get_data = $request->getGet('tk');
        $builder->where('token',$get_data);
        $token = $builder->get()->getRow();        

        $data = [];
        $data['meta_title'] = lang('GlobalLang.forgot');
        $data['lang'] = $this->lang;
        $data['resetpass'] = true;
        $data['member_id'] = $token->member_id;

        if($request->getGet()){
            if($date_now > $token->token_expire){                
                $data['expire'] = true;
            }else{
                $data['expire'] = false;
            }
        }else{
            return redirect()->to('member/forgotpassword');
        }
        
        echo view('front/forgot-password', $data);
    }

    public function update_password()
    {
        helper('date');
        $request = service('request');
        helper(['date','form']);
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_token');
        $request = service('request');

        $date_now = date("Y-m-d H:i:s");
        $hd_token = $request->getPost('hd_token');
        $builder->where('token',$hd_token);
        $token = $builder->get()->getRow();                

        $rules = [
            'txt_newpassword'       => [
                'rules' =>  'required|min_length[6]|max_length[200]',
                'errors'    =>  [
                'required'  =>  'กรุณากรอกรหัสผ่าน',
                    'min_length'   =>  'รหัสผ่านอย่างน้อย 6 ตัวอักษร'
                ]
            ],
            'txt_cfpassword'    => [
                'rules' =>  'matches[txt_newpassword]',
                'errors'    =>  [
                    'matches'  =>  'รหัสผ่านไม่ตรงกัน'
                ]
            ],
        ];
        
        if($this->validate($rules)){
            $token_arr = [
                'status' => '1'
            ];
            $builder->where(['member_id'=>$request->getPost('hd_member'),'token'=>$hd_token]);
            $token = $builder->update($token_arr);
            if($token){
                $password = $db->table('tbl_member');
                $pwd_arr = [
                    'password' => password_hash($request->getPost('txt_newpassword'), PASSWORD_DEFAULT),
                ];
                $password->where('id',$request->getPost('hd_member'));
                $update = $password->update($pwd_arr);
                if($update){
                    return redirect()->to('member/forgotpassword')->with('msg_done','true');
                }else{
                    return redirect()->to('member/forgotpassword');
                }
            }
        }else{
            $data = [];
            $data['meta_title'] = lang('GlobalLang.forgot');
            $data['lang'] = $this->lang;
            $data['resetpass'] = true;
            $data['token'] = $request->getPost('hd_token');
            $data['member_id'] = $request->getPost('hd_member');

            if($request->getPost()){
                if($date_now > $token->token_expire){                
                    $data['expire'] = true;
                }else{
                    $data['expire'] = false;
                }
            }else{
                return redirect()->to('member/forgotpassword');
            }
            $data['validation'] = $this->validator;
            echo view('front/forgot-password',$data);
            //print_r($this->validator);
        }        
    }

    public function emailforgot()
    {
        helper('date');
        $mbModel = new MemberModel();
        $request = service('request');
        $email = \Config\Services::email();

        $postdata = $request->getPost();
        $date_at = date("Y-m-d H:i:s");
        $date_expire = date("Y-m-d H:i:s", strtotime('+15 minutes'));

        if($postdata && $postdata['txt_email']!=''){
            $member = $mbModel->where('account',$postdata['txt_email'])->first();
            $data = [
                'member_id' => $member['id'],
                'token' => $postdata['hd_token'],
                'token_expire' => $date_expire,
                'type' => 'resetpassword',
                'created_at' => $date_at
            ];
            $db = \Config\Database::connect();
            $builder = $db->table('tbl_token');
            $query = $builder->insert($data);
            if($query){
                $config['protocol'] = 'smtp';
                $config['SMTPCrypto'] = 'tls';
                $config['SMTPHost'] = 'smtp.gmail.com';
                $config['SMTPUser'] = 'grasp.sendmail@gmail.com';
                $config['SMTPPass'] = 'egmolkzlnqbyjoon';
                $config['SMTPPort'] = '587';
                $config['mailPath'] = '/usr/sbin/sendmail';
                $config['charset']  = 'utf-8';
                $config['mailType']  = 'html';
                $config['wordWrap'] = true;
                $email->initialize($config);
                
                $email->setFrom('info@thaigemjewelry.org', 'Thai gem and jewelry');
                $email->setTo($postdata['txt_email']);                
                $email->setSubject(($this->lang=='en'?'TGJTA : Reset pasword':'TGJTA การรีเซ็ตรหัสผ่าน'));
                $msg = "<p>".lang('GlobalLang.resetpass1')." : <strong>".$postdata['txt_email']."</strong> ".lang('GlobalLang.resetpass2')."</p>";
                $msg .= "<a href=\"".site_url('member/reset_password/?tk='.$postdata['hd_token'])."\">".lang('GlobalLang.resetpass')."</a>";
                $msg .= "<p>".lang('GlobalLang.resetpass3')."</p>";
                $email->setMessage($msg);
                //echo $msg;
                if($email->send()){
                    return redirect()->to('member/forgotpassword')->with('msg_mail','true');
                }else{
                    $email->printDebugger();
                }
            }else{
                print_r($db->error());
            }
        }else{
            return redirect()->to('');
        }
    }
}

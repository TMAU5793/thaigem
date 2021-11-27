<?php

namespace App\Controllers;
use App\Models\MemberModel;
use App\Models\Account\MemberModel as AcMemberModel;
use App\Models\ProvinceModel;
use App\Models\Account\AlbumModel;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\BusinessModel;
use App\Models\MemberBusinessModel;
use App\Models\FunctionModel;
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
        $model = new MemberModel();
        $albumModel = new AlbumModel();
        $pvModel = new ProvinceModel();
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();
        $mbModel = new AcMemberModel();
        $mbBusiness = new MemberBusinessModel();
        $cate_prod = $mbBusiness->join('tbl_productcategory as cate', 'cate.id = tbl_member_business.cate_id')
                                ->where('tbl_member_business.type','product')
                                ->findAll();

        $cate_bus = $mbBusiness->join('tbl_business as cate', 'cate.id = tbl_member_business.cate_id')
                                ->where('tbl_member_business.type','business')
                                ->findAll();
        $data = [
            'meta_title' => 'Member directory',
            'lang' => $this->lang,
            'info' => $model->where(['type'=>'dealer','status'=>'2'])->paginate(10),
            'pager' => $model->pager,
            'album' => $albumModel->findAll(),
            'province' => $pvModel->findAll(),
            'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
            'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
            'cate_prod' => $cate_prod,
            'cate_bus' => $cate_bus,
            'userdata' => $this->userdata
        ];
        // print_r('<pre>');
        // print_r($cate_prod);
        // print_r('</pre>');
        echo view('front/member', $data);
	}

    public function id()
    {
        $uri = service('uri');
        $segment3 = $uri->getSegment(3);
        $model = new MemberModel();
        $albumModel = new AlbumModel();
        $mbModel = new AcMemberModel();
        
        if($segment3){
            $member = $model->join('tbl_member_business', 'tbl_member.id = tbl_member_business.member_id')
                            ->join('tbl_address', 'tbl_member.id = tbl_address.member_id')
                            ->where(['tbl_member.status'=>'2','tbl_member.code'=>$segment3])
                            ->groupBy('tbl_member_business.member_id')
                            ->first();
            if(!$member){
                $member = $model->join('tbl_member_business', 'tbl_member.id = tbl_member_business.member_id')
                                ->join('tbl_address', 'tbl_member.id = tbl_address.member_id')
                                ->where(['tbl_member.status'=>'2','tbl_member.id'=>$segment3])
                                ->groupBy('tbl_member_business.member_id')
                                ->first();
            }
            
            $data = [
                'meta_title' => $member['name'].' '.$member['lastname'],
                'meta_desc' => $member['about'],
                'info' => $member,
                'album' => $albumModel->where('member_id',$member['member_id'])->findAll(),
                'address' => $mbModel->getAddressById($member['member_id']),
                'province' => $mbModel->getProvince(),
                'amphure' => $mbModel->getAmphure(),
                'district' => $mbModel->getDistrict(),
                'social' => $mbModel->getSocialById($member['member_id']),
                'membercontact' => $mbModel->getMemberContactById($member['member_id']),
                'memberbusiness' => $mbModel->getMemberBusinessById($member['member_id']),
                'pMaincate' => $mbModel->getProductMainType(),
                'pSubcate' => $mbModel->getProductType(),
                'bMaincate' => $mbModel->getBusinessMainType(),
                'bSubcate' => $mbModel->getBusinessType()
            ];
            
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
            $keyword = $get['txt_keyword'];
            $company = $get['kw_company'];
            $productType = $get['ddl_product_type'];
            $business = $get['ddl_business'];
            $province = $get['ddl_province'];
            $duration = $get['ddl_duration'];
            
            if($keyword=="" && $company!=""|| $productType!="" || $business!="" || $province!="" || $duration!=""){
                $result = $mbModel->join('tbl_member_business', 'tbl_member.id = tbl_member_business.member_id')
                            ->join('tbl_address', 'tbl_member.id = tbl_address.member_id')
                            ->where('tbl_member.status','2')
                            ->like('tbl_member.company',$keyword)
                            ->like('tbl_member_business.cate_id',$productType)
                            ->like('tbl_member_business.cate_id',$business)
                            ->like('tbl_address.province_id',$province)
                            ->groupBy('tbl_member_business.member_id')
                            ->paginate(1);
                $pager = $mbModel->pager;
                $avd = TRUE;                

            }else if($keyword!="" && $productType=="" && $business=="" && $province=="" && $duration==""){
                $result = $mbModel->where('status','2')->like('company',$keyword)->orderBy('created_at DESC')->paginate(10);
                $pager = $mbModel->pager;
            }else{
                return redirect()->to('member');
            }
            
            $cate_prod = $mbBusiness->join('tbl_productcategory as cate', 'cate.id = tbl_member_business.cate_id')
                                ->where('tbl_member_business.type','product')
                                ->findAll();

            $cate_bus = $mbBusiness->join('tbl_business as cate', 'cate.id = tbl_member_business.cate_id')
                                ->where('tbl_member_business.type','business')
                                ->findAll();

            $data = [
                'meta_title' => 'Member',
                'lang' => $this->lang,
                'info' => $result,
                'pager' => $pager,
                'album' => $albumModel->findAll(),
                'province' => $pvModel->findAll(),
                'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
                'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
                'avd' => $avd,
                'cate_prod' => $cate_prod,
                'cate_bus' => $cate_bus,
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
        $request = service('request');
        $mbModel = new MemberModel();
        $albumModel = new AlbumModel();
        $pvModel = new ProvinceModel();
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();
        $mbnModel = new MemberBusinessModel();
        $mbBusiness = new MemberBusinessModel();

        $id = $request->getGet('c');
        // echo $id;
        
        $cate_prod = $mbBusiness->join('tbl_productcategory as cate', 'cate.id = tbl_member_business.cate_id')
                                ->where('tbl_member_business.type','product')
                                ->findAll();

        $cate_bus = $mbBusiness->join('tbl_business as cate', 'cate.id = tbl_member_business.cate_id')
                                ->where('tbl_member_business.type','business')
                                ->findAll();
        if($id){
            //$result = $mbnModel->where('maincate_id',$id)->groupby('maincate_id')->findAll();
            // $db      = \Config\Database::connect();
            // $builder = $db->table('tbl_member_business');            
            // $builder->join('tbl_member', 'tbl_member.id = tbl_member_business.member_id');
            // $builder->where('tbl_member_business.maincate_id',$id);
            // $builder->groupBy('tbl_member_business.member_id');
            // $query = $builder->get()->getresultArray();

            $query = $mbModel->join('tbl_member_business', 'tbl_member.id = tbl_member_business.member_id')
                            ->where('tbl_member_business.maincate_id',$id)
                            ->groupBy('tbl_member_business.member_id')
                            ->orderBy('tbl_member.created_at DESC')
                            ->paginate(1);
                            
            $data = [
                'meta_title' => 'Filter Member',
                'lang' => $this->lang,
                'info' => $query,
                'pager' => $mbModel->pager,
                'album' => $albumModel->findAll(),
                'province' => $pvModel->findAll(),
                'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
                'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
                'cate_prod' => $cate_prod,
                'cate_bus' => $cate_bus,
                'userdata' => $this->userdata
            ];
            
            echo view('front/member', $data);
        }else{
            return redirect()->to('member');
        }
    }

    public function privileges()
    {
        $query = $this->getInformation('member','1'); //page, data category
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query
        ];
        
        echo view('template/information', $data);
    }

    public function membership()
    {
        $query = $this->getInformation('member','2'); //page, data category
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query
        ];
        
        echo view('template/information', $data);
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

<?php

namespace App\Controllers;
use App\Models\MemberModel;
use App\Models\Account\MemberModel as AcMemberModel;
use App\Models\ProvinceModel;
use App\Models\Account\AlbumModel;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\BusinessModel;
use App\Models\MemberBusinessModel;

class Member extends BaseController
{
    protected $lang;
    protected $db;
    public function __construct() {
        helper('text');
        $this->db = \Config\Database::connect();
        $this->lang = session()->get('lang');
        if($this->lang==""){
            $this->lang = 'en';
        }
    }

	public function index()
	{   
        $model = new MemberModel();
        $albumModel = new AlbumModel();
        $pvModel = new ProvinceModel();
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();

        $data = [
            'meta_title' => 'Member directory',
            'lang' => $this->lang,
            'info' => $model->where(['type'=>'dealer','status'=>'2'])->findAll(),
            'album' => $albumModel->findAll(),
            'province' => $pvModel->findAll(),
            'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
            'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
        ];
        //print_r($data['category']);
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
                'address' => $mbModel->getAddress(),
                'province' => $mbModel->getProvince(),
                'amphure' => $mbModel->getAmphure(),
                'district' => $mbModel->getDistrict(),
                'social' => $mbModel->getSocial(),
                'membercontact' => $mbModel->getMemberContact(),
                'memberbusiness' => $mbModel->getMemberBusiness(),
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
        $get = $request->getGet();

        if($get){
            $keyword = $get['txt_keyword'];
            $company = $get['kw_company'];
            $productType = $get['ddl_product_type'];
            $business = $get['ddl_business'];
            $province = $get['ddl_province'];
            $duration = $get['ddl_duration'];

            // $builder = $db->table('tbl_member_business');            
            // $builder->join('tbl_member', 'tbl_member.id = tbl_member_business.member_id');
            // $builder->where('tbl_member_business.maincate_id',$id);
            if($keyword=="" && $company!=""|| $productType!="" || $business!="" || $province!="" || $duration!=""){
                $result = $mbModel->join('tbl_member_business', 'tbl_member.id = tbl_member_business.member_id')
                            ->join('tbl_address', 'tbl_member.id = tbl_address.member_id')
                            ->where('tbl_member.status','2')
                            ->like('tbl_member.company',$keyword)
                            ->like('tbl_member_business.cate_id',$productType)
                            ->like('tbl_member_business.cate_id',$business)
                            ->like('tbl_address.province_id',$province)
                            ->groupBy('tbl_member_business.member_id')
                            ->findAll();
                $avd = TRUE;

            }else if($keyword!="" && $productType=="" && $business=="" && $province=="" && $duration==""){
                $result = $mbModel->where('status','2')->like('company',$keyword)->findAll();
            }else{
                return redirect()->to('member');
            }
            
            $data = [
                'meta_title' => 'Member',
                'lang' => $this->lang,
                'info' => $result,
                'album' => $albumModel->findAll(),
                'province' => $pvModel->findAll(),
                'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
                'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll(),
                'avd' => $avd
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
        $id = $request->getGet('c');
        // echo $id;

        if($id){
            //$result = $mbnModel->where('maincate_id',$id)->groupby('maincate_id')->findAll();
            $db      = \Config\Database::connect();
            $builder = $db->table('tbl_member_business');            
            $builder->join('tbl_member', 'tbl_member.id = tbl_member_business.member_id');
            $builder->where('tbl_member_business.maincate_id',$id);
            $builder->groupBy('tbl_member_business.maincate_id');
            $query = $builder->get()->getresultArray();
            $data = [
                'meta_title' => 'Filter Member',
                'lang' => $this->lang,
                'info' => $query,
                'album' => $albumModel->findAll(),
                'province' => $pvModel->findAll(),
                'category' => $cateModel->where(['maincate_id !='=>'0','status'=>'1'])->findAll(),
                'business' => $bnModel->where(['main_type !='=>'0','status'=>'1'])->findAll()
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
}

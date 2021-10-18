<?php

namespace App\Controllers;
use App\Models\MemberModel;
use App\Models\ProvinceModel;
use App\Models\Account\AlbumModel;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\BusinessModel;

class Member extends BaseController
{
    protected $lang;
    public function __construct() {
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
            'meta_title' => 'Member',
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
        $cateModel = new ProductCategoryModel();
        $bnModel = new BusinessModel();
        $pvModel = new ProvinceModel();

        if($segment3){
            $member = $model->where('id',$segment3)->first();
            $category = $cateModel->where('id',$member['product_type'])->first();
            $business = $bnModel->where('id',$member['business_type'])->first();
            
            $data = [
                'meta_title' => $member['name'].' '.$member['lastname'],
                'meta_desc' => $member['about'],
                'info' => $member,
                'album' => $albumModel->where('member_id',$segment3)->findAll(),
                'category' => $category,
                'business' => $business,
                'province' => $pvModel->where('code',$member['province'])->first()
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

            if($keyword=="" && $company!=""|| $productType!="" || $business!="" || $province!="" || $duration!=""){
                $result = $mbModel->where('status','2')
                            ->like('company',$company)
                            ->like('product_type',$productType)
                            ->like('business_type',$business)
                            ->like('province',$province)                           
                            ->findAll();
                $avd = TRUE;

            }else if($keyword!="" && $company=="" && $productType=="" && $business=="" && $province=="" && $duration==""){
                $result = $mbModel->like('name',$keyword)->orLike('lastname',$keyword)->where('status','2')->findAll();
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
            //print_r($result);
            echo view('front/member', $data);
        }else{
            return redirect()->to('member');
        }
    }
}

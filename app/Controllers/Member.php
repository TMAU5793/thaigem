<?php

namespace App\Controllers;
use App\Models\MemberModel;
use App\Models\ProvinceModel;
use App\Models\Account\AlbumModel;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\BusinessModel;

class Member extends BaseController
{
	public function index()
	{   
        $model = new MemberModel();
        $albumModel = new AlbumModel();

        $data = [
            'meta_title' => 'Member',
            'info' => $model->where(['type'=>'dealer','status'=>'2'])->findAll(),
            'album' => $albumModel->findAll()
        ];
        //print_r($data['info']);
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
                'album' => $albumModel->findAll(),
                'category' => $cateModel->where('id',$category['maincate_id'])->first(),
                'business' => $bnModel->where('id',$business['main_type'])->first(),
                'province' => $pvModel->where('code',$member['province'])->first()
            ];
            
            echo view('front/member-desc', $data);
        }else{
            return redirect()->to('member');
        }
    }
}

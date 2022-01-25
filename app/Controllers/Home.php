<?php

namespace App\Controllers;
use App\Models\Admin\ProductCategoryModel;
use App\Models\Admin\EventModel;
use App\Models\MemberModel;
use App\Models\Account\AlbumModel;
use App\Models\BookingModel;
use App\Models\KnowledgeModel;
use App\Models\MemberBusinessModel;
use App\Models\BannerModel;

class Home extends BaseController
{    
    protected $lang;
    protected $member_id;
    protected $userdata;
    public function __construct() {        
        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }

        $usersess = session()->get('userdata');
        if($usersess){
            $this->userdata = $usersess;
            $this->member_id = $usersess['id'];
        }
    }

	public function index()
	{                
        helper(['text','cookie']);
        $ctModel = new ProductCategoryModel();
        $evModel = new EventModel();
        $mbModel = new MemberModel();
        $abModel = new AlbumModel();
        $bkModel = new BookingModel();
        $acModel= new KnowledgeModel();
        $mbBusiness = new MemberBusinessModel();
        $banner = new BannerModel();
        $db = db_connect();
        $tbl_price = $db->table('tbl_price');
        
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
            'tbl_price' => $tbl_price->where('status','1')->orderBy('created_at DESC')->get()->getResultArray()
        ];
                
        // print_r('<pre>');
        // print_r($data['dealers']);
        // print_r('</pre>');
        echo view('front/home', $data);
	}
}

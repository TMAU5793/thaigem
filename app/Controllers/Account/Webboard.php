<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Admin\ProductCategoryModel;
  
class Webboard extends Controller
{   
    protected $member_id;
    public function __construct()
    {
        $sess = session()->get('userdata');
        if($sess){
            $this->member_id = $sess['id'];
        }
    }
    
    public function index()
    {   
        $cateModel = new ProductCategoryModel;
        $data = [
            'ac_webboard' => TRUE,
            'title' => 'Post Webboard',
            'cates' => $cateModel->where(['status'=>'1','maincate_id'=>0])->findAll()
        ];
        echo view('account/ac-webboard',$data);
    }
}
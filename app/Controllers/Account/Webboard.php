<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Admin\ProductCategoryModel;
use App\Models\WebboardModel;
  
class Webboard extends Controller
{   
    protected $member_id;
    public function __construct()
    {
        helper('text');
        $sess = session()->get('userdata');
        if($sess){
            $this->member_id = $sess['id'];
        }
    }
    
    public function index()
    {   
        $model = new WebboardModel();
        $data = [
            'ac_webboard' => TRUE,
            'title' => 'My Webboard',
            'info' => $model->where('member_id',$this->member_id)->findAll()
        ];
        echo view('account/ac-webboard',$data);
    }

    public function form()
    {
        $request = service('request');
        $model = new WebboardModel();
        $cateModel = new ProductCategoryModel;
        $edit_id = $request->getGet('id');
        if(!$edit_id){
            $data = [
                'ac_webboard' => TRUE,
                'title' => 'Create Webboard',
                'cates' => $cateModel->where(['status'=>'1','maincate_id'=>0])->findAll(),
                'info' => $model->where('member_id',$this->member_id)->findAll()
            ];
        }else{
            $data = [
                'ac_webboard' => TRUE,
                'title' => 'Edit Webboard',
                'cates' => $cateModel->where(['status'=>'1','maincate_id'=>0])->findAll(),
                'info' => $model->where('id',$edit_id)->first()
            ];
        }

        echo view('account/ac-webboard-form',$data);
    }

    public function save()
    {
        $request = service('request');
        $model = new WebboardModel();
        $post = $request->getPost();

        if($post){
            $arr_data = [
                'member_id' => $this->member_id,
                'category_id' => $post['ddl_cate'],
                'topic' => $post['txt_topic'],
                'desc' => $post['txt_desc']
            ];
            if($post['hd_id']==''){
                $model->save($arr_data);
            }else{
                $model->update($post['hd_id'],$arr_data);
            }            
        }

        return redirect()->to('account/webboard');
    }

    public function deletePost()
    {
        $request = service('request');
        $model = new WebboardModel();
        $id = $request->getPost('id');
        if($id){
            $deleted = $model->where('id', $id)->delete($id);
            if($deleted){
                echo true;
            }
        }else{
            return redirect()->to('account/webboard');
        }
    }
}
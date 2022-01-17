<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\FilesModel;
use App\Models\Account\AccountModel;
  
class Invoice extends Controller
{   
    protected $member_id;
    protected $udata;
    public function __construct()
    {
        $sess = session()->get('userdata');
        if($sess){
            $this->udata = $sess;
            $this->member_id = $sess['id'];
        }
    }
    
    public function index()
    {   
        if($this->udata['user_type']!='dealer'){
            return redirect()->to('');
        }
        
        $model = new FilesModel();
        $acModel = new AccountModel();
        $member = $acModel->where('id',$this->member_id)->first();
        $data = [
            'ac_invoice' => TRUE,
            'meta_title' => 'Download invoice',
            'invoices' => $model->where(['filefor'=>'invoice','uploadby'=>'admin','status'=>'on'])->orderBy('created_at DESC')->findAll(),
            'fileFor' => 'invoice',
            'member' => $member
        ];
        echo view('account/ac-invoice',$data);
    }

    public function download()
    {
        helper('download');
        $request = service('request');
        $model = new FilesModel();
        $post = $request->getPost();
        if($post){
            $id = $post['hd_file_id'];
            $file = $model->where('id',$id)->first();
            if(is_file($file['path'])){
                $type = array_pop(explode('.',$file['path']));
                $name = $file['filename'];
                $path = ROOTPATH.$file['path'];
                return $this->response->download($path, null);
            }else{
                return redirect()->to('account/form');
            }
        }else{
            return redirect()->to('account/form');
        }        
    }

    public function upload()
    {
        helper(['form','filesystem','text']);
        $request = service('request');
        $model = new FilesModel();
        //echo strtolower(random_string());
        $post = $request->getPost();
        if($post){
            $file = $request->getFile('file_upload'); //เก็บไฟล์อัพโหลด
            $filename = strtolower($post['hd_filefor'].'-'.random_string().'-'.$post['hd_file_upload']);
            $path = 'uploads/member/'.$this->member_id.'/files';
            if (!is_dir($path)) {
                mkdir($path, 0777, TRUE);                
            }
            
            $data = [
                'filename' => $filename,
                'filefor' => $post['hd_filefor'],
                'member_id' => $this->member_id
            ];
            $model->save($data);
            $id = $model->getInsertID();
            if($id){
                $file->move($path,$filename);
                $data = [
                    'path' => $path.'/'.$filename
                ];
                $model->update($id, $data);
            }
            return redirect()->to($post['hd_burl'])->with('msg_invoice',TRUE);
        }else{
            return redirect()->to('account/form');
        }
    }
}
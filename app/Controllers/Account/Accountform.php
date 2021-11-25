<?php 

namespace App\Controllers\Account;
use CodeIgniter\Controller;
use App\Models\FilesModel;
use App\Models\Account\AccountModel;
  
class Accountform extends Controller
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
            'ac_form' => TRUE,
            'meta_title' => 'Download Form Dealer',
            'formFiles' => $model->where(['filefor'=>'dealer','member_id'=>null,'status'=>'on'])->findAll(),
            'fileFor' => 'dealer',
            'member' => $member,
            'formmember' => TRUE
        ];
        echo view('account/ac-form',$data);
    }

    public function event()
    {
        if($this->udata['user_type']!='dealer'){
            return redirect()->to('');
        }

        $model = new FilesModel();
        $data = [
            'ac_form' => TRUE,
            'meta_title' => 'Download Form Event',
            'formFiles' => $model->where(['filefor'=>'event','member_id'=>null,'status'=>'on'])->findAll(),
            'fileFor' => 'event',
            'formevent' => TRUE
        ];
        echo view('account/ac-form',$data);
    }

    public function downloadFiles()
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

    public function uploadFiles()
    {
        helper(['form','filesystem','text']);
        $request = service('request');
        $model = new FilesModel();

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
            return redirect()->to($post['hd_burl'])->with('msg_upload',TRUE);
        }else{
            return redirect()->to('account/form');
        }        
    }
}
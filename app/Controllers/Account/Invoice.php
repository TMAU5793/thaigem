<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
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
        
        $data = [
            'ac_invoice' => TRUE,
            'title' => 'Download invoice'
        ];
        echo view('account/ac-invoice',$data);
    }
}
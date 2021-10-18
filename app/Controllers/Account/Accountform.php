<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
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
        
        $data = [
            'ac_form' => TRUE,
            'title' => 'Download Form'
        ];
        echo view('account/ac-form',$data);
    }

    public function event()
    {
        if($this->udata['user_type']!='dealer'){
            return redirect()->to('');
        }

        $data = [
            'ac_form' => TRUE,
            'title' => 'Download Form Event'
        ];
        echo view('account/ac-form',$data);
    }
}
<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Event extends Controller
{   
    public function __construct()
    {
        $sess_account = [
            'logged_member' => TRUE
        ];

        session()->set($sess_account);
    }
    
    public function index()
    {   
        $data = [
            'ac_event' => TRUE
        ];
        echo view('account/ac-event',$data);
    }
}
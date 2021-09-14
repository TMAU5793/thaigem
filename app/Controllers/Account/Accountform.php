<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Accountform extends Controller
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
            'ac_form' => TRUE,
            'title' => 'Download Form'
        ];
        echo view('account/ac-form',$data);
    }

    public function event()
    {
        $data = [
            'ac_form' => TRUE,
            'title' => 'Download Form Event'
        ];
        echo view('account/ac-form',$data);
    }
}
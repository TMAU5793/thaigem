<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Myaccount extends Controller
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
            'menu_myaccount' => TRUE
        ];
        echo view('account/myaccount',$data);
    }
}
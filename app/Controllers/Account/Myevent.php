<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Myevent extends Controller
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
            'menu_myevent' => TRUE
        ];
        echo view('account/myevent',$data);
    }
}
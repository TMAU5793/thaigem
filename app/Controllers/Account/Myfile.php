<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Myfile extends Controller
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
            'menu_myfile' => TRUE,
            'title' => 'Member File'
        ];
        echo view('account/myfile',$data);
    }

    public function eventfile()
    {
        $data = [
            'menu_myfile' => TRUE,
            'title' => 'Event File'
        ];
        echo view('account/myfile',$data);
    }
}
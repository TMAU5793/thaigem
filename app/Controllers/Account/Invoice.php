<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Invoice extends Controller
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
            'ac_invoice' => TRUE,
            'title' => 'Download invoice'
        ];
        echo view('account/ac-invoice',$data);
    }
}
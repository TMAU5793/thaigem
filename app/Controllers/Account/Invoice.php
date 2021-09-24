<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Invoice extends Controller
{   
    public function __construct()
    {
        
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
<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Webboard extends Controller
{   
    public function __construct()
    {
        
    }
    
    public function index()
    {   
        $data = [
            'ac_webboard' => TRUE,
            'title' => 'Post Webboard'
        ];
        echo view('account/ac-webboard',$data);
    }
}
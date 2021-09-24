<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
  
class Accountform extends Controller
{   
    public function __construct()
    {
        
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
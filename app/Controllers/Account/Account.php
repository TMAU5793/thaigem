<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\AccountModel;
  
class Account extends Controller
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
            'ac_account' => TRUE
        ];
        echo view('account/ac-account',$data);
    }

    public function register()
    {
        helper(['form']);
        $model = new AccountModel();
        $request = service('request');
        
        $model->register($request->getPost());
        //print_r($request->getPost());
    }
}
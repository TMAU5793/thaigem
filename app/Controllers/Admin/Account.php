<?php 

namespace App\Controllers\Admin;
  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class Account extends Controller
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $session = session();
		$logged_data = [
			'logged_admin'     => TRUE
		];
		$session->set($logged_data);
		//end session login
        
        $data = [
            'meta_title' => 'บัญชีผู้ดูแล'
        ];
        echo view('admin/account', $data);
    }

    public function register()
    {
        //include helper form
        helper(['form']);        
        $data = [
            'meta_title' => 'เพิ่มบัญชีผู้ดูแล'
        ];
        echo view('admin/register', $data);
    }

    public function edit()
    {
        //include helper form
        helper(['form']);        
        $data = [
            'meta_title' => 'แก้ไขข้อมูล'
        ];
        echo view('admin/register', $data);
    }
  
    public function save()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'ac_email'          => 'required|valid_email|is_unique[users.user_email]',
            'ac_password'       => 'required|min_length[6]|max_length[200]',
            'ac_password_cf'    => 'matches[ac_password]'
        ];
          
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'account'    => $this->request->getVar('ac_email'),
                'password' => password_hash($this->request->getVar('ac_password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('admin/account');
        }else{
            $data['validation'] = $this->validator;
            echo view('admin/account/register', $data);
        }
          
    }
  
}
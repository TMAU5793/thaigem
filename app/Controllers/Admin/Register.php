<?php 

namespace App\Controllers\Admin;
  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class Register extends Controller
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
            'meta_title' => 'เพิ่มบัญชีผู้ดูแล'
        ];
        echo view('admin/register', $data);
    }
  
    public function save()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
          
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
          
    }
  
}
<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{
	public function index()
	{
		$data = [
            'meta_title' => 'ลงชื่อใช้งาน | ระบบจัดการข้อมูล'
        ];
		echo view('admin/login',$data);
	}

	public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password don't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('login', [
                    "validation" => $this->validator,
                ]);

            } else {
                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                // Stroing session values
                $this->setUserSession($user);
                // Redirecting to dashboard after login
                return redirect()->to(base_url('dashboard'));

            }
        }
        return view('login');
    }

}

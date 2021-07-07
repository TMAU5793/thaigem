<?php 

namespace App\Controllers\Admin;
  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class Account extends Controller
{
    
    public function __construct()
    {
        $session = session();
		$logged_data = [
			'logged_admin'     => TRUE
		];
		$session->set($logged_data);
		//end session login
    }
    
    public function index()
    {
        $model = new UserModel();        
        $data = [
            'meta_title' => 'บัญชีผู้ดูแล',
            'info' => $model->orderBy('status DESC, created_at DESC')->findAll()
        ];
        echo view('admin/account', $data);
    }

    public function register()
    {
        //include helper form
        helper(['form']);        
        $data = [
            'meta_title' => 'เพิ่มบัญชีผู้ดูแล',
            'action'    =>  'save',
        ];
        echo view('admin/register', $data);
    }

    public function edit()
    {
        //include helper form
        helper(['form']);
        $request = service('request');
        $model = new UserModel();

        $id = $request->getGet('id');
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'action'    =>  'update',
            'info'  =>  $model->where('id',$id)->first()
        ];
        echo view('admin/register', $data);
    }
  
    public function save()
    {        
        $request = service('request');
        helper(['form']);
        $data = [
            'meta_title' => 'แก้ไขข้อมูล'
        ];
        $rules = [
            'ac_email'          => [
                'rules' => 'required|valid_email|is_unique[tbl_admin.account]',
                'errors'    =>  [
                    'required'  =>  'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
                    'valid_email'   =>  'รูปแบบอีเมลไม่ถูกต้อง',
                    'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
                ]
            ],
            'ac_password'       => [
                'rules' =>  'required|min_length[6]|max_length[200]',
                'errors'    =>  [
                    'required'  =>  'กรุณากรอกรหัสผ่าน',
                    'min_length'   =>  'รหัสผ่านอย่างน้อย 6 ตัวอักษร'
                ]
            ],
            'ac_password_cf'    => [
                'rules' =>  'matches[ac_password]',
                'errors'    =>  [
                    'matches'  =>  'รหัสผ่านไม่ตรงกัน'
                ]
            ]           
        ];
        
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'account'    => $request->getVar('ac_email'),
                'password' => password_hash($request->getVar('ac_password'), PASSWORD_DEFAULT),
                'name'    => $request->getVar('ac_name'),
                'lastname'    => $request->getVar('ac_lastname'),
                'tel'    => $request->getVar('ac_tel'),
                'address'    => $request->getVar('ac_address'),
                'status'    => $request->getVar('ac_status')
            ];
            $model->save($data);
            return redirect()->to('admin/account');
        }else{
            if($request->getPost()){
                $data['validation'] = $this->validator;
                echo view('admin/register',$data);
            }else{
                return redirect()->to('admin/account');
            }
        }
    }

    public function update()
    {                
        helper(['form']);
        $request = service('request');
        $model = new UserModel();
        
        $id = $request->getVar('hd_id');
        $acc = $request->getVar('hd_ac_email');
        $pwd = $request->getVar('ac_password');
        $update = [];
        if($pwd!=''){
            $rules = [
                'ac_password'       => [
                    'rules' =>  'required|min_length[6]|max_length[200]',
                    'errors'    =>  [
                        'required'  =>  'กรุณากรอกรหัสผ่าน',
                        'min_length'   =>  'รหัสผ่านอย่างน้อย 6 ตัวอักษร'
                    ]
                ],
                'ac_password_cf'    => [
                    'rules' =>  'matches[ac_password]',
                    'errors'    =>  [
                        'matches'  =>  'รหัสผ่านไม่ตรงกัน'
                    ]
                ]
            ];

            if($this->validate($rules)){
                if($pwd!=''){
                    $update = [
                        'password' => password_hash($pwd, PASSWORD_DEFAULT),
                        'name'    => $request->getVar('ac_name'),
                        'lastname'    => $request->getVar('ac_lastname'),
                        'tel'    => $request->getVar('ac_tel'),
                        'address'    => $request->getVar('ac_address'),
                        'status'    => $request->getVar('ac_status')
                    ];
                    $model->update($acc, $update);
                    return redirect()->to('admin/account');
                }
            }else{
                if($request->getPost()){
                    $data = [
                        'meta_title' => 'แก้ไขข้อมูล',
                        'action'    =>  'update',
                        'validation'    =>  $this->validator,
                        'validfail' =>  TRUE,
                        'info'  =>  $model->where('account',$acc)->first()
                    ];
                    echo view('admin/register',$data);
                }else{
                    return redirect()->to('admin/account');
                }
            }
        }else{        
            $update = [
                'name'    => $request->getVar('ac_name'),
                'lastname'    => $request->getVar('ac_lastname'),
                'tel'    => $request->getVar('ac_tel'),
                'address'    => $request->getVar('ac_address'),
                'status'    => $request->getVar('ac_status')
            ];
            $result = $model->update($id, $update);
            if($result){
                return redirect()->to('admin/account');
            }
        }                
    }

    public function delete()
    {
        $model = new UserModel();
        echo 'deleted';
        //$data['deleted'] = $model->where('id', $id)->delete($id);
    }
  
}
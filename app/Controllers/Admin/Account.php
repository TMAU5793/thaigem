<?php 

namespace App\Controllers\Admin;
  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class Account extends Controller
{   
    public function __construct()
    {
        
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
        $request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url('admin/account'));
        }
        $data = [
            'meta_title' => 'เพิ่มบัญชีผู้ดูแล',
            'action'    =>  'save',
        ];
        echo view('admin/register', $data);
    }

    public function edit()
    {
        if (!session()->get('logged_admin')) {
            return redirect()->to('/admin');
        }
        
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
        helper(['form']);
        $request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url('admin/account'));
        }
        
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'action'    =>  'save'
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
            return redirect()->to(site_url('admin/account'));
        }else{
            $data['validation'] = $this->validator;
            echo view('admin/register',$data);
        }
    }

    public function update()
    {                
        helper(['form']);
        $request = service('request');
        $model = new UserModel();
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url('admin/account'));
        }

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
                $update = [
                    'password' => password_hash($pwd, PASSWORD_DEFAULT),
                    'name'    => $request->getVar('ac_name'),
                    'lastname'    => $request->getVar('ac_lastname'),
                    'tel'    => $request->getVar('ac_tel'),
                    'address'    => $request->getVar('ac_address'),
                    'status'    => $request->getVar('ac_status')
                ];
                $model->update($id, $update);
                return redirect()->to(site_url('admin/account'));
            }else{
                $data = [
                    'meta_title' => 'แก้ไขข้อมูล',
                    'action'    =>  'update',
                    'validation'    =>  $this->validator,
                    'validfail' =>  TRUE,
                    'info'  =>  $model->where('account',$acc)->first()
                ];
                echo view('admin/register',$data);
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
                return redirect()->to(site_url('admin/account'));
            }
        }                
    }

    public function delete()
    {
        $request = service('request');
        $model = new UserModel();
        if($request->getPost('id')){
            $id = $request->getPost('id');
            $deleted = $model->where('id', $id)->delete($id);
            echo $deleted;
        }else{
            return redirect()->to(site_url('admin/account'));
        }
    }
  
}
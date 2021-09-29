<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\MemberModel;
use CodeIgniter\I18n\Time;
  
class Member extends Controller
{
    
    public function updateProfile()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_member');
        $model = new MemberModel();
        $request = service('request');
        $post = $request->getPost();
        if($post){
            $email = '';
            $builder->where('id', $post['hd_id']);
            $query = $builder->get();
            foreach ($query->getResult() as $row) {
                $email = $row->email;
            }
            if($post['txt_email'] == $email){
                $result = $model->updateProfile($post);
                if($result){
                    return redirect()->to($request->getGet('burl'));
                }
            }else{
                $rules = [
                    'txt_email' => [
                        'rules' => 'required|valid_email|is_unique[tbl_member.email]',
                        'errors' =>  [
                            'required' => 'กรุณากรอกอีเมล',
                            'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                            'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
                        ]
                    ]
                ];
        
                if($this->validate($rules)){
                    $result = $model->updateProfile($post);
                    if($result){
                        return redirect()->to($request->getGet('burl'));
                    }
                }else{
                    $data['validation'] = $this->validator;
                    echo view('account/ac-account',$data);
                }
            }
        }
    }
}
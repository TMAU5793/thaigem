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
        helper('filesystem');

        $post = $request->getPost();
        if($post){
            $email = '';
            $builder->where('id', $post['hd_id']);
            $query = $builder->get();
            $thumb = $request->getFile('txt_profile'); //เก็บไฟล์รูปอัพโหลด
            $img_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม

            foreach ($query->getResult() as $row) {
                $email = $row->email;
            }
            if($post['txt_email'] == $email){
                $result = $model->updateProfile($post);
                if($result){
                    $this->upload($post['hd_id'],$thumb,$img_del);
                    return redirect()->to($request->getGet('burl'));
                }else{
                    print_r($db->error()); 
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
                    }else{
                        print_r($db->error()); 
                    }
                }else{
                    $data['validation'] = $this->validator;
                    echo view('account/ac-account',$data);
                }
            }
        }
    }

    public function upload($id,$profile,$img_del)
	{
		helper(['form','fileystem']);
		$db = \Config\Database::connect();
        $builder = $db->table('tbl_member');
		
		$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
		$ext = $profile->getExtension();

		if ($profile->isValid() && !$profile->hasMoved() && in_array($ext, $allowed)){
			if(file_exists($img_del)){
				unlink($img_del); //ลบรูปเก่าออก
			}
			$newName = $profile->getRandomName();
			if (!is_dir('uploads/member/'.$id)) {
				mkdir('uploads/member/'.$id, 0777, TRUE);
				$profile->move('uploads/member/'.$id,$newName);
			}else{
				$profile->move('uploads/member/'.$id,$newName);
			}
			$thumb = [
				'profile' => 'uploads/member/'.$id.'/'.$newName
			];
            
            $builder->where('id', $id);
            $builder->update($thumb);
		}
	}
}
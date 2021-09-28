<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\MemberModel;

class Member extends Controller
{
	public function __construct()
    {
        
    }
	
	public function index()
	{
		$model = new MemberModel();
		$data = [
            'meta_title' => 'สมาชิกเว็บไซต์',
			'info' => $model->orderBy('status DESC, created_at DESC')->findAll()
        ];
		echo view('admin/member',$data);
	}

	public function form()
	{
		
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }

		helper(['form']);
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM tbl_provinces');
		$results = $query->getResultArray();

		$data = [
            'meta_title' => 'เพิ่มบัญชีสมาชิกเว็บไซต์',
			'action' => 'save',
			'provinces' => $results
        ];
		echo view('admin/member-form',$data);
	}

	public function edit()
    {
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
        
        //include helper form
        helper(['form']);
        $request = service('request');
        $model = new MemberModel();
        $id = $request->getGet('id');
                
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'action'    =>  'update',
            'info'  =>  $model->where('id',$id)->first()
        ];
        echo view('admin/member-form', $data);
    }

	public function save()
	{
		//print_r($_POST);
		helper(['form']);
		$request = service('request');
        if ($request->getMethod() !== 'post') {
            return redirect()->to(site_url('admin/member'));
        }
        $img_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
        $data = [
            'meta_title' => 'เพิ่มบัญชีสมาชิกเว็บไซต์',
            'action' => 'save'
        ];
        $rules = [
            'txt_account' => [
                'rules' => 'required|valid_email|is_unique[tbl_member.account]',
                'errors' =>  [
                    'required' => 'กรุณากรอกชื่อบัญชีผู้ใช้ (อีเมล)',
                    'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                    'is_unique' => 'อีเมลนี้ถูกใช้งานแล้ว'
                ]
            ],
            'txt_password' => [
                'rules' => 'required|min_length[6]|max_length[200]',
                'errors' => [
                    'required' => 'กรุณากรอกรหัสผ่าน',
                    'min_length' => 'รหัสผ่านอย่างน้อย 6 ตัวอักษร'
                ]
            ],
            'txt_password_cf' => [
                'rules' => 'matches[txt_password]',
                'errors' => [
                    'matches' => 'รหัสผ่านไม่ตรงกัน'
                ]
			],
			'txt_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'กรุณากรอกชื่อ',
				]
			],
			'txt_lastname' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'กรุณากรอกนามสกุล',
				]
			],
			'txt_phone' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'กรุณากรอกเบอร์โทร',
				]
			]
        ];
        
        if($this->validate($rules)){
            $model = new MemberModel();
			// $thumb = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
			// $allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
			// $ext = $thumb->getExtension();
			// $newName = "";

			// if ($thumb->isValid() && !$thumb->hasMoved() && in_array($ext, $allowed)){
			// 	$newName = $thumb->getRandomName();
			// 	if (!is_dir('uploads/articles')) {
			// 		mkdir('uploads/articles', 0777, TRUE);
			// 		$thumb->move('uploads/articles',$newName);
			// 	}else{
			// 		$thumb->move('uploads/articles',$newName);
			// 	}
			// }

            $data = [
                'account' => $request->getVar('txt_account'),
                'password' => password_hash($request->getVar('txt_password'), PASSWORD_DEFAULT),
                'name' => $request->getVar('txt_name'),
                'lastname' => $request->getVar('txt_lastname'),
				'email' => $request->getVar('txt_account'),
                'phone' => $request->getVar('txt_phone'),
				'type' => $request->getVar('rd_type'),
				'renew' => $request->getVar('member_expired'),
				'expired' => $request->getVar('member_expired'),
                'status' => $request->getVar('ddl_status')
            ];
            $model->save($data);
			$id = $model->getInsertID();
			$profile = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
			$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
			$ext = $profile->getExtension();

			if ($profile->isValid() && !$profile->hasMoved() && in_array($ext, $allowed)){
				$this->upload($id,$profile,$img_del);
			}
            return redirect()->to(site_url('admin/member'));
        }else{
            $data['validation'] = $this->validator;
            echo view('admin/member-form',$data);
        }
	}

	public function update()
	{
		helper(['form','filesystem']);
		//helper('filesystem');
		$model = new MemberModel();
		$request = service('request');
        if ($request->getMethod() == 'post') {
			$id = $request->getVar('hd_id');
			$acc = $request->getVar('hd_account');
			$pwd = $request->getVar('txt_password');
			$img_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
			$update = [];

			if($pwd!=''){
				$rules = [
					'txt_password' => [
						'rules' => 'required|min_length[6]|max_length[200]',
						'errors' => [
							'required' => 'กรุณากรอกรหัสผ่าน',
							'min_length' => 'รหัสผ่านอย่างน้อย 6 ตัวอักษร'
						]
					],
					'txt_password_cf' => [
						'rules' => 'matches[txt_password]',
						'errors' => [
							'matches' => 'รหัสผ่านไม่ตรงกัน'
						]
					],
					'txt_name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'กรุณากรอกชื่อ',
						]
					],
					'txt_lastname' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'กรุณากรอกนามสกุล',
						]
					],
					'txt_phone' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'กรุณากรอกเบอร์โทร',
						]
					]
				];
			
				if($this->validate($rules)){
					$update = [
						'password' => password_hash($request->getVar('txt_password'), PASSWORD_DEFAULT),
						'name' => $request->getVar('txt_name'),
						'lastname' => $request->getVar('txt_lastname'),
						'phone' => $request->getVar('txt_phone'),
						'type' => $request->getVar('rd_type'),
						'renew' => $request->getVar('member_expired'),
						'expired' => $request->getVar('member_expired'),
						'status' => $request->getVar('ddl_status')
					];
					$result = $model->update($id, $update);
					if($result){
						$profile = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
						$this->upload($id,$profile,$img_del);
						return redirect()->to(site_url('admin/member'));
					}
				}else{
					$data = [
						'meta_title' => 'แก้ไขข้อมูล',
						'action'    =>  'update',
						'validation'    =>  $this->validator,
						'validfail' =>  TRUE,
						'info'  =>  $model->where('account',$acc)->first()
					];
					echo view('admin/member-form',$data);
				}
			}else{
				$rules = [
					'txt_name' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'กรุณากรอกชื่อ',
						]
					],
					'txt_lastname' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'กรุณากรอกนามสกุล',
						]
					],
					'txt_phone' => [
						'rules' => 'required',
						'errors' => [
							'required' => 'กรุณากรอกเบอร์โทร',
						]
					]
				];
			
				if($this->validate($rules)){
					$update = [
						'name' => $request->getVar('txt_name'),
						'lastname' => $request->getVar('txt_lastname'),
						'phone' => $request->getVar('txt_phone'),
						'type' => $request->getVar('rd_type'),
						'renew' => $request->getVar('member_expired'),
						'expired' => $request->getVar('member_expired'),
						'status' => $request->getVar('ddl_status')
					];
					$result = $model->update($id, $update);
					if($result){
						$profile = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
						$this->upload($id,$profile,$img_del);
						return redirect()->to(site_url('admin/member'));
					}
				}else{
					$data = [
				        'meta_title' => 'แก้ไขข้อมูล',
				        'action' => 'update',
				        'validation' => $this->validator,
				        'info' => $model->where('account',$acc)->first()
				    ];
					echo view('admin/member-form',$data);
				}
			}
		}else{
			return redirect()->to(site_url('admin/member'));
        }
	}
	
	public function upload($id,$profile,$img_del)
	{
		helper(['form','profileystem']);
		$model = new MemberModel();
		
		$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
		$ext = $profile->getExtension();

		if ($profile->isValid() && !$profile->hasMoved() && in_array($ext, $allowed)){
			if($img_del){
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
			$model->update($id, $thumb);
		}
	}
}

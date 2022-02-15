<?php 

namespace App\Controllers\Account;
  
use CodeIgniter\Controller;
use App\Models\Account\MemberModel;
use App\Models\Account\AlbumModel;
use App\Models\Account\AccountModel;
use App\Models\FunctionModel;
use App\Models\MemberBusinessModel;
use CodeIgniter\I18n\Time;

class Member extends Controller
{
    protected $member_id;
    protected $udata;
    protected $lang;
    public function __construct()
    {
        helper('text');
        $sess = session()->get('userdata');
        if($sess){
            $this->udata = $sess;
            $this->member_id = $sess['id'];
        }

        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }
    }
    
    public function index()
    {
        return redirect()->to('account');
    }

    public function edit()
    {        
        helper('form');
        $request = service('request');
        $model = new AccountModel();
        $albummodel = new AlbumModel();
        $mbModel = new MemberModel();

        $getuser = $request->getGet('u');
        $code = explode('-',$getuser);
        $edituser = $code[1];
        $info = $model->where(['id'=>$this->member_id,'code'=>$edituser])->first();
        
        if(!$info){
            return redirect()->to('account');
        }
        $dealer_code = $info['dealer_code'];
        if($dealer_code==''){
            $dealer_code = $info['id'];
        }
 
        $db = db_connect();
		$tbl_mb_bus = $db->table('tbl_member_business');

        $data = [
            'ac_account' => TRUE,
            'lang' => $this->lang,
            'info' => $info,
            'album' => $albummodel->where('member_id',$this->member_id)->findAll(),
            'provinces' => $mbModel->getProvince(),
            'maincates' => $mbModel->getProductMainType(),
            'subcates' => $mbModel->getSubCategory(),
            'mainbusniess' => $mbModel->getBusinessMainType(),
            'subbusniess' => $mbModel->getSubBusiness(),
            'address' => $mbModel->getAddress(),
            'social' => $mbModel->getSocial(),
            'membercontact' => $mbModel->getContactByDealercode($dealer_code),
            'memberbusiness' => $mbModel->getMemberBusiness(),
            'mb_bus' => $tbl_mb_bus->where('member_id',$this->member_id)->get()->getRowArray()
        ];
        //print_r($address);
        echo view('account/ac-profile',$data);
    }

    public function updateProfile()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_member');
        $model = new MemberModel();
        $request = service('request');
        helper(['form','fileystem']);

        $post = $request->getPost();
        if($post){
            $email = '';
            $builder->where('id', $post['hd_id']);
            $query = $builder->get();            

            foreach ($query->getResult() as $row) {
                $email = $row->email;
            }
            if($post['txt_email'] == $email){
                $rules = [
                    
                    'txt_company' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกชื่อบริษัท'
                        ]
                    ],
                    'txt_companyphone' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกเบอร์โทรบริษัท'
                        ]
                    ],
                    'ddl_province' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกจังหวัด'
                        ]
                    ],
                    'txt_address' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกที่อยู่'
                        ]
                    ]
                ];
            }else{
                $rules = [
                   
                    'txt_company' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกชื่อบริษัท'
                        ]
                    ],
                    'txt_companyphone' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกเบอร์โทรบริษัท'
                        ]
                    ],
                    'ddl_province' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกจังหวัด'
                        ]
                    ],
                    'txt_address' => [
                        'rules' => 'required',
                        'errors' =>  [
                            'required' => 'กรุณากรอกที่อยู่'
                        ]
                    ]
                ];
            }
            if($this->validate($rules)){
                $result = $model->updateProfile($post);
                //$model->updateBusiness($post);
                if(!$result){
                    print_r($db->error());
                }

                $file_upload = $request->getFile('txt_profile'); //เก็บไฟล์รูปอัพโหลด
                $file_del = $request->getVar('hd_profile_del'); //เก็บค่าใว้เช็คถ้ามีรูปอยู่ ให้ลบรูป
                $this->upload($post['hd_id'],$file_upload,$file_del);
                
                $albummodel = new AlbumModel();
                $album = $albummodel->where('member_id',$post['hd_id'])->findAll();
                $no = 20-count($album);
                if ($request->getFileMultiple('file_album')) {
                    $n=0;
                    foreach($request->getFileMultiple('file_album') as $file) {
                        $n++;
                        if($n<=$no){
                            $this->uploadAlbum($post['hd_id'],$file);
                        }
                    }
                }
                //print_r($db->error());
                return redirect()->to('account')->with('msg_done',true);

                //print_r($post);
            }else{
                $model = new AccountModel();
                $albummodel = new AlbumModel();
                $fModel = new FunctionModel();
                $mbModel = new MemberModel();

                $info = $model->where('id',$this->member_id)->first();
                
                $dealer_code = $info['dealer_code'];
                if($dealer_code==''){
                    $dealer_code = $info['id'];
                }
                $data = [
                    'ac_account' => TRUE,
                    'lang' => $this->lang,
                    'info' => $info,
                    'album' => $albummodel->where('member_id',$this->member_id)->findAll(),
                    'provinces' => $fModel->getProvinceAll(),
                    'maincates' => $mbModel->getProductMainType(),
                    'subcates' => $mbModel->getSubCategory(),
                    'mainbusniess' => $mbModel->getBusinessMainType(),
                    'subbusniess' => $mbModel->getSubBusiness(),
                    'address' => $mbModel->getAddress(),
                    'social' => $mbModel->getSocial(),
                    'membercontact' => $mbModel->getContactByDealercode($dealer_code),
                    'memberbusiness' => $mbModel->getMemberBusiness(),
                    'validation' => $this->validator
                ];

                echo view('account/ac-profile',$data);
            }
        }
    }

    public function upload($id,$file_upload,$file_del)
	{
		helper(['form','fileystem']);
		$db = \Config\Database::connect();
        $image = \Config\Services::image();
        $builder = $db->table('tbl_member');
		
		$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
		$ext = $file_upload->getExtension();

		if ($file_upload->isValid() && !$file_upload->hasMoved() && in_array($ext, $allowed)){
			if(is_file($file_del)){
				unlink($file_del); //ลบรูปเก่าออก
			}
			$newName = 'profile-'.$file_upload->getRandomName();
            $path = 'uploads/member/'.$id;
			if (!is_dir('uploads/member/'.$id)) {
				mkdir('uploads/member/'.$id, 0777, TRUE);
				//$file_upload->move('uploads/member/'.$id,$newName);
                $image->withFile($file_upload)->fit(1000, 750, 'center')->save($path.'/'.$newName);
			}else{
				//$file_upload->move('uploads/member/'.$id,$newName);
                $image->withFile($file_upload)->fit(1000, 750, 'center')->save($path.'/'.$newName);
			}
			$thumb = [
				'profile' => 'uploads/member/'.$id.'/'.$newName
			];
            
            $builder->where('id', $id);
            $builder->update($thumb);
		}

        //print_r($file_upload);
	}

    public function uploadAlbum($id,$file)
	{
		helper(['form','fileystem']);
        $image = \Config\Services::image();
		$model = new AlbumModel();
		
		$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
		$ext = $file->getExtension();        

		if ($file->isValid() && !$file->hasMoved() && in_array($ext, $allowed)){
			$newName = $id.'-'.$file->getRandomName();
            $path = 'uploads/member/'.$id.'/album';
			if (!is_dir($path)) {
				mkdir($path, 0777, TRUE);
				//$file->move($path,$newName);
                $image->withFile($file)->fit(1000, 750, 'center')->save($path.'/'.$newName);
			}else{
				$image->withFile($file)->fit(1000, 750, 'center')->save($path.'/'.$newName);
			}
			$thumb = [
                'member_id' => $id,
				'images' => $path.'/'.$newName
			];
            
            $model->save($thumb);
		}
	}

    public function deleteAlbum()
    {
        $request = service('request');
        $model = new AlbumModel();
        $id = $request->getPost('id');
        if($id){
            $path = $model->where('id',$id)->first();
            $deleted = $model->where('id', $id)->delete($id);
            if($deleted && is_file($path['images'])){
                unlink($path['images']);
            }
            echo true;
        }else{
            return redirect()->to('account');
        }
    }

    public function deleteRow()
    {
        $request = service('request');
        $db = \Config\Database::connect();
        $id = $request->getPost('id');
        $tbl = $request->getPost('tbl');
        $builder = $db->table($tbl);
        
        if($id){
            $builder->where('id', $id);
            $query = $builder->delete();
            if($query){
                echo true;
            }
        }else{
            return redirect()->to('account');
        }
    }

    public function removeStr()
    {
        $request = service('request');
        $model = new MemberBusinessModel();

        $post = $request->getPost();
        if($post){
            $id = $post['id'];
            $key = $post['key'];
            $type = $post['type'];

            $info = $model->where('member_id',$id)->first();
            $arr = explode(',',$info[$type]);
            $arrdata = array_diff($arr,[$key, ' '.$key]);

            $pdata = '';
            foreach ($arr as $item){
                $pdata .= $item.',';
                //echo $item;
            }
            
            // $data = [
            //     $type => substr($pdata,0,-1)
            // ];
            // $model->update($id,$data);
            // echo $key;
            print_r($pdata);
        }else{
            return redirect()->to('account');
        }
    }

    public function account()
    {
        helper('form');
        $request = service('request');
        $model = new AccountModel();
        $mbModel = new MemberModel();

        $getuser = $request->getGet('u');
        $code = explode('-',$getuser);
        $edituser = $code[1];
        $info = $model->where(['id'=>$this->member_id,'code'=>$edituser])->first();
        
        if(!$info){
            return redirect()->to('account');
        }

        $data = [
            'ac_account' => TRUE,
            'lang' => $this->lang,
            'info' => $info,
            'provinces' => $mbModel->getProvince()
        ];
        echo view('account/ac-profile-2',$data);

        //print_r($info);
    }

    public function updateAccount()
    {
        helper(['form','fileystem']);
        $model = new AccountModel();
        $request = service('request');        

        $post = $request->getPost();
        if($post){
            $rules = [
                'txt_name' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกชื่อ'
                    ]
                ],
                'txt_phone' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกเบอร์โทรศัพท์'
                    ]
                ],
                'txt_email' => [
                    'rules' => 'required|valid_email',
                    'errors' =>  [
                        'required' => 'กรุณากรอกที่อยู่',
                        'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง'
                    ]
                ],
                'txt_country' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกประเทศ'
                    ]
                ]
            ];
            if($this->validate($rules)){
                $arr = explode(" ",$post['txt_name']);
                $name = $arr[0];
                $lastname = $arr[1];
                $data = [
                    'name' => $name,
                    'lastname' => $lastname,
                    'phone' => $post['txt_phone'],
                    'email' => $post['txt_email'],
                    'company' => $post['txt_company'],
                    'country' => $post['txt_country']
                ];
                $model->update($post['hd_id'],$data);

                $file_upload = $request->getFile('txt_profile'); //เก็บไฟล์รูปอัพโหลด
                $file_del = $request->getVar('hd_profile_del'); //เก็บค่าใว้เช็คถ้ามีรูปอยู่ ให้ลบรูป
                $this->upload($post['hd_id'],$file_upload,$file_del);

                return redirect()->to('account')->with('msg_done',true);
                //print_r($post);
            }else{
                $info = $model->where('id',$this->member_id)->first();
                $data = [
                    'ac_account' => TRUE,
                    'lang' => $this->lang,
                    'info' => $info,
                    'validation' => $this->validator
                ];

                echo view('account/ac-profile-2',$data);
            }
        }else{
            return redirect()->to('account');
        }
    }

    public function update_password()
    {
        helper('form');
        $request = service('request');
        $model = new AccountModel();

        $post = $request->getPost();
        $rules = [
            'txt_password'       => [
                'rules' =>  'required|min_length[6]|max_length[200]',
                'errors'    =>  [
                    'required'  =>  lang('accountLang.pwd-put'),
                    'min_length'   =>  lang('accountLang.pwd-limit')
                ]
            ],
            'txt_confirmpassword'    => [
                'rules' =>  'matches[txt_password]',
                'errors'    =>  [
                    'matches'  =>  lang('accountLang.pwd-match')
                ]
            ],
        ];
        
        if($this->validate($rules)){
            $id = $this->member_id;
            $pwd_arr = [
                'password' => password_hash($post['txt_password'], PASSWORD_DEFAULT)
            ];
            
            $model->update($id,$pwd_arr);
            return redirect()->to('account')->with('msg_done',TRUE);
        }else{
            $validator = [
                'password' => $this->validator->getError('txt_password'),
                'confirmpassword' => $this->validator->getError('txt_password')
            ];
            return redirect()->to('account')->with('failpwd',$validator);            
        }
    }
}
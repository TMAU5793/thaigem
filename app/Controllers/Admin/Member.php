<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\MemberModel;
use App\Models\SettingModel;
use App\Models\Account\MemberModel as acMemberModel;
use App\Models\Account\AlbumModel;
use App\Models\FilesModel;
use App\Models\NotiModel;

class Member extends Controller
{
	protected $logged;
	public function __construct()
    {
        $admindata = session()->get('admindata');
        if($admindata){
            $this->logged = $admindata;
        }
    }
	
	public function index()
	{
		return redirect()->to('admin/member/dealer');
	}

	public function dealer()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		$model = new MemberModel();
		$request = service('request');
		$pager = \Config\Services::pager();

		$keyword = $request->getGet('keyword');
		$status = $request->getGet('status');

		$info = $model->getDealer($status,$keyword);
        $page=(int)(($request->getVar('page')!==null)?$request->getVar('page'):1)-1;
        $perPage =  25;
        $total = count($info);
        $pager->makeLinks($page+1, $perPage, $total);
        $offset = $page * $perPage;
        $result = $model->getDealer($status,$keyword,$perPage,$offset);
		
		$data = [
            'meta_title' => 'สมาชิกสมาคมฯ',
			'info' =>  $result,
			'active' => 'dealer'
        ];
		//print_r($info);
		echo view('admin/member',$data);
	}

	public function subscribe()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		$model = new MemberModel();
		$request = service('request');
		$pager = \Config\Services::pager();
		
		$keyword = $request->getGet('keyword');
		$status = $request->getGet('status');
        if($keyword==''){
			$keyword = null;
		}
		$info = $model->getMember($keyword);
        $page=(int)(($request->getVar('page')!==null)?$request->getVar('page'):1)-1;
        $perPage =  25;
        $total = count($info);
        $pager->makeLinks($page+1, $perPage, $total);
        $offset = $page * $perPage;
        $result = $model->getMember($keyword,$perPage,$offset);
		
		$data = [
            'meta_title' => 'สมาชิกเว็บไซต์',
			'info' => $result,
            'pager' => $model->pager,
			'active' => 'member'
        ];
		echo view('admin/member',$data);
	}

	public function form()
	{
		
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }

		helper(['form']);
		$albummodel = new AlbumModel();
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM tbl_provinces ORDER BY sortby ASC AND name_th ASC');
		$results = $query->getResultArray();

		$data = [
            'meta_title' => 'เพิ่มบัญชีสมาชิกเว็บไซต์',
			'action' => 'save',
			'provinces' => $results,
			'album' => $albummodel->where('member_id',$this->member_id)->findAll(),
        ];
		echo view('admin/member-form',$data);
	}

	public function edit()
    {
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
        
        //include helper form
        helper(['form','fileystem']);
        $request = service('request');
        $model = new MemberModel();
		$acmbModel = new acMemberModel();
		$albummodel = new AlbumModel();

		$db = db_connect();
		$social = $db->table('tbl_social');
		$tbl_provinces = $db->table('tbl_provinces');
		$tbl_mb_bus = $db->table('tbl_member_business');

        $id = $request->getGet('id');
        $address = $acmbModel->getAddressById($id);
		$get_social = $social->where('member_id',$id)->get()->getRowArray();
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'action'    =>  'update',
            'info_member'  =>  $model->where('id',$id)->first(),
			'provinces' => $tbl_provinces->orderBy('sortby ASC, name_th ASC')->get()->getResultArray(),
			'provinceId' => $acmbModel->getProvinceById($address->province_id),
			'amphure' => $acmbModel->getAmphureById($address->amphure_id),
			'district' => $acmbModel->getDistrictById($address->district_id),
			'address' =>  $address,
			'social' => $get_social,
			'album' => $albummodel->where('member_id',$id)->findAll(),
			'membercontact' => $acmbModel->getMemberContact(),
			'memberbusiness' => $acmbModel->getMemberBusiness(),
			'maincates' => $acmbModel->getProductMainType(),
			'subcates' => $acmbModel->getSubCategory(),
			'mainbusniess' => $acmbModel->getBusinessMainType(),
			'subbusniess' => $acmbModel->getSubBusiness(),
			'mb_bus' => $tbl_mb_bus->where('member_id',$id)->get()->getRowArray()
        ];
        echo view('admin/member-form', $data);
    }

	public function save()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

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
            $model = new MemberModel();			

            $data = [
                'account' => $request->getVar('txt_account'),
                'password' => password_hash($request->getVar('txt_password'), PASSWORD_DEFAULT),
                'name' => $request->getVar('txt_name'),
                'lastname' => $request->getVar('txt_lastname'),
				'email' => $request->getVar('txt_account'),
                'phone' => $request->getVar('txt_phone'),
				'type' => $request->getVar('rd_type'),
				'dealer_code' => $request->getVar('dealer_code'),
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
	}

	public function update()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		helper(['form','filesystem']);
		$model = new MemberModel();
		$acModel = new acMemberModel();
		$albummodel = new AlbumModel();
		$request = service('request');

		$post = $request->getPost();
		
        if ($post) {

			$id = $post['hd_id'];
			$arr = explode(" ",$post['txt_mainperson']);
			$name = $arr[0];
			$lastname = $arr[1];
			$ws = explode('//',$post['txt_website']);
			//echo count($ws);
			if(count($ws) > 1){
				$ws = $post['txt_website'];
			}else{
				$ws = 'http://'.$post['txt_website'];
			}

			if($post['txt_password']!=''){
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
					]
				];
        
				if($this->validate($rules)){
					$data = [						
						'password' => password_hash($post['txt_password'], PASSWORD_DEFAULT),
						'company' => $post['txt_company'],
						'name' => $name,
            			'lastname' => $lastname,
						'email' => $post['txt_email'],
						'phone' => $post['txt_phone'],
						'website' => $ws,
						'type' => $post['rd_type'],
						'dealer_code' => $post['dealer_code'],
						'renew' => $post['member_start'],
						'member_expired' => $post['member_expired'],
						'status' => $post['ddl_status']
					];
					$model->update($id, $data);

					$acModel->updateAddress($post);
					
					$file_upload = $request->getFile('txt_profile'); //เก็บไฟล์รูปอัพโหลด
					$file_del = $request->getVar('hd_profile_del'); //เก็บค่าใว้เช็คถ้ามีรูปอยู่ ให้ลบรูป
					$this->upload($post['hd_id'],$file_upload,$file_del);
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
				}else{
					helper(['form']);
					$model = new MemberModel();
					$acmbModel = new acMemberModel();
					$db = db_connect();
					$social = $db->table('tbl_social');

					$id = $post['hd_id'];
					$address = $acmbModel->getAddressById($id);
					$get_social = $social->where('member_id',$id)->get()->getRowArray();
					$data = [
						'meta_title' => 'แก้ไขข้อมูล',
						'action'    =>  'update',
						'info_member'  =>  $model->where('id',$id)->first(),
						'province' => $acmbModel->getProvinceById($address->province_id),
						'amphure' => $acmbModel->getAmphureById($address->amphure_id),
						'district' => $acmbModel->getDistrictById($address->district_id),
						'address' =>  $address,
						'social' => $get_social,
						'validation' => $this->validator
					];
					
					echo view('admin/member-form',$data);
				}
			}else{
				//print_r($post);
				
				$arr = [
					'company' => $post['txt_company'],
					'email' => $post['txt_email'],
					'name' => $name,
            		'lastname' => $lastname,
					'phone' => $post['txt_phone'],
					'website' => $ws,
					'type' => $post['rd_type'],
					'dealer_code' => $post['dealer_code'],
					'renew' => $post['member_start'],
					'member_expired' => $post['member_expired'],
					'status' => $post['ddl_status']
				];
				$model->update($id, $arr);
				print_r($model->errors());

				$acModel->updateAddress($post);

				$file_upload = $request->getFile('txt_profile'); //เก็บไฟล์รูปอัพโหลด
                $file_del = $request->getVar('hd_profile_del'); //เก็บค่าใว้เช็คถ้ามีรูปอยู่ ให้ลบรูป
                $this->upload($post['hd_id'],$file_upload,$file_del);

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
			}

			$db = db_connect();
			$builder = $db->table('tbl_social');
			$ckd = $builder->where('member_id',$id)->get()->getRow();
			$date = date('Y-m-d H:i:s');
			if($ckd){
				$social = [
					'line' => $post['txt_line'],
					'facebook' => $post['txt_facebook'],
					'instagram' => $post['txt_instagram'],
					'linkein' => $post['txt_linkein'],
					'youtube' => $post['txt_youtube'],
					'updated_at' => $date
				];
				$builder->where('id',$id)->update($social);
			}else{
				$social = [
					'member_id' => $id,
					'line' => $post['txt_line'],
					'facebook' => $post['txt_facebook'],
					'instagram' => $post['txt_instagram'],
					'linkein' => $post['txt_linkein'],
					'youtube' => $post['txt_youtube'],
					'created_at' => $date,
					'updated_at' => $date
				];
				$builder->where('id',$id)->update($social);
			}
		}
		
		return redirect()->to('admin/member');
	}
	
	public function upload($id,$profile,$img_del)
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		helper(['form','fileystem']);
		$model = new MemberModel();
		$image = \Config\Services::image();
		
		$allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
		$ext = $profile->getExtension();

		if ($profile->isValid() && !$profile->hasMoved() && in_array($ext, $allowed)){
			if($img_del){
				unlink($img_del); //ลบรูปเก่าออก
			}
			
			$newName = 'profile-'.$profile->getRandomName();
            $path = 'uploads/member/'.$id;
			if (!is_dir('uploads/member/'.$id)) {
				mkdir('uploads/member/'.$id, 0777, TRUE);
				$image->withFile($profile)->fit(1000, 750, 'center')->save($path.'/'.$newName);
			}else{
				$image->withFile($profile)->fit(1000, 750, 'center')->save($path.'/'.$newName);
			}
			$thumb = [
				'profile' => 'uploads/member/'.$id.'/'.$newName
			];
			$model->update($id, $thumb);
		}
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

	public function display()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

		$model = new MemberModel();
		$request = service('request');

		$info = $model->select('*,tbl_member.status as approve')->join('tbl_address as B','B.member_id = tbl_member.id')
                ->where('tbl_member.member_home','1')->paginate(25);
		$data = [
            'meta_title' => 'รายการสมาชิกแสดงที่หน้า Home',
			'info' =>  $info,
			'pager' => $model->pager,
			'active' => 'display'
        ];
		//print_r($info);
		echo view('admin/member-show-home',$data);
	}

	public function show()
	{
		if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
		
		$model = new MemberModel();
		$request = service('request');

		$id = $request->getPost('id');
		$show = $request->getPost('show');
		if($id){
			if($show=='1'){
				$show = '0';
			}else{
				$show = '1';
			}
			$model->update($id,['member_home'=>$show]);
			echo TRUE;
		}
	}

	public function setting()
	{
		$request = service('request');
		$model = new SettingModel();

		$post = $request->getPost();

		if(!$post){
			$data = [
				'info' => $model->where('type','member_filter')->first()
			];
			echo view('admin/member-setting',$data);
		}else{
			$member_filter = $model->where('type','member_filter')->first();			
			$data = [
				'page' => 'member',
				'type' => 'member_filter',
				'desc' => $post['filter_member']
			];

			if($member_filter){
				$model->update($member_filter['id'],$data);
			}else{
				$model->save($data);
			}
			return redirect()->to('admin/member/dealer');
		}
	}

	public function fileupload()
	{
		if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
        
        //include helper form
        helper(['form','fileystem']);
        $request = service('request');
        $model = new MemberModel();
		$filesModel = new FilesModel();
		$db = db_connect();
		$files = $db->table('tbl_files');

        $id = $request->getGet('id');
		$member = $model->where('id',$id)->first();

		$data = [
			'member' => $member,
			'info' => $filesModel->where('member_id',$id)->orderBy('created_at DESC')->paginate(25),
            'pager' => $filesModel->pager,
		];
		//print_r($data['m_doc']);
		echo view('admin/member-file',$data);
	}

	public function notification()
	{
		if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
        
        //include helper form
        helper(['form','fileystem']);
        $request = service('request');
        $model = new MemberModel();
		$notiModel = new NotiModel();
		$db = db_connect();
		$noti = $db->table('tbl_notification');

        $id = $request->getGet('id');
		$member = $model->where('id',$id)->first();

		$data = [
			'member' => $member,
			'info' => $notiModel->where('member_id',$id)->orderBy('created_at DESC')->paginate(25),
            'pager' => $notiModel->pager,
		];
		//print_r($data['m_doc']);
		echo view('admin/member-noti',$data);
	}

	public function savenotification()
	{
		if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }

		$notiModel = new NotiModel();
		$request = service('request');
		$post = $request->getPost();
		if($post){
			$data = [
				'member_id' => $post['hd_member'],
				'title_th' => $post['txt_title'],
				'title_en' => $post['txt_title_en'],
				'desc_th' => $post['txt_msg'],
				'desc_en' => $post['txt_msg_en']
			];
			$notiModel->save($data);
		}
		
		return redirect()->to('/admin/member');
	}
}

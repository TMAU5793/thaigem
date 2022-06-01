<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\Admin\EventModel;
use App\Models\BookingModel;
use App\Models\MemberModel;

class Event extends Controller
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
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $model = new EventModel();
        $request = service('request');
		$keyword = $request->getGet('keyword');
		$info = $model->orderBy('status DESC, created_at DESC')->paginate(25);
		if($keyword){
            $info = $model->like('name',$keyword)->orLike('name_en',$keyword)->orderBy('status DESC, created_at DESC')->paginate(25);
        }

		$data = [
            'meta_title' => 'อีเว้นท์',
            'info' => $info,
            'pager' => $model->pager,
        ];
		echo view('admin/event',$data);
	}

    public function form()
    {
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }

        helper(['form']);
        $data = [
            'meta_title' => 'เพิ่มอีเว้นท์',
            'action'    =>  'save',
        ];
        echo view('admin/event-form', $data);
    }

    public function save()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        helper(['form']);
        $model = new EventModel();
        $request = service('request');
        $data = [
            'meta_title' => 'เพิ่มอีเว้นท์',
            'action'    =>  'save'
        ];
        $thumb = $request->getFile('txt_thumb');

        if ($request->getMethod() == 'post') {
            $rules = [
                'txt_title' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกข้อมูลหัวข้อ'
                    ]
                ],
                'txt_desc' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณากรอกรข้อมูลรายละเอียด'
                    ]
                ],
                'hd_thumb' => [
                    'rules' => 'required',
                    'errors' =>  [
                        'required' => 'กรุณาใส่รูปภาพ Thumbnail'
                    ]
                ]
            ];
            
            if($this->validate($rules)){
                $thumb = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
                $allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
                $ext = $thumb->getExtension();
                $newName = "";

                $date = explode('-',$request->getPost('txt_date'));
                $slug = url_title(strtolower($request->getVar('txt_slug')));
                if($request->getVar('txt_slug')=="" && $request->getVar('txt_title_en')==""){
                    $slug = url_title(strtolower($request->getVar('txt_title')));
                }else{
                    $slug = url_title(strtolower($request->getVar('txt_title_en')));
                }
                $data = [
                    'name' => $request->getVar('txt_title'),
                    'name_en' => $request->getVar('txt_title_en'),
                    'shortdesc' => $request->getVar('txt_shortdesc'),
                    'shortdesc_en' => $request->getVar('txt_shortdesc_en'),
                    'desc' => $request->getVar('txt_desc'),
                    'desc_en' => $request->getVar('txt_desc_en'),
                    'slug' => $slug,
                    'meta_title' => ($request->getVar('meta_title')!=""?$request->getVar('meta_title'):$request->getVar('txt_title')),
                    'meta_title_en' => ($request->getVar('meta_title_en')!=""?$request->getVar('meta_title_en'):$request->getVar('txt_title_en')),
                    'meta_desc' => $request->getVar('meta_desc'),
                    'meta_desc_en' => $request->getVar('meta_desc_en'),
                    'status' => $request->getVar('txt_status'),
                    'home_show' => $request->getVar('txt_home_show'),
                    'start_event' => $date[0],
                    'end_event' => $date[1],
                    'booth' => $request->getVar('txt_booth')
                ];
                $model->save($data);
                $id = $model->getInsertID();
                if ($thumb->isValid() && !$thumb->hasMoved() && in_array($ext, $allowed)){
                    
                    if (!is_dir('uploads/event')) {
                        mkdir('uploads/event', 0777, TRUE);
                        $this->resizeImg($id,$thumb,600,400,'uploads/event'); //id,file,width,height,path
                    }else{
                        $this->resizeImg($id,$thumb,600,400,'uploads/event'); //id,file,width,height,path
                    }
                }
                return redirect()->to(site_url('admin/event'));
            }else{
                $data['validation'] = $this->validator;
                echo view('admin/event-form',$data);
            }
        }else{
            return redirect()->to(site_url('admin/event'));
        }        
    }

    public function edit(){
        if (!session()->get('admindata')) {
            return redirect()->to('/admin');
        }
        
        //include helper form
        helper(['form']);
        $request = service('request');
        $model = new EventModel();
        $id = $request->getGet('id');
                
        $data = [
            'meta_title' => 'แก้ไขข้อมูล',
            'action'    =>  'update',
            'info'  =>  $model->where('id',$id)->first()
        ];
        echo view('admin/event-form', $data);
    }

    public function update()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        helper(['form']);
        helper('filesystem');
        $request = service('request');
        $model = new EventModel();
        if ($request->getMethod() == 'post') {
            $id = $request->getVar('hd_id'); //เก็บค่า id
            $thumb = $request->getFile('txt_thumb'); //เก็บไฟล์รูปอัพโหลด
            $hd_thumb = $request->getVar('hd_thumb'); //เก็บไฟล์รูปเดิม เพื่อนำมาเช็คว่ามีการเปลี่ยนรูปใหม่หรือไม่
            $hd_thumb_del = $request->getVar('hd_thumb_del'); //เก็บข้อมูลรูป เพื่อจะนำไปเช็คว่ามีรูปอยู่ไหม
            $allowed = ['png','jpg','jpeg']; //ไฟล์รูปที่อนุญาติให้อัพโหลด
            $ext = $thumb->getExtension();
            
            if ($hd_thumb!=$hd_thumb_del){
                if(is_file($hd_thumb_del)){
                    unlink($hd_thumb_del); //ลบรูปเก่าออก
                }
                
                if (!is_dir('uploads/event')) {
					mkdir('uploads/event', 0777, TRUE);
                    $this->resizeImg($id,$thumb,600,400,'uploads/event'); //file,width,height,path
				}else{
                    $this->resizeImg($id,$thumb,600,400,'uploads/event'); //file,width,height,path
                }                
            }

            $date = explode('-',$request->getPost('txt_date'));
            $slug = url_title(strtolower($request->getVar('txt_slug')));
            if($slug==""){
                $slug = url_title(strtolower($request->getVar('txt_title')));
                if($slug==""){
                    $slug = url_title(strtolower($request->getVar('txt_title_en')));
                }
            }
            $update = [
                'name' => $request->getVar('txt_title'),
                'name_en' => $request->getVar('txt_title_en'),
                'shortdesc' => $request->getVar('txt_shortdesc'),
                'shortdesc_en' => $request->getVar('txt_shortdesc_en'),
                'desc' => $request->getVar('txt_desc'),
                'desc_en' => $request->getVar('txt_desc_en'),
                'slug' => $slug,
                'meta_title' => ($request->getVar('meta_title')!=""?$request->getVar('meta_title'):$request->getVar('txt_title')),
                'meta_title_en' => ($request->getVar('meta_title_en')!=""?$request->getVar('meta_title_en'):$request->getVar('txt_title_en')),
                'meta_desc' => $request->getVar('meta_desc'),
                'meta_desc_en' => $request->getVar('meta_desc_en'),
                'status' => $request->getVar('txt_status'),
                'home_show' => $request->getVar('txt_home_show'),
                'start_event' => $date[0],
                'end_event' => $date[1],
                'booth' => $request->getVar('txt_booth')
            ];
            if($model->update($id, $update)){
                return redirect()->to(site_url('admin/event'));
            }else{
                print_r($model->error());
            }
        }else{
            return redirect()->to(site_url('admin/event'));
        }

        //print_r($request->getPost());
    }

    public function resizeImg($id,$file,$w,$h,$path)
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $model = new EventModel();
        $newName = $id.'-'.$file->getRandomName();

        $image = \Config\Services::image()
        ->withFile($file)
        ->fit($w, $h, 'center')
        ->save($path.'/'.$newName);

        $thumb = [
            'thumbnail' => 'uploads/event/'.$newName
        ];
        $model->update($id, $thumb);
    }


    public function booking()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $pager = \Config\Services::pager();
        $evModel = new EventModel();
        $bkModel = new BookingModel();
        $mbModel = new MemberModel();
        $request = service('request');
		$keyword = $request->getGet('keyword');
        $status = $request->getGet('status');
        $file = $request->getGet('file');
        $pay = $request->getGet('pay');
        
		$info = $bkModel->getBooking($status,$file,$pay,$keyword);
        $page=(int)(($request->getVar('page')!==null)?$request->getVar('page'):1)-1;
        $perPage =  25;
        $total = count($info);
        $pager->makeLinks($page+1, $perPage, $total);
        $offset = $page * $perPage;
        $result = $bkModel->getBooking($status,$file,$pay,$keyword,$perPage,$offset);
                
		$data = [
            'meta_title' => 'การจองอีเว้นท์',
            'info' => $result,
            'members' => $mbModel->where(['type'=>'dealer','status'=>'2'])->findAll(),
            'events' => $evModel->findAll()
        ];
        //print_r($info->getResult());
		echo view('admin/event-booking',$data);
    }

    public function bookinginfo()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $request = service('request');
        $evModel = new EventModel();
        $bkModel = new BookingModel();
        $mbModel = new MemberModel();
        $id = $request->getGet('id');
        if($id){
            $booking = $bkModel->where('booking_no',$id)->first();
            $data = [
                'meta_title' => 'รายละเอียดการจอง',
                'info' => $booking,
                'member' => $mbModel->where('id',$booking['member_id'])->first(),
                'event' => $evModel->where('id',$booking['event_id'])->first()
            ];
            //print_r($booking);
            echo view('admin/event-info',$data);
        }else{
            return redirect()->to('admin/event/booking');
        }
    }

    public function bookingstatus()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        $bkModel = new BookingModel();
        $request = service('request');
        $post = $request->getPost();
        //print_r($post);

        if($post){
            $date = date('Y-m-d H:i:s');
            $id = $post['hd_id'];
            $data = [
                'status' => $post['ddl_status'],
                'file_status' => $post['file_status'],
                'payment' => $post['pay_status'],
                'updated_at' => $date
            ];
            $bkModel->update($id, $data);
        }
        return redirect()->to('admin/event/booking');
    }

    public function delete()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        
        $request = service('request');
        $model = new EventModel();
        if($request->getPost('id')){
			$id = $request->getPost('id');
            $delImg = $model->where('id',$id)->first();
			if(is_file($delImg['thumbnail'])){
				unlink($delImg['thumbnail']); //ลบรูปเก่าออก
			}            
            $deleted = $model->where('id', $id)->delete($id);				
			echo TRUE;
            
        }else{
            return redirect()->to(site_url('admin/event'));
        }
    }
}
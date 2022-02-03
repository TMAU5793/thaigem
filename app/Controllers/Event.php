<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\Admin\EventModel;
use App\Models\BookingModel;
use App\Models\MemberModel;
use App\Models\Account\MemberModel as MemberFucntion;
use App\Models\BannerModel;

class Event extends BaseController
{
    protected $lang;
    protected $member_id;
    protected $userdata;
    public function __construct() {        
        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }

        $usersess = session()->get('userdata');
        if($usersess){
            $this->userdata = $usersess;
            $this->member_id = $usersess['id'];
        }
    }

	public function index()
	{   
        $model = new EventModel();
        $banner =new BannerModel();
        $db = db_connect();
        $tbl_month = $db->table('tbl_month');

        $data = [
            'meta_title' => 'Event',
            'info' => $model->where('status','on')->orderby('created_at','DESC')->paginate(9),
			'pager' => $model->pager,
            'lang' => $this->lang,
            'banner' => $banner->where(['page'=>'event','status'=>'1'])->orderBy('sortby ASC, created_at DESC')->first(),
            'month' => $tbl_month->get()->getResultArray()
        ];
        
        echo view('front/event', $data);
	}

    public function post()
    {
        $model = new EventModel();
        $bkModel = new BookingModel();
        $mbModel = new MemberModel();
        $db = db_connect();
        $tbl_month = $db->table('tbl_month');

        $uri = service('uri');
        $segment3 = $uri->getSegment(3);
        $segment3 = urldecode($segment3);

        $row = $model->where('slug',$segment3)->first();
        if(!$row){
            $row = $model->where('id',$segment3)->first();
            $sql = "UPDATE tbl_event SET view=view+1 WHERE id = '$segment3'";
            $model->query($sql);
        }else{
            $sql = "UPDATE tbl_event SET view=view+1 WHERE slug = '$segment3'";
            $model->query($sql);
        }
        
        $data = [
            'meta_title' => ($this->lang=='en' && $row['meta_title_en']!=""?$row['meta_title_en']:$row['meta_title']),
            'meta_desc' => ($this->lang=='en' && $row['meta_desc_en']!=""?$row['meta_desc_en']:$row['meta_desc']),
            'info' => $row,
            'lang' => $this->lang,
            'booking' => $bkModel->where(['member_id'=>$this->member_id,'event_id'=>$row['id']])->first(),
            'member' => $mbModel->where('id',$this->member_id)->first(),
            'month' => $tbl_month->get()->getResultArray()
        ];
        
        echo view('front/event-desc', $data);
    }

    public function booking()
    {
        $bkModel = new bookingModel();
        $mbFunction = new MemberFucntion();
        $request = service('request');
        $post = $request->getPost();
        $booking_no = $this->bookingNo();
        
        $ckdBooking = $bkModel->where(['event_id'=>$post['event_id'],'member_id'=>$post['member_id']])->first();
        if($ckdBooking){
            echo 'booked';
        }else{
            $savedata = [
                'booking_no' => $booking_no,
                'event_id' => $post['event_id'],
                'member_id' => $post['member_id'],
            ];

            if($bkModel->insert($savedata)){
                
                $noti_arr = [
                    'member_id' => $post['member_id'],
                    'type' => 'event',
                    'title_th' => 'แบบฟอร์มการจองอีเว้นท์',
                    'desc_th' => 'กรุณาดาวน์โหลดแบบฟอร์มการจองอีเว้นท์ที่เมนู ดาวน์โหลด และอัปโหลดเอกสาร > ดาวน์โหลดเอกสารอีเว้นท์ และอัพโหลดไฟล์กลับมาเมื่อกรอกข้อมูลเรียบร้อย',
                    'title_en' => 'Event booking form',
                    'desc_en' => 'Please download the event booking form from the menu DOWNLOAD & UPLOAD FORM > Download Form Event and upload the file back once the information is complete',

                ];
                $mbFunction->notification($noti_arr);
                //$this->mailBooking($savedata);
                echo true;
            }
        }
    }
    public function testBooking()
    {
        $savedata = [
            'booking_no' => 'B211122-000000005',
            'event_id' => 1,
            'member_id' => 11,
        ];
        // print_r($savedata);
        $this->mailBooking($savedata);
    }
    public function mailBooking($data=null)
    {
        $email = \Config\Services::email();
        
        if($data){
            $mbModel = new MemberModel();
            $evModel = new EventModel();
            $bkModel = new bookingModel();

            $member = $mbModel->where('id',$data['member_id'])->first();
            $booking = $bkModel->where('booking_no',$data['booking_no'])->first();
            $event = $evModel->where('id',$booking['event_id'])->first();
            //print_r($event);
            $mailTo = 'thank@grasp.asia';
            $mailCC = 'jan@grasp.asia';
            $mailBCC = 'thip@grasp.asia';

            $email->setFrom($member['email'], $member['company']);
            $email->setTo($mailTo);
            $email->setCC($mailCC);
            $email->setBCC($mailBCC);
            if($this->lang=='en'){
                $email->setSubject('TGJTA : Event Booking');
                $msg = "<strong>reservation information</strong>";
                $msg .= "<p>event : ".$event['name_en']."</p>";
                $msg .= "<p>booker : ".$member['company']."</p>";
                $msg .= "<p>phone : ".$member['company_phone']."</p>";
                $msg .= "<p>email : ".$member['email']."</p>";
            }else{
                $email->setSubject('TGJTA : การจองงานอีเว้นท์');
                $msg = "<strong>ข้อมูลการจอง</strong>";
                $msg .= "<p>งานอีเว้นท์ : ".$event['name']."</p>";
                $msg .= "<p>ผู้จอง : ".$member['company']."</p>";
                $msg .= "<p>เบอร์โทร : ".$member['company_phone']."</p>";
                $msg .= "<p>อีเมล : ".$member['email']."</p>";
            }
            $email->setMessage($msg);
            //echo $msg;
            if($email->send()){
                return redirect()->to('')->with('msg_done','true');
            }else{
                $email->printDebugger();
            }
        }else{
            return redirect()->to('');
        }
    }

    public function bookingNo()
    {
        $db = \Config\Database::connect();
        $date = new Time('now');
		$yymmdd = date_format($date, 'ymd')."-";
	    $str="B";
	    $code=$str.$yymmdd."000000001";
        //echo $code;
	    $query = $db->query("SELECT booking_no FROM tbl_booking ORDER BY booking_no DESC");
        $results = $query->getNumRows();
        //echo $results;
	    if($results>0) {
            $num = $results;
            switch(strlen($num+1)){
                case 1:{$str=$str.$yymmdd."00000000".($num+1);}break;
                case 2:{$str=$str.$yymmdd."0000000".($num+1);}break;
                case 3:{$str=$str.$yymmdd."000000".($num+1);}break;
                case 4:{$str=$str.$yymmdd."00000".($num+1);}break;
                case 5:{$str=$str.$yymmdd."0000".($num+1);}break;
                case 6:{$str=$str.$yymmdd."000".($num+1);}break;
                case 7:{$str=$str.$yymmdd."00".($num+1);}break;
                case 8:{$str=$str.$yymmdd."0".($num+1);}break;
                case 9:{$str=$str.$yymmdd.($num+1);}break;
            }
            return  $str;
	    }else{
	        return $code;
	    }
    }
    
}

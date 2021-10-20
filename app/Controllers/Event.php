<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\Admin\EventModel;
use App\Models\BookingModel;
use App\Models\MemberModel;

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

        $data = [
            'meta_title' => 'Event',
            'info' => $model->orderby('created_at','DESC')->paginate(9),
			'pager' => $model->pager,
            'lang' => $this->lang
        ];
        
        echo view('front/event', $data);
	}

    public function post()
    {
        $model = new EventModel();
        $bkModel = new BookingModel();
        $mbModel = new MemberModel();
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
            'member' => $mbModel->where('id',$this->member_id)->first()
        ];
        
        echo view('front/event-desc', $data);
    }

    public function booking()
    {
        $bkModel = new bookingModel();
        // $db = \Config\Database::connect();
        // $builder = $db->table('tbl_booking');
        $request = service('request');
        $post = $request->getPost();
        $booking_no = $this->bookingNo();
        
        $savedata = [
            'booking_no' => $booking_no,
            'event_id' => $post['event_id'],
            'member_id' => $post['member_id'],
        ];

        if($bkModel->insert($savedata)){
            echo true;
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

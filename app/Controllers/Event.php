<?php

namespace App\Controllers;
use App\Models\Admin\EventModel;
use CodeIgniter\I18n\Time;

class Event extends BaseController
{
    protected $lang;
    public function __construct() {        
        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
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
            'lang' => $this->lang
        ];
        
        echo view('front/event-desc', $data);
    }

    public function booking()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_booking');
        $request = service('request');
        $post = $request->getPost();
        $booking_no = $this->bookingNo();

        $builder->where(['event_id' => $post['event_id']]);
        $ckdevent = $builder->get();
        print_r($ckdevent);
        // $savedata = [
        //     'booking_no' => $booking_no,
        //     'event_id' => $post['event_id'],
        //     'member_id' => $post['member_id'],
        // ];
        // //print_r($savedata);

        // if($builder->insert($savedata)){
        //     echo true;
        // }
    }

    public function bookingNo()
    {
        $db = \Config\Database::connect();
        $date = new Time('now');
		$yymmdd = date_format($date, 'ymd')."-";
        //echo $yymmdd;

		$date_start = date_format($date, 'Y-m-d')." 00:00:00";
		$date_end = date_format($date, 'Y-m-d')." 23:23:59";
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

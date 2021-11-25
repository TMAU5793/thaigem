<?php 

namespace App\Controllers\Account;
use App\Models\Admin\EventModel;
use App\Models\BookingModel;
  
use CodeIgniter\Controller;
  
class Event extends Controller
{   
    protected $member_id;
    protected $udata;
    protected $lang;
    public function __construct()
    {
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
        if($this->udata['user_type']!='dealer'){
            return redirect()->to('');
        }
        
        helper('text');
        $bkModel = new BookingModel();
        $evModel = new EventModel();
        
        $data = [
            'ac_event' => TRUE,
            'lang' => $this->lang,
            'meta_title' => 'My Event',
            'bookings' => $bkModel->where('member_id',$this->member_id)->findAll(),
            'events' => $evModel->findAll(),            
        ];
        echo view('account/ac-event',$data);
    }

    public function list()
    {
        if($this->udata['user_type']!='dealer'){
            return redirect()->to('');
        }
        
        helper('text');
        $evModel = new EventModel();

        $data = [
            'ac_event' => TRUE,
            'lang' => $this->lang,
            'meta_title' => 'Events List',
            'events' => $evModel->findAll(),
            'eventlist' => 1
        ];

        //print_r($data['events']);
        echo view('account/ac-event-list',$data);
    }
}
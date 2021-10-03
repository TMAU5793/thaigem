<?php

namespace App\Controllers;

class Event extends BaseController
{
	public function index()
	{        
        $data = [
            'meta_title' => 'Event US'
        ];
        
        echo view('front/event', $data);
	}

    public function desc()
    {
        $data = [
            'meta_title' => 'Event Title',
            'meta_desc' => 'Event Description'
        ];
        
        echo view('front/event-desc', $data);
    }
}

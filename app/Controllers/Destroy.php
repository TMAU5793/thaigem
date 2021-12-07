<?php

namespace App\Controllers;

class Destroy extends BaseController
{
	public function index()
	{        
        session()->destroy();
		return redirect()->to('');
	}
}

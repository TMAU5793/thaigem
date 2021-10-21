<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Language extends BaseController
{
    public function index()
    {
        $session = session();
        $locale = $this->request->getLocale();
        //$session->remove('lang');
        $session->set('lang', $locale);
        //$url = base_url();
        $url = $_GET['burl'];
        return redirect()->to($url);        
    }
}
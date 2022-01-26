<?php
namespace App\Controllers;
use App\Controllers\BaseController;
 
class Excelexport extends BaseController
{
 
    public function index()
    {
        return view('export');
    }
 
}
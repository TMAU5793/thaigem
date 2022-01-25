<?php

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exportexcel extends Controller
{
    public function index() {
 
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_member');
   
        // $query = $builder->query("SELECT * FROM tbl_member");
   
        $users = $builder->get()->getResultArray();
         
        $fileName = 'users.xlsx';  
        $spreadsheet = new Spreadsheet();
   
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Code');   
        $rows = 2;
   
        foreach ($users as $val){
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['name']);
            $sheet->setCellValue('C' . $rows, $val['email']);
            $sheet->setCellValue('D' . $rows, $val['dealer_code']);
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
        $writer->save("uploads/".$fileName);
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url()."/uploads/".$fileName); 

        // print_r($users);
    }
}
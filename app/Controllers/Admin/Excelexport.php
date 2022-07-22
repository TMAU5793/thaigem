<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\MemberModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
class Excelexport extends Controller
{
    protected $logged;
	public function __construct()
    {
        $admindata = session()->get('admindata');
        if($admindata){
            $this->logged = $admindata;
        }
    }

    public function dealer() {
    
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        
        helper('text');
        $model = new MemberModel();
        $date = date('Y-m-d');
        $str = random_string('alnum', 4);
        $data = $model->where('type','dealer')->findAll();        
        $fileName = 'member-tgjta '.$date.strtolower($str).'.xlsx';
        $spreadsheet = new Spreadsheet();
    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Code');
        $sheet->setCellValue('B1', 'Company');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Phone');
        $sheet->setCellValue('E1', 'Employee');
        $sheet->setCellValue('F1', 'Member start');
        $sheet->setCellValue('G1', 'Member expired');
        $sheet->setCellValue('H1', 'Status');
        $sheet->setCellValue('I1', 'Last login');
        $rows = 2;

        foreach ($data as $val){
            $sheet->setCellValue('A' . $rows, $val['dealer_code']);
            $sheet->setCellValue('B' . $rows, $val['company']);
            $sheet->setCellValue('C' . $rows, $val['email']);
            $sheet->setCellValue('D' . $rows, $val['company_phone']);
            $sheet->setCellValue('E' . $rows, $val['employee']);
            $sheet->setCellValue('F' . $rows, $val['member_start']);
            $sheet->setCellValue('G' . $rows, $val['member_expired']);
            $sheet->setCellValue('H' . $rows, ($val['status']=='2'?'approve':'On Process'));
            $sheet->setCellValue('I' . $rows, $val['last_login']);
            $rows++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. basename($fileName) .'"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function subscribe() {
    
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }

        helper('text');
        $model = new MemberModel();
        $date = date('Y-m-d');
        $str = random_string('alnum', 4);
        $data = $model->where('type','member')->findAll();
        $fileName = 'member-subscribe '.$date.strtolower($str).'.xlsx';
        $spreadsheet = new Spreadsheet();
    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Apply By');
        $sheet->setCellValue('D1', 'Last login');
        $rows = 2;

        foreach ($data as $val){
            $sheet->setCellValue('A' . $rows, $val['name'].' '.$val['lastname']);
            $sheet->setCellValue('B' . $rows, $val['email']);
            $sheet->setCellValue('C' . $rows, $val['social_type']);
            $sheet->setCellValue('C' . $rows, $val['last_login']);
            $rows++;
        }
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. basename($fileName) .'"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

    }

    public function export_excel()
    {
        if(!$this->logged['logged_admin']){
            return redirect()->to('admin');
        }
        $request = service('request');
        $type = $request->getGet('type');
        if($type){
            $model = new MemberModel();
            $data['info'] = $model->where('type',$type)->findAll();
            $data['type'] = $type;
            
            echo view('report/member',$data);
        }
    }
 
}
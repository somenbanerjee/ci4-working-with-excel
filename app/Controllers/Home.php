<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function index(): string
    {
        $employeeModel = new EmployeeModel();
        $data['employees'] = $employeeModel->orderBy('id', 'DESC')->findAll();
        return view("home", $data);
    }


    public function download($type = 'excel')
    {
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->findAll();
        $headers = ['Sl No', 'name', 'email', 'designation', 'experience'];

        $currentTime = date('d-m-Y-h-m-s');
        $fileName = 'employees-' . $currentTime;

        if ($type === 'excel') {
            $this->generateExcel($fileName, $headers, $employees);
        }
        if ($type === 'pdf') {
            // maybe call to generatePdf()
        }
        exit;
    }

    protected function generateExcel($fileName, $headers, $dataSet)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $fileName =  $fileName . '.xlsx';

        $row = 1;
        $asciiA = 65;
        foreach ($headers as $header) {
            $sheet->setCellValue(chr($asciiA) . $row, $header);
            chr($asciiA++);
        }

        $row = 2;
        $asciiA = 65;
        $slNo = 1;

        if (!empty($dataSet)) {
            foreach ($dataSet as $data) {
                $sheet->setCellValue(chr($asciiA++) . $row, $slNo);
                $sheet->setCellValue(chr($asciiA++) . $row, $data['name']);
                $sheet->setCellValue(chr($asciiA++) . $row, $data['email']);
                $sheet->setCellValue(chr($asciiA++) . $row, $data['designation']);
                $sheet->setCellValue(chr($asciiA++) . $row, $data['experience']);

                $row++;
                $slNo++;
                $asciiA = 65;
            }
        }

        $writer = new Xlsx($spreadsheet);

        $writer->save($fileName);

        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');

        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        flush();
        readfile($fileName);
        return true;
    }
}

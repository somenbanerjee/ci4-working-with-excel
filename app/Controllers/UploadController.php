<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;
use App\Models\EmployeeModel;

class UploadController extends BaseController
{
    public function index()
    {
        return view("upload");
    }

    public function upload()
    {
        $validationRules = [
            'excelFile' => [
                'label' => 'Excel File',
                'rules' => [
                    'uploaded[excelFile],
                    max_size[excelFile,500],
                    ext_in[excelFile,xlsx]'
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            $this->session->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to(site_url());
        }

        $excelFile =  $this->request->getFile('excelFile');
        $tempName = $excelFile->getTempName();

        $reader = new excel();
        $spreadsheet = $reader->load($tempName);
        $arrayData = $spreadsheet->getActiveSheet()->toArray();

        array_splice($arrayData, 0, 1);
        if (!empty($arrayData)) {
            $employeeModel = new EmployeeModel();
            $data = [];
            foreach ($arrayData as $value) {
                if (empty($value[0])) break;
                $isEmployee = $employeeModel->where('email', $value[2])->first();

                if (!$isEmployee)
                    $data[] = [
                        'name' => $value[1],
                        'email' => $value[2],
                        'designation' => $value[3],
                        'experience' => $value[4],
                    ];
            }

            if (!empty($data)) {
                $employeeModel->insertBatch($data);
                $this->session->setFlashdata('success', 'Data successfully inserted.');
            } else {
                $this->session->setFlashdata('error', 'Excel sheet is empty or all data are duplicate.');
            }
        } else {
            $this->session->setFlashdata('error', 'Excel sheet is empty');
        }
        return redirect()->to(site_url('/upload'));
    }
}

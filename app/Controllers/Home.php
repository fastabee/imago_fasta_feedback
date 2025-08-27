<?php

namespace App\Controllers;

use App\Models\ModelUser;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Config\Database;

class Home extends BaseController
{

    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new ModelUser();
    }

    public function index()
    {



        $data = array(
            'body' => 'dashboard',
            'user' => $this->UserModel->getUser(),
        );
        return view('template', $data);
    }


    public function index2(): string
    {
        $data = array(
            'body' => 'tabel',
            'user' => $this->UserModel->getUser(),
        );
        return view('template', $data);
    }

    public function mpdf_tes()
    {

        $data = array(
            'fasta' => 'fasta'
        );

        $html = view('ao', $data);

        error_reporting(0);

        $mpdf = new \Mpdf\Mpdf(['curlUserAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:108.0) Gecko/20100101 Firefox/108.0']);

        ob_end_clean();

        $mpdf->curlAllowUnsafeSslRequests = true;

        $this->response->setHeader('Content-Type', 'application/pdf');

        $this->response->setHeader('Content-Transfer-Encoding', 'binary');

        $this->response->setHeader('Accept-Ranges', 'bytes');

        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output());
    }

    public function tes_excell()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $datauser = $this->UserModel->getUser();

        // Header Titles
        $headers = [
            'A1' => 'Nama',
            'B1' => 'Username',
            'C1' => 'Email',

        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Styling Header
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFDCE6F1');

        // Data Rows
        $row = 2;
        foreach ($datauser as $item) {


            $sheet->setCellValue('A' . $row, $item->nama);
            $sheet->setCellValue('B' . $row, $item->username);
            $sheet->setCellValue('C' . $row, $item->email);

            $row++;
        }

        // Auto Width
        foreach (range('A', 'C') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }


        $sheet->getStyle('A1:C' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);


        $sheet->freezePane('A2');




        $filename = 'DataUser_' . date('Ymd_His') . '.xlsx';


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}

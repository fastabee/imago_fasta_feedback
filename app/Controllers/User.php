<?php

namespace App\Controllers;



use Config\Database;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Models\ModelUser;

class User extends BaseController

{

    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new ModelUser();
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UploadController extends BaseController
{
    public function index()
    {
        return view("upload");
    }
}

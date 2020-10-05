<?php
namespace Dashboard\Controllers;
use App\Controllers\Basecontroller;

class Dashboard extends BaseController {

    public function index() {
        $data = [];

        echo view('templates/header', $data);
        echo view('Dashboard\Views\dashboard');
        echo view('templates/footer');
       
    }

    //--------------------------------------------------------------------
}

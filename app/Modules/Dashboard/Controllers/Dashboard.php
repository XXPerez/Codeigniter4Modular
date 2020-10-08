<?php
namespace Dashboard\Controllers;
use App\Controllers\Basecontroller;

class Dashboard extends BaseController {

    public function index() {
        $data = [];

        return  view('Dashboard\Views\dashboard', $data);
       
    }

    //--------------------------------------------------------------------
}

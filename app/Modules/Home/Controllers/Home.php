<?php
namespace Home\Controllers;
use App\Controllers\BaseController;

class Home extends BaseController {

    public function index() {
        $data = [];
        helper(['form']);
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url() . '/login');
        }

        return  view('Home\Views\home', $data);
       
    }

    //--------------------------------------------------------------------
}

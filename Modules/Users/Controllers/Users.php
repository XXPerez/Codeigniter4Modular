<?php
namespace Users\Controllers;

use App\Controllers\BaseController;
use Users\Libraries\UsersLib;

class Users extends BaseController {

    protected $usersLib;

    public function __construct() {
        $this->usersLib = new UsersLib();
    }

    public function login() {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url() . '/');
        }

        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $response = $this->usersLib->login();

            if ($response->status != \Utils\Libraries\UtilsResponseLib::$SUCCESS) {
                $data['validation'] = $response->error->validation;
            } else {
                $redirectUri = session()->getFlashdata('redirectUri');
                if ($redirectUri != '') {
                    return redirect()->to($redirectUri);
                } else {
                    return redirect()->to(base_url() . '/');
                }
            }
        }
        $redirectUri = session()->getFlashdata('redirectUri');
        if ($redirectUri != '') {
            session()->keepFlashdata('redirectUri');
        }
        
        return view('Users\Views\login', $data);
    }

    public function logout() {
        $logout = $this->usersLib->logout();
        return redirect()->to(base_url() . '/');
    }

    public function register() {

        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $response = $this->usersLib->register();
            if ($response->status != \Utils\Libraries\UtilsResponseLib::$SUCCESS) {
                $data['validation'] = $response->error->validation;
            } else {
                return redirect()->to(base_url() . '/login');
            }
        }

        return view('Users\Views\register', $data);
    }

    public function profile() {

        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('fmode') == 'cancel') {
                return redirect()->to(base_url() . '/');
            }
            $response = $this->usersLib->profile();
            if ($response->status != \Utils\Libraries\UtilsResponseLib::$SUCCESS) {
                $data['validation'] = $response->error->validation;
            } else {
                return redirect()->to(base_url() . '/profile');
            }
        }

        $data['user'] = $this->usersLib->getuserById();

        return view('Users\Views\profile', $data);
    }

}

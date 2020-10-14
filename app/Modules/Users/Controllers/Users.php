<?php
namespace Users\Controllers;

use App\Controllers\Basecontroller;
use Users\Models\UsersModel;
use Users\Libraries\UsersLib;

class Users extends BaseController {

    protected $usersLib;

    public function __construct() {
        $this->usersLib = new UsersLib();
    }

    public function login() {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url() . '/dashboard');
        }

        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $response = $this->usersLib->login();
            if ($response->status != \Utils\Libraries\UtilsResponseLib::$SUCCESS) {
                $data = $response->error;
            } else {
                return redirect()->to(base_url() . '/dashboard');
            }
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
                $data = $response->error;
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
                return redirect()->to(base_url() . '/dashboard');
            }
            $response = $this->usersLib->profile();
            if ($response->status != \Utils\Libraries\UtilsResponseLib::$SUCCESS) {
                $data = $response->error;
            } else {
                return redirect()->to(base_url() . '/profile');
            }
        }

        $data['user'] = $this->usersLib->getuserById();

        return view('Users\Views\profile', $data);
    }

}

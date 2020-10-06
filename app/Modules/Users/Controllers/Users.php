<?php
namespace Users\Controllers;

use App\Controllers\Basecontroller;
use Users\Models\UserModel;
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
            $response = $this->usersLib->login($this->request);
            if ($response->status == 'error') {
                $data = $response->data;
            } else {
                return redirect()->to(base_url() . '/dashboard');
            }
        }

        echo view('templates/header', $data);
        echo view('Users\Views\login');
        echo view('templates/footer');
    }

    public function logout() {
        $response = $this->usersLib->logout();
        return redirect()->to(base_url() . '/');
    }

    public function register() {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $response = $this->usersLib->register($this->request);
            if ($response->status == 'error') {
                $data = $response->data;
            } else {
                return redirect()->to(base_url() . '/login');
            }
        }

        echo view('templates/header', $data);
        echo view('Users\Views\register');
        echo view('templates/footer');
    }

    public function profile() {

        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $response = $this->usersLib->profile($this->request);
            if ($response->status == 'error') {
                $data = $response->data;
            } else {
                return redirect()->to(base_url() . '/profile');
            }
        }

        $data['user'] = $this->usersLib->getuserById()->data;

        echo view('templates/header', $data);
        echo view('Users\Views\profile');
        echo view('templates/footer');
    }

}

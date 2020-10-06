<?php
namespace Users\Libraries;

use Users\Models\UserModel;
use Utils\Libraries\UtilsResponseLib;

class UsersLib {

    use UtilsResponseLib;

    public function getUserByEmail($email) {
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)
                ->first();
        return $user;
    }

    public function login() {
        $request = \Config\Services::request();
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
        ];
        $errors = [
            'password' => [
                'validateUser' => lang('Users.form.login.badlogin')
            ]
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules, $errors);
        $validation->withRequest($request)->run();
        $validationErrors = $validation->getErrors();

        if (!empty($validationErrors)) {
            $data['validation'] = $validation;
            return $this->setResponse(UtilsResponseLib::$ERROR, $data);
        } else {
            $user = $this->getUserByEmail($request->getVar('email'));
            $this->setUserLogged($user);
            return $this->setResponse(UtilsResponseLib::$SUCCESS, $user);
        }
    }

    public function register() {
        $request = \Config\Services::request();
        $rules = [
            'firstname' => 'required|min_length[3]|max_length[20]',
            'lastname' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'matches[password]',
        ];
        $errors = [];

        $validation = \Config\Services::validation();
        $validation->setRules($rules, $errors);
        $validation->withRequest($request)->run();
        $validationErrors = $validation->getErrors();

        if (!empty($validationErrors)) {
            $data['validation'] = $validation;
            return $this->setResponse(UtilsResponseLib::$ERROR, $data);
        } else {
            $userModel = new UserModel();
            $newData = [
                'firstname' => $request->getVar('firstname'),
                'lastname' => $request->getVar('lastname'),
                'email' => $request->getVar('email'),
                'password' => $request->getVar('password'),
            ];
            $data = $userModel->save($newData);
            if ($data) {
                $session = session();
                $session->setFlashdata(UtilsResponseLib::$SUCCESS, lang('Users.register.created'));
                return $this->setResponse(UtilsResponseLib::$SUCCESS, $data);
            } else {
                $data['Errors'] = 'Undefined';
                return $this->setResponse(UtilsResponseLib::$ERROR, $data);
            }
        }
    }

    public function profile() {
        $request = \Config\Services::request();
        $rules = [
            'firstname' => 'required|min_length[3]|max_length[20]',
            'lastname' => 'required|min_length[3]|max_length[20]',
        ];
        if ($request->getPost('password') != '') {
            $rules['password'] = 'required|min_length[8]|max_length[255]';
            $rules['password_confirm'] = 'matches[password]';
        }
        $errors = [];

        $validation = \Config\Services::validation();
        $validation->setRules($rules, $errors);
        $validation->withRequest($request)->run();
        $validationErrors = $validation->getErrors();

        if (!empty($validationErrors)) {
            $data['validation'] = $validation;
            return $this->setResponse(UtilsResponseLib::$ERROR, $data);
        } else {
            $newData = [
                'id' => session()->get('id'),
                'firstname' => $request->getPost('firstname'),
                'lastname' => $request->getPost('lastname'),
            ];
            if ($request->getPost('password') != '') {
                $newData['password'] = $request->getPost('password');
            }

            $userModel = new UserModel();
            $data = $userModel->save($newData);

            $session = session();
            $session->setFlashdata(UtilsResponseLib::$SUCCESS, lang('Users.register.updated'));
            return $this->setResponse(UtilsResponseLib::$SUCCESS, $data);
        }
    }

    public function getUserById($id = 0) {
        if ($id === 0) {
            $id = session()->get('id');
        }
        $userModel = new UserModel();
        $user = $userModel->where('id', $id)->first();
        return $this->setResponse(UtilsResponseLib::$SUCCESS, $user);
    }

    public function logout() {
        if (session()->get('isLoggedIn')) {
            session()->destroy();
            return true;
        } else {
            return false;
        }
    }

    private function setUserLogged($user) {
        $data = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }

}

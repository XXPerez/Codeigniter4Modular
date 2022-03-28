<?php
namespace Users\Validation;

use Users\Models\UsersModel;

class UsersRules {

    public function validateUser(string $str, string $fields, array $data) {
        $model = new UsersModel();
        $user = $model->where('email', $data['email'])
                ->first();
        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user->password);
    }

}

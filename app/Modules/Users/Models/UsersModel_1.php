<?php
namespace Users\Models;

use CodeIgniter\Model;

class UsersModel extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $allowedFields = ['firstname', 'lastname', 'email', 'password', 'updated_at'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        $data['data']['password'] = $this->passwordHash($data['data']['password']);
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function beforeUpdate(array $data) {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = $this->passwordHash($data['data']['password']);
        }
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function passwordHash($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

}

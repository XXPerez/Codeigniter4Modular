<?php 
namespace Users\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['firstname','lastname','email','password','updated_at'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
     
    protected function beforeInsert(array $data) 
    {
        $data['data']['password'] = $this->passwordHash($data['data']['password']);
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }
    protected function beforeUpdate(array $data) 
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = $this->passwordHash($data['data']['password']);
        }
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
    protected function passwordHash($password) 
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }
}


<?php
namespace App\Models;

class User extends BaseModel {
    protected $collection = 'users';

    public function __construct($db) { parent::__construct($db); }

    public function create($name, $email, $password, $role='student') {
        $doc = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'streak' => 0,
            'created_at' => date('c')
        ];
        return $this->insert($doc);
    }

    public function findByEmail($email) {
        return $this->find(['email' => $email]);
    }

    public function verify($email, $password) {
        $u = $this->findByEmail($email);
        if (!$u) return false;
        if (password_verify($password, $u['password'])) return $u;
        return false;
    }
}

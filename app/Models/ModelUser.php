<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id', 'username', 'password', 'email', 'nama'];
    public function getUser()
    {
        return $this->findAll();
    }

    public function cekEmail($email)
    {
        return $this->where('email', $email)
            ->get();
    }
}

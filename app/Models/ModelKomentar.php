<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKomentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id', 'user_iduser', 'product_idproduct', 'komentar', 'foto', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getKomentar()
    {
        return $this->findAll();
    }

    public function getKomentarById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getKomentarByUser($userId)
    {
        return $this->where('user_iduser', $userId)->findAll();
    }

    public function searchKomentar($keyword)
    {
        return $this->like('komentar', $keyword)->findAll();
    }

    public function getKomentarByProduct($productId)
    {
        return $this->select('komentar.*, user.nama')
            ->join('user', 'user.id = komentar.user_iduser')
            ->where('komentar.product_idproduct', $productId)
            ->orderBy('komentar.created_at', 'DESC')
            ->findAll();
    }
}

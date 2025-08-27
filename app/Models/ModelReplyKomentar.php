<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelReplyKomentar extends Model
{
    protected $table = 'reply_komentar';
    protected $primaryKey = 'idreply';
    protected $returnType = 'object';
    protected $allowedFields = ['idreply', 'komentar_idkomentar', 'komentar', 'user_iduser', 'foto', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getReply()
    {
        return $this->findAll();
    }

    public function getReplyById($idreply)
    {
        return $this->where('idreply', $idreply)->first();
    }



    public function searchReply($keyword)
    {
        return $this->like('komentar', $keyword)->findAll();
    }

    public function getReplyByKomentar($komentarId)
    {
        return $this->select('reply_komentar.*, user.nama')
            ->join('user', 'user.id = reply_komentar.user_iduser', 'left')
            ->where('komentar_idkomentar', $komentarId)
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }
}

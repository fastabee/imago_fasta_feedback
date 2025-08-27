<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduct extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'idproduct';
    protected $returnType = 'object';
    protected $allowedFields = ['idproduct', 'nama_product', 'foto_product', 'keterangan', 'created_at'];

    public function getProduct()
    {
        return $this->select('product.*, 
        COALESCE(jumlah_komentar.jumlah, 0) + COALESCE(jumlah_reply.jumlah, 0) as total_komentar')
            ->join(
                '(SELECT komentar.product_idproduct, COUNT(komentar.id) as jumlah 
                 FROM komentar 
                 GROUP BY komentar.product_idproduct) as jumlah_komentar',
                'jumlah_komentar.product_idproduct = product.idproduct',
                'left'
            )
            ->join(
                '(SELECT komentar.product_idproduct, COUNT(reply_komentar.idreply) as jumlah 
                 FROM reply_komentar 
                 JOIN komentar ON komentar.id = reply_komentar.komentar_idkomentar 
                 GROUP BY komentar.product_idproduct) as jumlah_reply',
                'jumlah_reply.product_idproduct = product.idproduct',
                'left'
            )
            ->findAll();
    }

    public function getProductById($idproduct)
    {
        return $this->select('product.*, 
        COALESCE(jumlah_komentar.jumlah, 0) + COALESCE(jumlah_reply.jumlah, 0) as total_komentar')
            ->join(
                '(SELECT komentar.product_idproduct, COUNT(komentar.id) as jumlah 
              FROM komentar 
              GROUP BY komentar.product_idproduct) as jumlah_komentar',
                'jumlah_komentar.product_idproduct = product.idproduct',
                'left'
            )
            ->join(
                '(SELECT komentar.product_idproduct, COUNT(reply_komentar.idreply) as jumlah 
              FROM reply_komentar 
              JOIN komentar ON komentar.id = reply_komentar.komentar_idkomentar 
              GROUP BY komentar.product_idproduct) as jumlah_reply',
                'jumlah_reply.product_idproduct = product.idproduct',
                'left'
            )
            ->where('product.idproduct', $idproduct)
            ->first();
    }


    public function searchProduct($keyword)
    {
        return $this->like('nama_product', $keyword)
            ->orLike('keterangan', $keyword)
            ->findAll();
    }
}

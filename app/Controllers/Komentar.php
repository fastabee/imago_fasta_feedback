<?php

namespace App\Controllers;

use App\Models\ModelKomentar;
use App\Models\ModelReplyKomentar;

class Komentar extends BaseController
{
    public function save()
    {
        $komentar = new ModelKomentar();
        $data = [
            'user_iduser' => session('id'),
            'product_idproduct' => $this->request->getPost('product_idproduct'),
            'komentar' => $this->request->getPost('komentar'),
        ];
        $komentar->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function reply()
    {
        $reply = new ModelReplyKomentar();
        $data = [
            'komentar_idkomentar' => $this->request->getPost('komentar_idkomentar'),
            'komentar' => $this->request->getPost('komentar'),
            'foto' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $reply->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete($id)
    {
        $komentar = new ModelKomentar();
        $data = $komentar->find($id);

        if ($data && $data->user_iduser == session('id')) {
            $komentar->delete($id);
            return $this->response->setJSON(['status' => 'deleted']);
        }
        return $this->response->setJSON(['status' => 'forbidden']);
    }

    public function getByProduct($product_id)
    {
        $komentar = new ModelKomentar();
        $reply = new ModelReplyKomentar();

        $dataKomentar = $komentar->where('product_idproduct', $product_id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        foreach ($dataKomentar as &$k) {
            $k->reply = $reply->where('komentar_idkomentar', $k->id)
                ->orderBy('created_at', 'ASC')
                ->findAll();
        }

        return $this->response->setJSON($dataKomentar);
    }
}

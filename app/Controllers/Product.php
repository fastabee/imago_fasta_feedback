<?php

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelKomentar;
use App\Models\ModelProduct;
use App\Models\ModelReplyKomentar;


class Product extends BaseController
{

    protected $UserModel;

    protected $session;

    protected $KomentarModel;
    protected $ProductModel;
    protected $ReplyKomentarModel;

    public function __construct()
    {
        $this->UserModel = new ModelUser();
        $this->session = \Config\Services::session();
        $this->KomentarModel = new ModelKomentar();
        $this->ProductModel = new ModelProduct();
        $this->ReplyKomentarModel = new ModelReplyKomentar();
    }

    public function index()
    {
        $data = array(
            'body' => 'product/list',
            'product' => $this->ProductModel->getProduct()
        );
        return view('template', $data);
    }

    public function detail($id)
    {
        $product = $this->ProductModel->getProductById($id);
        $komentar = $this->KomentarModel->getKomentarByProduct($id);

        foreach ($komentar as $k) {
            $k->reply = $this->ReplyKomentarModel->getReplyByKomentar($k->id);
        }

        $data = [
            'body' => 'product/detail',
            'product' => $product,
            'komentar' => $komentar
        ];

        return view('template', $data);
    }




    public function addKomentar()
    {
        if ($this->request->isAJAX()) {
            $productId = $this->request->getPost('product_id');
            $userId = session()->get('id');
            $komentar = $this->request->getPost('komentar');


            $foto = $this->request->getFile('foto');
            $namaFoto = null;
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $namaFoto = $foto->getRandomName();
                $foto->move(FCPATH . 'uploads/komentar', $namaFoto);
            }

            $this->KomentarModel->save([
                'product_idproduct' => $productId,
                'user_iduser'       => $userId,
                'komentar'          => $komentar,
                'foto'              => $namaFoto
            ]);

            return $this->response->setJSON(['status' => 'success']);
        }
    }

    public function deleteKomentar($id)
    {
        if ($this->request->isAJAX()) {

            $this->ReplyKomentarModel->where('komentar_idkomentar', $id)->delete();

            $this->KomentarModel->delete($id);

            return $this->response->setJSON(['status' => 'deleted']);
        }
    }

    public function addReply()
    {
        if ($this->request->isAJAX()) {
            $komentarId = $this->request->getPost('komentar_id');
            $userId     = session()->get('id');
            $reply      = $this->request->getPost('reply');


            $foto = $this->request->getFile('foto');
            $namaFoto = null;
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $namaFoto = $foto->getRandomName();
                $foto->move(FCPATH . 'uploads/reply', $namaFoto);
            }

            $this->ReplyKomentarModel->save([
                'komentar_idkomentar' => $komentarId,
                'user_iduser'         => $userId,
                'komentar'            => $reply,
                'foto'                => $namaFoto
            ]);

            return $this->response->setJSON(['status' => 'success']);
        }
    }

    public function deleteReply($idreply)
    {
        if ($this->request->isAJAX()) {
            $this->ReplyKomentarModel->delete($idreply);
            return $this->response->setJSON(['status' => 'deleted']);
        }
    }
}

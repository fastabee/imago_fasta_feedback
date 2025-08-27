<?php

namespace App\Controllers;

use App\Models\ModelUser;


class Login extends BaseController
{

    protected $UserModel;

    protected $session;

    public function __construct()
    {
        $this->UserModel = new ModelUser();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = array();
        return view('auth/login', $data);
    }
    public function login()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $cek_login = $this->UserModel->cekEmail($email);

        if ($cek_login->getNumRows() > 0) {
            $akun = $cek_login->getRowArray();
            $hashedPassword = $akun['password'];


            if (password_verify($password, $hashedPassword)) {
                $newSession = [
                    'id'       => $akun['id'],
                    'nama'     => $akun['nama'],
                    'username' => $akun['username'],
                    'email'    => $akun['email'],
                    'logged_in' => true
                ];

                session()->set($newSession);
                session()->setFlashdata('sukses', 'Selamat Anda Berhasil Login');
                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata('gagal', 'Email atau Password salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('gagal', 'Email atau Password salah');
            return redirect()->to(base_url('login'));
        }
    }


    public function logout()
    {

        session()->destroy();


        session()->setFlashdata('sukses', 'Anda berhasil logout');


        return redirect()->to(base_url('login'));
    }




    public function index_register()
    {

        return view('auth/register');
    }

    public function insert_register()
    {
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = array(
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        );

        $this->UserModel->insert($data);

        session()->setFlashdata('sukses', 'Anda berhasil Register');


        return redirect()->to(base_url('login'));
    }
}

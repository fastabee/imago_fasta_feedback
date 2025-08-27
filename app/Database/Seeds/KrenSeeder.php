<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KrenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'  => 'Admin2',
            'email' => 'admin@example2.com',
            'jumlah' => 100,

        ];


        $this->db->table('kren')->insert($data);
    }
}

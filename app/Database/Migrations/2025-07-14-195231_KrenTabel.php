<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KrenTabel extends Migration
{
    public function up()
    {
        $this->forge->addField("
        id SERIAL PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100),
        jumlah INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ");

        $this->forge->createTable('kren');
    }


    public function down()
    {
        $this->forge->dropTable('kren');
    }
}

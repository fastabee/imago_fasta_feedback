<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rute extends Migration
{
    public function up()
    {
        $this->forge->addField("
        idrute SERIAL PRIMARY KEY,
        idhalte INT (100),
        ruteke INT (100)
    ");
    }

    public function down()
    {
        //
    }
}

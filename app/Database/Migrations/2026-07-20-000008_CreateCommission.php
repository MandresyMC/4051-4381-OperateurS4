<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommissionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_operateur'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'pourcentage'   => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'date_creation' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('id_operateur');
        $this->forge->addForeignKey('id_operateur', 'operateur', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('commission');
    }

    public function down()
    {
        $this->forge->dropTable('commission');
    }
}

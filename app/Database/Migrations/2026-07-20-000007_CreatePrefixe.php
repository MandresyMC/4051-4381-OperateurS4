<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrefixeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'prefixe'      => ['type' => 'VARCHAR', 'constraint' => 10],
            'id_operateur' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'actif'        => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('prefixe');
        $this->forge->addKey('id_operateur');
        $this->forge->addForeignKey('id_operateur', 'operateur', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('prefixe');
    }

    public function down()
    {
        $this->forge->dropTable('prefixe');
    }
}

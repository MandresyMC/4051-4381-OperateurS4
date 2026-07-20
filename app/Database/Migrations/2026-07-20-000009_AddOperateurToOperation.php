<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOperateurToOperationTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('operation', [
            'id_operateur' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id_user_destination',
            ],
            'pourcentage_commission' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00,
                'after'      => 'frais',
            ],
        ]);

        $this->forge->addForeignKey('id_operateur', 'operateur', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->processIndexes('operation');
    }

    public function down()
    {
        $this->forge->dropForeignKey('operation', 'operation_id_operateur_foreign');
        $this->forge->dropColumn('operation', ['id_operateur', 'pourcentage_commission']);
    }
}

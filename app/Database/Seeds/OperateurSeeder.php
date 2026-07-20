<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperateurSeeder extends Seeder
{
    public function run(): void
    {
        $local  = $this->db->table('proprietaire')->where('nom', 'Local')->get()->getRowArray();
        $autres = $this->db->table('proprietaire')->where('nom', 'Autres')->get()->getRowArray();

        $data = [
            ['nom' => 'Yas', 'id_proprietaire' => $local['id']],
            ['nom' => 'Orange', 'id_proprietaire' => $autres['id']],
            ['nom' => 'Airtel', 'id_proprietaire' => $autres['id']],
        ];

        $this->db->table('operateur')->insertBatch($data);
    }
}

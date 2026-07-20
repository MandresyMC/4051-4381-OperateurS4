<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProprietaireSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nom' => 'Local'],
            ['nom' => 'Autres'],
        ];

        $this->db->table('proprietaire')->insertBatch($data);
    }
}

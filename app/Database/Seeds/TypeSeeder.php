<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $datas = [

            [
                'nom' => 'DEPOT',
            ],

            [
                'nom' => 'RETRAIT',
            ],

            [
                'nom' => 'TRANSFERT',
            ],

        ];

        $this->db
            ->table('type')
            ->insertBatch($datas);
    }
}
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $datas = [

            [
                'nom' => 'depot',
            ],

            [
                'nom' => 'retrait',
            ],

            [
                'nom' => 'transfert',
            ],

        ];

        $this->db
            ->table('type')
            ->insertBatch($datas);
    }
}
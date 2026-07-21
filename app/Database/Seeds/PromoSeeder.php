<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $datas = [

            [
                'pourcentage' => 0
            ]
        ];

        $this->db
            ->table('promo')
            ->insertBatch($datas);
    }
}

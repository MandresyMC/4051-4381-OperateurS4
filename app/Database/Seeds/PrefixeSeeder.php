<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run(): void
    {
        $yas    = $this->db->table('operateur')->where('nom', 'Yas')->get()->getRowArray();
        $orange = $this->db->table('operateur')->where('nom', 'Orange')->get()->getRowArray();
        $airtel = $this->db->table('operateur')->where('nom', 'Airtel')->get()->getRowArray();

        $data = [
            ['prefixe' => '32', 'id_operateur' => $yas['id'], 'actif' => 1],
            ['prefixe' => '38', 'id_operateur' => $yas['id'], 'actif' => 1],
            ['prefixe' => '37', 'id_operateur' => $orange['id'], 'actif' => 1],
            ['prefixe' => '39', 'id_operateur' => $orange['id'], 'actif' => 1],
            ['prefixe' => '33', 'id_operateur' => $airtel['id'], 'actif' => 1],
            ['prefixe' => '34', 'id_operateur' => $airtel['id'], 'actif' => 1],
        ];

        $this->db->table('prefixe')->insertBatch($data);
    }
}

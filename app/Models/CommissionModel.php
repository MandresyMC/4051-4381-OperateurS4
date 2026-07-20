<?php

namespace App\Models;

use CodeIgniter\Model;

class CommissionModel extends Model
{
    protected $table = 'commission';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_operateur',
        'pourcentage',
        'date_creation',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_operateur' => 'required|integer',
        'pourcentage'  => 'required|decimal',
    ];

    protected $validationMessages = [
        'id_operateur' => [
            'required' => "L'opérateur est obligatoire.",
        ],
        'pourcentage' => [
            'required' => 'Le pourcentage est obligatoire.',
            'decimal'  => 'Le pourcentage doit être un nombre décimal.',
        ],
    ];

    /**
     * Pourcentage de commission courant pour un operateur (le plus recent), 0 par defaut.
     */
    public function getPourcentagePourOperateur(int $idOperateur): float
    {
        $row = $this->where('id_operateur', $idOperateur)
            ->orderBy('date_creation', 'DESC')
            ->first();

        return $row ? (float) $row['pourcentage'] : 0.0;
    }
}

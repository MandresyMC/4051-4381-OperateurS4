<?php

namespace App\Models;

use CodeIgniter\Model;

class BaremeFraisModel extends Model
{
    protected $table = 'bareme_frais';
    protected $primaryKey = 'id';

    // Champs autorisés pour insert/update
    protected $allowedFields = [
        'id_type',
        'montant_min',
        'montant_max',
        'frais'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_type'     => 'required|integer',
        'montant_min' => 'required|decimal',
        'montant_max' => 'required|decimal',
        'frais'       => 'required|decimal'
    ];

    protected $validationMessages = [
        'id_type' => [
            'required' => 'Le type est obligatoire.',
            'integer' => 'Le type doit être un entier.'
        ],
        'montant_min' => [
            'required' => 'Le montant minimum est obligatoire.',
            'decimal' => 'Le montant minimum doit être un nombre décimal.'
        ],
        'montant_max' => [
            'required' => 'Le montant maximum est obligatoire.',
            'decimal' => 'Le montant maximum doit être un nombre décimal.'
        ],
        'frais' => [
            'required' => 'Les frais sont obligatoires.',
            'decimal' => 'Les frais doivent être un nombre décimal.'
        ]
    ];

    public function getValidationRulesArray(): array
    {
        return $this->validationRules;
    }

    public function getValidationMessagesArray(): array
    {
        return $this->validationMessages;
    }
}

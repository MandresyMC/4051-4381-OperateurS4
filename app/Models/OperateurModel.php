<?php

namespace App\Models;

use CodeIgniter\Model;

class OperateurModel extends Model
{
    protected $table = 'operateur';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'id_proprietaire',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nom'             => 'required|min_length[2]|max_length[100]',
        'id_proprietaire' => 'required|integer',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => "Le nom de l'opérateur est obligatoire.",
        ],
        'id_proprietaire' => [
            'required' => 'Le propriétaire est obligatoire.',
        ],
    ];

    /**
     * Retourne l'operateur local (proprietaire), s'il existe.
     */
    public function isLocal(int $idOperateur): bool
    {
        $operateur = $this->select('operateur.*, proprietaire.nom as proprietaire_nom')
            ->join('proprietaire', 'proprietaire.id = operateur.id_proprietaire')
            ->find($idOperateur);

        return $operateur && strtolower($operateur['proprietaire_nom']) === 'local';
    }
}

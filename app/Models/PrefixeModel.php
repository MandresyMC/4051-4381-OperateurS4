<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table = 'prefixe';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'prefixe',
        'id_operateur',
        'actif',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'prefixe'      => 'required|min_length[2]|max_length[3]|numeric|is_unique[prefixe.prefixe,id,{id}]',
        'id_operateur' => 'required|integer',
    ];

    protected $validationMessages = [
        'prefixe' => [
            'required'   => 'Le préfixe est obligatoire.',
            'numeric'    => 'Le préfixe ne doit contenir que des chiffres.',
            'min_length' => 'Le préfixe doit contenir 2 ou 3 chiffres.',
            'max_length' => 'Le préfixe doit contenir 2 ou 3 chiffres.',
            'is_unique'  => 'Ce préfixe est déjà configuré.',
        ],
        'id_operateur' => [
            'required' => "L'opérateur est obligatoire.",
        ],
    ];

    /**
     * Recherche le prefixe (actif) correspondant a un numero de telephone (sans le 0),
     * avec les infos operateur + proprietaire.
     */
    public function findByNumero(string $numero): ?array
    {
        $candidats = $this->select('prefixe.*, operateur.nom as operateur_nom, operateur.id_proprietaire, proprietaire.nom as proprietaire_nom')
            ->join('operateur', 'operateur.id = prefixe.id_operateur')
            ->join('proprietaire', 'proprietaire.id = operateur.id_proprietaire')
            ->where('actif', 1)
            ->orderBy('LENGTH(prefixe.prefixe)', 'DESC')
            ->findAll();

        foreach ($candidats as $candidat) {
            if (strpos($numero, $candidat['prefixe']) === 0) {
                return $candidat;
            }
        }

        return null;
    }
}

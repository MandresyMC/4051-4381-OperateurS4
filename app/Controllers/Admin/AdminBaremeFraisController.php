<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BaremeFraisModel;
use App\Models\CommissionModel;
use App\Models\OperateurModel;
use App\Models\PrefixeModel;
use App\Models\TypeModel;

class AdminBaremeFraisController extends BaseController
{
    protected $typeModel;
    protected $baremeFraisModel;
    protected $operateurModel;
    protected $prefixeModel;
    protected $commissionModel;

    public function __construct()
    {
        $this->typeModel = new TypeModel();
        $this->baremeFraisModel = new BaremeFraisModel();
        $this->operateurModel = new OperateurModel();
        $this->prefixeModel = new PrefixeModel();
        $this->commissionModel = new CommissionModel();
    }

    public function index()
    {
        $types = $this->typeModel->findAll();

        $baremes = $this->baremeFraisModel
            ->select('bareme_frais.*, type.nom as type_nom')
            ->join('type', 'type.id = bareme_frais.id_type')
            ->orderBy('type.nom', 'ASC')
            ->orderBy('bareme_frais.montant_min', 'ASC')
            ->paginate(8);
        
        $pager = $this->baremeFraisModel->pager;

        $operateurs = $this->operateurModel
            ->select('operateur.*, proprietaire.nom as proprietaire_nom')
            ->join('proprietaire', 'proprietaire.id = operateur.id_proprietaire')
            ->orderBy('operateur.nom', 'ASC')
            ->findAll();

        $prefixes = $this->prefixeModel
            ->select('prefixe.*, operateur.nom as operateur_nom, proprietaire.nom as proprietaire_nom')
            ->join('operateur', 'operateur.id = prefixe.id_operateur')
            ->join('proprietaire', 'proprietaire.id = operateur.id_proprietaire')
            ->orderBy('prefixe.prefixe', 'ASC')
            ->findAll();

        $commissions = $this->commissionModel
            ->select('commission.*, operateur.nom as operateur_nom')
            ->join('operateur', 'operateur.id = commission.id_operateur')
            ->orderBy('commission.date_creation', 'DESC')
            ->findAll();

        $operateursAutres = array_values(array_filter($operateurs, function ($o) {
            return strtolower($o['proprietaire_nom']) !== 'local';
        }));

        return view('admin/configuration', [
            'types'             => $types,
            'baremes'           => $baremes,
            'pager'             => $pager,
            'operateurs'        => $operateurs,
            'operateursAutres'  => $operateursAutres,
            'prefixes'          => $prefixes,
            'commissions'       => $commissions,
        ]);
    }

    public function createPrefixe()
    {
        $prefixe = trim((string) $this->request->getPost('prefixe'));
        $prefixe = ltrim($prefixe, '0');
        $idOperateur = (int) $this->request->getPost('id_operateur');

        if ($prefixe === '' || !ctype_digit($prefixe) || strlen($prefixe) > 3) {
            return redirect()->to('/admin/configuration')
                ->with('error', 'Le préfixe doit être composé de 2 ou 3 chiffres (ex: 038).');
        }

        $operateur = $this->operateurModel->find($idOperateur);
        if (!$operateur) {
            return redirect()->to('/admin/configuration')
                ->with('error', "Opérateur introuvable.");
        }

        $existe = $this->prefixeModel->where('prefixe', $prefixe)->first();
        if ($existe) {
            return redirect()->to('/admin/configuration')
                ->with('error', 'Ce préfixe est déjà configuré.');
        }

        $this->prefixeModel->insert([
            'prefixe'      => $prefixe,
            'id_operateur' => $idOperateur,
            'actif'        => 1,
        ]);

        return redirect()->to('/admin/configuration')->with('success', 'Préfixe ajouté avec succès.');
    }

    public function togglePrefixe($id)
    {
        $prefixe = $this->prefixeModel->find((int) $id);
        if (!$prefixe) {
            return redirect()->to('/admin/configuration')->with('error', 'Préfixe introuvable.');
        }

        $this->prefixeModel->update((int) $id, ['actif' => $prefixe['actif'] ? 0 : 1]);

        return redirect()->to('/admin/configuration')->with('success', 'Préfixe mis à jour.');
    }

    public function deletePrefixe($id)
    {
        $this->prefixeModel->delete((int) $id);

        return redirect()->to('/admin/configuration')->with('success', 'Préfixe supprimé.');
    }

    public function createCommission()
    {
        $idOperateur = (int) $this->request->getPost('id_operateur');
        $pourcentage = (float) $this->request->getPost('pourcentage');

        $operateur = $this->operateurModel
            ->select('operateur.*, proprietaire.nom as proprietaire_nom')
            ->join('proprietaire', 'proprietaire.id = operateur.id_proprietaire')
            ->find($idOperateur);

        if (!$operateur) {
            return redirect()->to('/admin/configuration')->with('error', 'Opérateur introuvable.');
        }

        if (strtolower($operateur['proprietaire_nom']) === 'local') {
            return redirect()->to('/admin/configuration')
                ->with('error', "La commission ne s'applique qu'aux transferts vers les autres opérateurs.");
        }

        if ($pourcentage < 0 || $pourcentage > 100) {
            return redirect()->to('/admin/configuration')
                ->with('error', 'Le pourcentage doit être compris entre 0 et 100.');
        }

        $this->commissionModel->insert([
            'id_operateur'  => $idOperateur,
            'pourcentage'   => $pourcentage,
            'date_creation' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/configuration')->with('success', 'Commission enregistrée avec succès.');
    }

    public function deleteCommission($id)
    {
        $this->commissionModel->delete((int) $id);

        return redirect()->to('/admin/configuration')->with('success', 'Commission supprimée.');
    }

    public function createBaremeFrais()
    {
        $id_type = (int) $this->request->getPost('id_type');
        $montant_min = (float) $this->request->getPost('montant_min');
        $montant_max = (float) $this->request->getPost('montant_max');
        $frais = (float) $this->request->getPost('frais');

        if ($montant_min >= $montant_max) {
            return redirect()->to('/admin/configuration')
                ->with('error', 'Le montant minimum doit être inférieur au montant maximum.');
        }

        if ($frais < 0 || $montant_min < 0) {
            return redirect()->to('/admin/configuration')
                ->with('error', 'Les montants et frais doivent être positifs.');
        }

        $data = [
            'id_type'     => $id_type,
            'montant_min' => $montant_min,
            'montant_max' => $montant_max,
            'frais'       => $frais,
        ];

        $this->baremeFraisModel->insert($data);

        return redirect()->to('/admin/configuration')->with('success', 'Règle de frais ajoutée avec succès.');
    }

    public function deleteBaremeFrais($id)
    {
        $this->baremeFraisModel->delete((int) $id);

        return redirect()->to('/admin/configuration')->with('success', 'Règle de frais supprimée.');
    }
}
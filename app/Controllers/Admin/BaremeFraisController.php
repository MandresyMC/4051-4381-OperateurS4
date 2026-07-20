<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BaremeFraisModel;
use App\Models\TypeModel;

class BaremeFraisController extends BaseController
{
    protected $typeModel;
    protected $baremeFraisModel;

    public function __construct()
    {
        $this->typeModel = new TypeModel();
        $this->baremeFraisModel = new BaremeFraisModel();
    }

    public function index()
    {
        $types = $this->typeModel->findAll();

        $baremes = $this->baremeFraisModel
            ->select('bareme_frais.*, type.nom as type_nom')
            ->join('type', 'type.id = bareme_frais.id_type')
            ->orderBy('type.nom', 'ASC')
            ->orderBy('bareme_frais.montant_min', 'ASC')
            ->findAll();

        return view('admin/configuration', [
            'types'   => $types,
            'baremes' => $baremes,
        ]);
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

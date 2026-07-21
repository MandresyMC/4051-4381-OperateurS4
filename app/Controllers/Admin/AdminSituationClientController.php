<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OperationModel;
use App\Models\UserModel;

class AdminSituationClientController extends BaseController
{
    protected $operationModel;
    protected $userModel;

    public function __construct()
    {
        $this->operationModel = new OperationModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $clients = $this->userModel
            ->select('
                user.id,
                user.numero_telephone,
                user.solde,
                COUNT(operation.id) AS nombre_operations,
                COALESCE(SUM(operation.montant), 0) AS volume_total
            ')
            ->join('operation', 'operation.id_user_source = user.id', 'left')
            ->groupBy('user.id')
            ->orderBy('user.solde', 'DESC')
            ->paginate(10);

        $pager = $this->userModel->pager;

        return view('admin/clients', ['clients' => $clients, 'pager' => $pager]);
    }
}
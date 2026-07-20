<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OperationModel;

class SituationClientController extends BaseController
{
    protected $operationModel;

    public function __construct()
    {
        $this->operationModel = new OperationModel();
    }

    public function index()
    {
        $sql = "
            SELECT
                u.id,
                u.numero_telephone,
                u.solde,
                COUNT(o.id) AS nombre_operations,
                COALESCE(SUM(o.montant), 0) AS volume_total
            FROM user u
            LEFT JOIN operation o ON o.id_user_source = u.id
            GROUP BY u.id
            ORDER BY u.solde DESC
        ";

        $clients = $this->operationModel->query($sql)->getResultArray();

        return view('admin/clients', ['clients' => $clients]);
    }
}

<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AccueilController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if ($r = $this->verificationConnexion()) {
            return $r;
        }

        $user = $this->userModel->find(session()->get('user_id'));

        if (!$user) {
            return redirect()->to('/')->with('error', 'Utilisateur introuvable, merci de vous reconnecter.');
        }

        session()->set('solde', $user['solde']);

        return view('client/accueil', [
            'numero' => $user['numero_telephone'],
            'solde'  => $user['solde'],
        ]);
    }
}
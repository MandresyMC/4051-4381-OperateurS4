<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function verify()
    {
        $numero = trim($this->request->getPost('numero_telephone'));

        if (!preg_match('/^(32|33|34|37|38)\d{7}$/', $numero)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Numéro de téléphone invalide.');
        }

        try {
            $user = $this->userModel
                ->where('numero_telephone', $numero)
                ->first();

            if (!$user) {

                $data = [
                    'numero_telephone' => $numero,
                    'solde'            => 0,
                    'role'             => 'client'
                ];

                $this->userModel->insert($data);

                $user = $this->userModel
                    ->where('numero_telephone', $numero)
                    ->first();
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }

        session()->set([
            'user_id'           => $user['id'],
            'numero_telephone'  => $user['numero_telephone'],
            'solde'  => $user['solde'],
            'logged_in'         => true
        ]);

        return redirect()->to('/accueil');
    }

    public function deconnexion()
    {
        session()->destroy();
        return redirect()->to('/page-login');
    }
}
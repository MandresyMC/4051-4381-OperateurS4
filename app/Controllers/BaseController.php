<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    public function verificationConnexion()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/page-login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }
    }

    public function verificationConnexionAdmin()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/page-login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }
    }

    public function verifyNumeroTelephone($numero)
    {
        $numero = trim($numero);
        $numero = str_replace(' ', '', $numero);

        // Vérifie que le numéro ne contient que des chiffres
        if (!ctype_digit($numero)) {
            $error = 'Le numéro de téléphone ne doit contenir que des chiffres.';
            return $error;
        }

        // Vérifie la longueur
        if (strlen($numero) !== 9) {
            $error = 'Le numéro de téléphone doit contenir exactement 9 chiffres.';
            return $error;
        }

        // Vérifie le préfixe
        if (!preg_match('/^(32|33|34|37|38)/', $numero)) {
            $error = 'Le numéro de téléphone doit commencer par 32, 33, 34, 37 ou 38.';
            return $error;
        }

        return true;
    }
}

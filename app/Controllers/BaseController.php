<?php

namespace App\Controllers;

use App\Models\PrefixeModel;
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

    /**
     * A appeler ainsi dans un controller : if ($r = $this->verificationConnexion()) return $r;
     */
    public function verificationConnexion()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return null;
    }

    public function verificationConnexionAdmin()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return null;
    }

    /**
     * @param bool $requireLocal Si true, le prefixe doit appartenir a un operateur proprietaire (local).
     *                            A utiliser pour la connexion / creation de compte MVola.
     * @return true|string        true si valide, sinon un message d'erreur.
     */
    public function verifyNumeroTelephone($numero, bool $requireLocal = true)
    {
        $numero = trim((string) $numero);
        $numero = str_replace(' ', '', $numero);

        // Vérifie que le numéro ne contient que des chiffres
        if (!ctype_digit($numero)) {
            return 'Le numéro de téléphone ne doit contenir que des chiffres.';
        }

        // Vérifie la longueur
        if (strlen($numero) !== 9) {
            return 'Le numéro de téléphone doit contenir exactement 9 chiffres.';
        }

        // Vérifie le préfixe par rapport a la configuration en base (table prefixe)
        $prefixeInfo = $this->getPrefixeInfo($numero);

        if ($prefixeInfo === null) {
            return "Ce préfixe n'est associé à aucun opérateur configuré.";
        }

        if ($requireLocal && strtolower($prefixeInfo['proprietaire_nom']) !== 'local') {
            return "Les numéros " . $prefixeInfo['operateur_nom'] . " ne peuvent pas créer de compte MVola. Seuls les numéros de l'opérateur propriétaire sont acceptés.";
        }

        return true;
    }

    /**
     * Retourne les infos (operateur, proprietaire) du prefixe correspondant au numero, ou null.
     */
    public function getPrefixeInfo(string $numero): ?array
    {
        $numero = str_replace(' ', '', trim($numero));

        return (new PrefixeModel())->findByNumero($numero);
    }
}

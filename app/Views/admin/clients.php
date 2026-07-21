<?php
/**
 * Attend $clients, fourni par Admin\SituationClientController::index() :
 * id, numero_telephone, solde, nombre_operations, volume_total
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVola Admin — Clients</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/admin-common.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/admin-clients.css') ?>">
</head>
<body>

    <?= view('partials/navbar_admin', ['active' => 'clients']) ?>

    <main class="admin-page">
        <section class="admin-section">
            <h1 class="admin-section__title">MES CLIENTS MVOLA</h1>
            <p class="admin-section__desc">
                Consultez et filtrez la liste de vos clients&nbsp;: solde et volume d'opérations effectuées.
            </p>

            <div class="clients-toolbar">
                <div class="clients-search">
                    <input type="text" class="clients-search__input" placeholder="Rechercher un numero" data-clients-search>
                    <button type="button" class="clients-search__btn" aria-label="Rechercher">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="7" stroke="#ffffff" stroke-width="2.4"/>
                            <path d="M21 21L16.65 16.65" stroke="#ffffff" stroke-width="2.4" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>

                <button type="button" class="admin-btn admin-btn--green" data-clients-solde-filter>
                    <span data-clients-solde-label>Trier par solde</span>
                </button>

                <button type="button" class="admin-btn admin-btn--yellow" data-clients-ops-filter>
                    <span data-clients-ops-label>Trier par activité</span>
                </button>
            </div>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Solde</th>
                            <th>Nombre d'opérations</th>
                            <th>Volume total</th>
                        </tr>
                    </thead>
                    <tbody data-clients-body>
                        <?php foreach ($clients as $c) : ?>
                            <tr
                                data-clients-row
                                data-search="<?= esc(strtolower($c['numero_telephone'])) ?>"
                                data-solde="<?= esc($c['solde']) ?>"
                                data-ops="<?= esc($c['nombre_operations']) ?>"
                            >
                                <td class="admin-table__strong"><?= esc($c['numero_telephone']) ?></td>
                                <td><?= number_format((float) $c['solde'], 0, ',', ' ') ?> Ar</td>
                                <td><?= esc($c['nombre_operations']) ?></td>
                                <td><?= number_format((float) $c['volume_total'], 0, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="admin-empty" data-clients-empty <?= count($clients) > 0 ? 'hidden' : '' ?>>Aucun client ne correspond à votre recherche.</p>
            </div>
            <p class="admin-pagination"><?= $pager->links() ?></p>
        </section>
    </main>

    <script src="<?= base_url('Mvoladashboard/js/admin-clients.js') ?>"></script>
</body>
</html>

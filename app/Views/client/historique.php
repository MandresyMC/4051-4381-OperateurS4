<?php
// Front-only mock rows to demonstrate the working filters.
$rows = [
    ['id' => 'DEP-001', 'proprietaire' => '038 83 350 87', 'destinataire' => '-',             'date' => '2026-07-20', 'statut' => 'VALIDE'],
    ['id' => 'RET-014', 'proprietaire' => '033 12 345 67', 'destinataire' => '-',             'date' => '2026-07-19', 'statut' => 'VALIDE'],
    ['id' => 'TRF-027', 'proprietaire' => '032 45 678 90', 'destinataire' => '034 98 765 43',  'date' => '2026-07-19', 'statut' => 'EN ATTENTE'],
    ['id' => 'TRF-026', 'proprietaire' => '038 63 456 98', 'destinataire' => '037 11 222 33',  'date' => '2026-07-18', 'statut' => 'ECHEC'],
    ['id' => 'DEP-000', 'proprietaire' => '033 12 345 67', 'destinataire' => '-',             'date' => '2026-07-17', 'statut' => 'VALIDE'],
    ['id' => 'RET-013', 'proprietaire' => '034 22 111 09', 'destinataire' => '-',             'date' => '2026-07-15', 'statut' => 'EN ATTENTE'],
    ['id' => 'TRF-025', 'proprietaire' => '038 83 350 87', 'destinataire' => '032 45 678 90',  'date' => '2026-07-12', 'statut' => 'VALIDE'],
    ['id' => 'RET-012', 'proprietaire' => '037 55 044 21', 'destinataire' => '-',             'date' => '2026-07-10', 'statut' => 'ECHEC'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVola — Historique</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/historique.css') ?>">
</head>
<body>

    <?= $this->include('partials/navbar') ?>

    <main class="mvola-hist">
        <a href="<?= base_url('client/operation') ?>" class="hist-btn hist-btn--retour">RETOUR AU MENU</a>

        <h1 class="mvola-hist__title">MON HISTORIQUE MVOLA</h1>
        <p class="mvola-hist__desc">
            Consultez l'historique de toutes vos transactions MVola&nbsp;: dépôts, retraits et transferts,
            avec leur statut mis à jour en temps réel.
        </p>

        <div class="hist-toolbar">
            <div class="hist-search">
                <input type="text" class="hist-search__input" placeholder="Rechercher une transaction ou un numero" data-hist-search>
                <button type="button" class="hist-search__btn" aria-label="Rechercher">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11" cy="11" r="7" stroke="#ffffff" stroke-width="2.4"/>
                        <path d="M21 21L16.65 16.65" stroke="#ffffff" stroke-width="2.4" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            <button type="button" class="hist-btn hist-btn--date" data-hist-date-filter>
                <span data-hist-date-label>Filtrer par date</span>
            </button>

            <button type="button" class="hist-btn hist-btn--statut" data-hist-status-filter data-status="tous">
                <span data-hist-status-label>Filtrer par statut</span>
            </button>
        </div>

        <div class="hist-table-wrap">
            <table class="hist-table">
                <thead>
                    <tr>
                        <th>ID Transaction</th>
                        <th>Proprietaire</th>
                        <th>Destinataire</th>
                        <th data-hist-date-col>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody data-hist-body>
                    <?php foreach ($rows as $row) : ?>
                        <tr
                            data-hist-row
                            data-search="<?= esc(strtolower($row['id'] . ' ' . $row['proprietaire'] . ' ' . $row['destinataire'])) ?>"
                            data-date="<?= esc($row['date']) ?>"
                            data-statut="<?= esc(strtolower($row['statut'])) ?>"
                        >
                            <td class="hist-table__id"><?= esc($row['id']) ?></td>
                            <td><?= esc($row['proprietaire']) ?></td>
                            <td><?= esc($row['destinataire']) ?></td>
                            <td><?= esc(date('d/m/Y', strtotime($row['date']))) ?></td>
                            <td>
                                <span class="hist-badge hist-badge--<?= esc(strtolower(str_replace(' ', '-', $row['statut']))) ?>">
                                    <?= esc($row['statut']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p class="hist-empty" data-hist-empty hidden>Aucune transaction ne correspond à votre recherche.</p>
        </div>
    </main>

    <script src="<?= base_url('Mvoladashboard/js/historique.js') ?>"></script>
</body>
</html>

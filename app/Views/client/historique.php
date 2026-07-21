<?php
/**
 * Attend $operations, fourni par Client\OperationController::historiques().
 * Chaque ligne contient : id, id_type, type_nom, montant, frais, statut, date_creation,
 * source_numero (peut etre null), destination_numero (peut etre null).
 */
$moi = session('numero_telephone');
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
                        <th>Type</th>
                        <th>Correspondant</th>
                        <th>Montant</th>
                        <th>Frais</th>
                        <th data-hist-date-col>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody data-hist-body>
                    <?php foreach ($operations as $op) :
                        $idAffiche = strtoupper(substr($op['type_nom'], 0, 3)) . '-' . str_pad((string) $op['id'], 4, '0', STR_PAD_LEFT);
                        $estSource = $op['source_numero'] === $moi;
                        $correspondant = $estSource ? ($op['destination_numero'] ?? '-') : ($op['source_numero'] ?? '-');
                        $sens = $op['type_nom'] === 'depot' ? '+' : ($estSource ? '-' : '+');
                    ?>
                        <tr
                            data-hist-row
                            data-search="<?= esc(strtolower($idAffiche . ' ' . ($correspondant !== '-' ? $correspondant : ''))) ?>"
                            data-date="<?= esc($op['date_creation']) ?>"
                            data-statut="<?= esc(strtolower($op['statut'])) ?>"
                        >
                            <td class="hist-table__id"><?= esc($idAffiche) ?></td>
                            <td><?= esc(ucfirst($op['type_nom'])) ?></td>
                            <td><?= esc($correspondant) ?></td>
                            <td><?= $sens ?><?= number_format((float) $op['montant'], 0, ',', ' ') ?> Ar</td>
                            <td><?= number_format((float) $op['frais'], 0, ',', ' ') ?> Ar</td>
                            <td><?= esc(date('d/m/Y H:i', strtotime($op['date_creation']))) ?></td>
                            <td>
                                <span class="hist-badge hist-badge--<?= esc(strtolower($op['statut'])) ?>">
                                    <?= esc($op['statut']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p class="hist-empty" data-hist-empty <?= count($operations) > 0 ? 'hidden' : '' ?>>
                Vous n'avez encore effectué aucune transaction.
            </p>
        </div>
        <p class="hist-pagination"><?= $pager->links() ?></p>
    </main>

    <script src="<?= base_url('Mvoladashboard/js/historique.js') ?>"></script>
</body>
</html>

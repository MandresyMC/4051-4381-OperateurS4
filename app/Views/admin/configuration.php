<?php
/**
 * Attend, fournis par Admin\BaremeFraisController::index() :
 * $types (liste des types d'operation), $baremes (regles de frais existantes)
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVola Admin — Configuration des règles</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/admin-common.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/admin-configuration.css') ?>">
</head>
<body>

    <?= view('partials/navbar_admin', ['active' => 'configuration']) ?>

    <main class="admin-page">

        <nav class="admin-quicknav" aria-label="Navigation rapide">
            <a class="admin-quicknav__link" data-quicknav-link href="#prefixes">Prefixes</a>
            <a class="admin-quicknav__link" data-quicknav-link href="#operations">Operations</a>
            <a class="admin-quicknav__link" data-quicknav-link href="#taxes">Taxes et frais</a>
        </nav>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="taxes-form__note is-info" style="margin-bottom: 24px;"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="taxes-form__note is-error" style="margin-bottom: 24px;"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <!-- ===== PREFIXES (simulation front, pas de table en base) ===== -->
        <section class="admin-section" id="prefixes" data-quicknav-target>
            <h1 class="admin-section__title">PREFIXES VALABLES</h1>
            <p class="admin-section__desc">
                Gérez les préfixes téléphoniques autorisés à créer un compte MVola et à effectuer des transactions.
            </p>

            <div class="admin-columns">
                <div>
                    <span class="admin-label">Entrez vos prefixes</span>
                    <form class="admin-inline-form" data-prefix-form novalidate>
                        <input
                            type="text"
                            inputmode="numeric"
                            maxlength="3"
                            placeholder="038"
                            data-prefix-input
                            required
                        >
                        <button type="submit">OK</button>
                    </form>
                </div>

                <div>
                    <span class="admin-label">Vos prefixes en vigueur</span>
                    <div class="pill-list" data-prefix-list>
                        <?php
                        $prefixes = [
                            ['value' => '032', 'active' => true],
                            ['value' => '033', 'active' => true],
                            ['value' => '034', 'active' => true],
                            ['value' => '037', 'active' => false],
                            ['value' => '038', 'active' => true],
                        ];
                        foreach ($prefixes as $p) :
                        ?>
                            <div class="pill <?= $p['active'] ? '' : 'is-off' ?>">
                                <span class="pill__value"><?= esc($p['value']) ?></span>
                                <button type="button" class="pill__toggle" data-state="<?= $p['active'] ? 'on' : 'off' ?>">
                                    <?= $p['active'] ? 'DESACTIVER' : 'ACTIVER' ?>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== OPERATIONS (simulation front, pas de table en base) ===== -->
        <section class="admin-section" id="operations" data-quicknav-target>
            <h1 class="admin-section__title">OPERATIONS</h1>
            <p class="admin-section__desc">
                Activez ou désactivez les types d'opérations disponibles pour vos clients.
            </p>

            <span class="admin-label">Vos operations en vigueur</span>
            <div class="pill-list">
                <?php foreach ($types as $t) : ?>
                    <div class="pill">
                        <span class="pill__value"><?= esc(strtoupper($t['nom'])) ?></span>
                        <button type="button" class="pill__toggle" data-state="on">DESACTIVER</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ===== TAXES ET FRAIS (relie a la table bareme_frais) ===== -->
        <section class="admin-section" id="taxes" data-quicknav-target>
            <h1 class="admin-section__title">TAXES ET FRAIS</h1>
            <p class="admin-section__desc">
                Définissez les frais appliqués selon le type d'opération et la tranche de montant.
                Exemple&nbsp;: pour un transfert entre 10&nbsp;000 et 20&nbsp;000&nbsp;Ar, appliquez 300&nbsp;Ar de frais.
                Le dépôt reste toujours gratuit.
            </p>

            <form class="taxes-form" action="<?= base_url('admin/bareme-frais') ?>" method="post" data-taxes-form novalidate>
                <div class="taxes-form__field">
                    <label class="admin-label" for="taxes-type">Type d'opération</label>
                    <select class="taxes-form__input" id="taxes-type" name="id_type" data-taxes-type>
                        <?php foreach ($types as $t) : ?>
                            <option
                                value="<?= esc($t['id']) ?>"
                                data-nom="<?= esc($t['nom']) ?>"
                                <?= $t['nom'] === 'transfert' ? 'selected' : '' ?>
                            >
                                <?= esc(ucfirst($t['nom'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="taxes-form__field">
                    <label class="admin-label" for="taxes-min">Montant min (Ar)</label>
                    <input class="taxes-form__input" type="number" id="taxes-min" name="montant_min" min="0" step="100" placeholder="10000" data-taxes-min required>
                </div>

                <div class="taxes-form__field">
                    <label class="admin-label" for="taxes-max">Montant max (Ar)</label>
                    <input class="taxes-form__input" type="number" id="taxes-max" name="montant_max" min="0" step="100" placeholder="20000" data-taxes-max required>
                </div>

                <div class="taxes-form__field">
                    <label class="admin-label" for="taxes-frais">Frais (Ar)</label>
                    <input class="taxes-form__input" type="number" id="taxes-frais" name="frais" min="0" step="10" placeholder="300" data-taxes-frais required>
                </div>

                <button type="submit" class="admin-btn admin-btn--green taxes-form__submit" data-taxes-submit>Ajouter</button>
            </form>
            <p class="taxes-form__note" data-taxes-note hidden></p>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Montant min</th>
                            <th>Montant max</th>
                            <th>Frais</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody data-taxes-body>
                        <?php foreach ($baremes as $b) : ?>
                            <tr data-taxes-row>
                                <td><?= esc(ucfirst($b['type_nom'])) ?></td>
                                <td><?= number_format((float) $b['montant_min'], 0, ',', ' ') ?> Ar</td>
                                <td><?= number_format((float) $b['montant_max'], 0, ',', ' ') ?> Ar</td>
                                <td><?= number_format((float) $b['frais'], 0, ',', ' ') ?> Ar</td>
                                <td>
                                    <form action="<?= base_url('admin/bareme-frais/' . $b['id'] . '/delete') ?>" method="post">
                                        <button type="submit" class="admin-btn admin-btn--orange admin-btn--small">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="admin-empty" data-taxes-empty <?= count($baremes) > 0 ? 'hidden' : '' ?>>Aucun frais configuré pour le moment.</p>
            </div>
        </section>

    </main>

    <script src="<?= base_url('Mvoladashboard/js/admin-common.js') ?>"></script>
    <script src="<?= base_url('Mvoladashboard/js/admin-configuration.js') ?>"></script>
</body>
</html>

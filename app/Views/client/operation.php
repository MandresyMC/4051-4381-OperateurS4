<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVola — Effectuer une transaction</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/transaction.css') ?>">
</head>
<body>

    <?= $this->include('partials/navbar') ?>

    <main class="mvola-transaction">
        <h1 class="mvola-transaction__title">Choisissez une opération</h1>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="tx-alert" data-tx-alert>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="tx-grid" data-tx-grid>
            <button type="button" class="tx-card tx-card--depot" data-tx-type="depot">
                <img class="tx-card__icon" src="<?= base_url('Mvoladashboard/SVG/depot.svg') ?>" alt="">
                <span class="tx-card__label">DEPOT</span>
            </button>

            <button type="button" class="tx-card tx-card--retrait" data-tx-type="retrait">
                <img class="tx-card__icon" src="<?= base_url('Mvoladashboard/SVG/retrait.svg') ?>" alt="">
                <span class="tx-card__label">RETRAIT</span>
            </button>

            <button type="button" class="tx-card tx-card--transfert" data-tx-type="transfert">
                <img class="tx-card__icon" src="<?= base_url('Mvoladashboard/SVG/transfert.svg') ?>" alt="">
                <span class="tx-card__label">TRANSFERT</span>
            </button>
        </div>

        <section class="tx-form" data-tx-form>
            <form action="<?= base_url('/client/operation') ?>" method="post" data-tx-form-el novalidate>
                <input type="hidden" name="type_operation" value="<?= esc(old('type_operation')) ?>" data-tx-type-input>

                <h2 class="tx-form__title">
                    <span data-tx-form-label>Nouvelle opération</span>
                </h2>

                <div class="tx-field">
                    <label class="tx-field__label" for="tx-source">Votre numéro</label>
                    <input class="tx-field__input" type="text" id="tx-source" value="+261 <?= esc(session('numero_telephone')) ?>" disabled>
                </div>

                <div class="tx-field" data-tx-dest-field>
                    <label class="tx-field__label" for="tx-destination">Numéro du destinataire</label>
                    <input
                        class="tx-field__input"
                        type="tel"
                        inputmode="numeric"
                        id="tx-destination"
                        name="numero_user_destination"
                        placeholder="38 63 456 98"
                        value="<?= esc(old('numero_user_destination')) ?>"
                        data-tx-destination
                    >
                </div>

                <div class="tx-field">
                    <label class="tx-field__label" for="tx-montant">Montant (Ar)</label>
                    <input
                        class="tx-field__input"
                        type="number"
                        id="tx-montant"
                        name="montant"
                        min="1"
                        step="0.01"
                        placeholder="10000"
                        value="<?= esc(old('montant')) ?>"
                        required
                    >
                </div>

                <div class="tx-form__actions">
                    <button type="button" class="tx-btn tx-btn--ghost" data-tx-cancel>Annuler</button>
                    <button type="submit" class="tx-btn tx-btn--solid" data-tx-submit>
                        <span class="spinner"></span>
                        <span>Confirmer</span>
                    </button>
                </div>
            </form>
        </section>
    </main>

    <script src="<?= base_url('Mvoladashboard/js/transaction.js') ?>"></script>
</body>
</html>

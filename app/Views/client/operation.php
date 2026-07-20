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

        <div class="tx-grid">
            <a href="<?= base_url('client/depot') ?>" class="tx-card tx-card--depot">
                <img class="tx-card__icon" src="<?= base_url('Mvoladashboard/SVG/depot.svg') ?>" alt="">
                <span class="tx-card__label">DEPOT</span>
            </a>

            <a href="<?= base_url('client/retrait') ?>" class="tx-card tx-card--retrait">
                <img class="tx-card__icon" src="<?= base_url('Mvoladashboard/SVG/retrait.svg') ?>" alt="">
                <span class="tx-card__label">RETRAIT</span>
            </a>

            <a href="<?= base_url('client/transfert') ?>" class="tx-card tx-card--transfert">
                <img class="tx-card__icon" src="<?= base_url('Mvoladashboard/SVG/transfert.svg') ?>" alt="">
                <span class="tx-card__label">TRANSFERT</span>
            </a>
        </div>
    </main>
</body>
</html>

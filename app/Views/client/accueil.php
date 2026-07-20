<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVola — Accueil</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/accueil.css') ?>">
</head>
<body>

    <?= $this->include('partials/navbar') ?>

    <main class="mvola-hero">
        <div class="mvola-hero__text">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="hero-alert hero-alert--success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="hero-alert hero-alert--error"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <h1 class="mvola-hero__title">
                MVola au c&#339;ur de Madagascar, dans le c&#339;ur des Malagasy&nbsp;!
            </h1>
            <p class="mvola-hero__desc">
                MVola simplifie votre quotidien en facilitant la gestion de vos finances et vos opérations financières.<br>
                Avec MVola Fô, que vous soyez client 032, 033, 034, 037 ou 038, ouvrez gratuitement votre compte MVola
                dès maintenant et profitez des avantages du cashless et du 0 contact&nbsp;!
            </p>

            <div class="mvola-hero__actions">
                <button type="button" class="hero-btn hero-btn--ghost" data-solde-toggle data-solde="<?= esc($solde ?? 0) ?>">
                    <span data-solde-label>VOIR MON SOLDE</span>
                </button>
                <a href="<?= base_url('client/operation') ?>" class="hero-btn hero-btn--outline">Effectuer une transaction</a>
            </div>
        </div>

        <div class="mvola-hero__media">
            <div class="mvola-hero__blob" aria-hidden="true"></div>
            <img class="mvola-hero__photo" src="<?= base_url('Mvoladashboard/SVG/Picture.png') ?>" alt="Utilisateurs MVola">
        </div>
    </main>

    <script src="<?= base_url('Mvoladashboard/js/accueil.js') ?>"></script>
</body>
</html>

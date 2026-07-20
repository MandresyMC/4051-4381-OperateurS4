<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVola — Connexion</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('Mvoladashboard/css/login.css') ?>">
</head>
<body>

    <div class="bg-decor" aria-hidden="true">
        <img class="illus illus-soleil" src="<?= base_url('Mvoladashboard/SVG/soleil.svg') ?>" alt="">
        <img class="illus illus-x" src="<?= base_url('Mvoladashboard/SVG/x.svg') ?>" alt="">
    </div>

    <main class="mvola-login">
        <div class="mvola-login__brand">
            <img class="mvola-login__logo" src="<?= base_url('Mvoladashboard/SVG/MVola%20logo.svg') ?>" alt="MVola">
        </div>

        <div class="mvola-login__panel">
            <h1 class="mvola-login__title">Connexion à votre compte</h1>
            <p class="mvola-login__desc">
                Le service préféré des Malagasy pour envoyer, recevoir, emprunter et épargner de l'argent,
                payer ses factures facilement et bien plus encore, directement depuis votre mobile !
            </p>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="mvola-alert" data-mvola-alert>
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form class="mvola-form" data-mvola-form action="<?= base_url('/login') ?>" method="post" novalidate>
                <label class="field-label" for="numero_telephone">Numéro de téléphone</label>
                <div class="phone-group" data-mvola-group>
                    <span class="phone-group__prefix">+261</span>
                    <input
                        class="phone-group__input"
                        type="tel"
                        inputmode="numeric"
                        autocomplete="tel-national"
                        id="numero_telephone"
                        name="numero_telephone"
                        placeholder="38 63 456 98"
                        value="<?= esc(old('numero_telephone')) ?>"
                        maxlength="12"
                        required
                        data-mvola-phone
                    >
                </div>
                <p class="field-hint" data-mvola-hint></p>

                <button class="mvola-btn" type="submit" data-mvola-submit disabled>
                    <span class="spinner"></span>
                    <span class="mvola-btn__label">Vérifier mon numero</span>
                </button>
            </form>

            <div class="mvola-biometric">
                <img class="face-id" src="<?= base_url('Mvoladashboard/SVG/face_id.svg') ?>" alt="Authentification biométrique" data-mvola-faceid>
                <p class="mvola-biometric__caption">
                    Soyez parmi les premiers à tester l'authentification biométrique
                </p>
            </div>
        </div>
    </main>

    <div class="mvola-toast" data-mvola-toast></div>

    <script src="<?= base_url('Mvoladashboard/js/login.js') ?>"></script>
</body>
</html>

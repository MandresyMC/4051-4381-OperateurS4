Frontend (Mihaja - 4381)
Backend (Mandresy - 4051)

# Etat du projet MVola

Ce document liste ce qui a ete fait, page par page, en suivant les maquettes Figma, et qui a fait quoi. Le but : que n'importe qui reprenne le projet et comprenne tout de suite ce qui marche, ce qu'il reste a faire, et a qui le demander.

Le parcours complet fonctionne reellement (pas juste visuellement) : connexion, depot, retrait, transfert, historique et les 3 pages admin lisent et ecrivent vraiment dans la base de donnees.

## Fait par 4381 (Frontend - toutes les pages et l'interface)

### Page de connexion (maquette "Mvola_login")
- Formulaire avec l'indicatif +261 fixe et le numero a saisir, style neo-brutalist (bordures noires epaisses, pas d'arrondis, ombres portees dures).
- Illustrations (soleil, x) placees en arriere-plan de la page, pas coupees dans le bloc jaune.
- Animations d'entree, etats de bouton (chargement, desactive), message d'erreur anime.

### Page d'accueil (maquette "Hello_page")
- Bouton "Voir mon solde" qui revele le montant avec une petite animation.
- Zone de message succes/erreur.
- Boutons vers "Effectuer une transaction".

### Page "Effectuer une transaction" (maquette "Transaction")
- Les 3 blocs Depot / Retrait / Transfert (icones et couleurs de la charte), ouverture animee du petit formulaire au clic.

### Pages Depot / Retrait / Transfert (maquette "depot_retrait_transfert")
- Une page par operation (/client/depot, /client/retrait, /client/transfert) avec son titre et son texte propres.
- Champ destinataire (+261) uniquement affiche pour le transfert.

### Page Historique (maquette perso, dans l'esprit de "Transaction")
- Tableau des operations avec recherche en direct, tri par date, filtre par statut : tout en JavaScript cote client.

### Navbar client (maquette "navbar")
- Un seul composant reutilise sur toutes les pages client : logo, "Effectuer une transaction", "Historiques", "Deconnexion".

### Dashboard admin (maquette perso)
- Cartes de statistiques, graphique en barres (evolution par mois), camembert de repartition Depot/Retrait/Transfert - en CSS pur, sans librairie externe.

### Configuration des regles (maquette perso)
- 3 sections avec raccourcis de navigation en haut de page.
- Boutons Activer/Desactiver pour "Prefixes valables" et "Operations".
- Formulaire "Taxes et frais" (ajout d'une tranche de montant + frais) et tableau des regles existantes.

### Page Clients (maquette perso, ajoutee dans la navbar admin)
- Tableau clients avec recherche par numero et tri (solde, activite).

### Navbar admin
- Onglet actif mis en surbrillance selon la page (Dashboard / Configuration des regles / Clients / Deconnexion).

## Fait par 4051 (Backend - donnees et regles metier)

- Correction des controllers : ils avaient ete ranges dans des dossiers (Auth/, Client/, Admin/) mais gardaient l'ancien nom de dossier dans leur code, ce qui empechait le site de demarrer.
- Correction d'un bug de copier-coller : deux fichiers differents contenaient la meme classe "DashboardController" (l'un d'eux devait s'appeler SituationClientController).
- Verification "est-ce que l'utilisateur est connecte" : elle existait mais n'etait jamais vraiment appliquee (le resultat n'etait pas utilise nulle part). Corrigee et branchee sur toutes les pages client.
- Formulaire admin de creation de frais : il enregistrait par erreur dans la mauvaise table. Corrige.
- Validation du numero de telephone : un compte a 9 chiffres etait rejete a l'inscription a cause d'une regle qui demandait 10 caracteres minimum. Corrigee.
- Mise a jour reelle du solde : avant, on pouvait faire un depot ou un retrait sans que l'argent ne bouge. Maintenant chaque operation modifie vraiment le solde du ou des comptes concernes, avec verification du solde disponible avant un retrait ou un transfert.
- Calcul des frais par tranche de montant (bareme_frais), different pour un retrait et pour un transfert ; le depot reste toujours gratuit.
- Historique relie a la vraie base (type, montant, frais, date, statut, numero de l'autre partie).
- Statistiques du dashboard admin et liste des clients calculees depuis la base (plus aucune donnee inventee).
- Base de donnees nettoyee (doublons de types d'operation supprimes) et rechargee avec des donnees de demonstration (5 clients, quelques operations, bareme de frais pour retrait et transfert).

## Comptes admin : il n'y en a pas encore

Il n'existe **aucun numero "admin"** pour le moment. Les pages /admin/dashboard, /admin/configuration et /admin/clients sont ouvertes a tout le monde, sans connexion ni verification de role - c'etait volontaire, pour se concentrer sur le reste avant de batir un vrai systeme de compte admin (voir "Reste a faire" ci-dessous).

## Reste a faire

- **4051** : ajouter un champ "role" (client / admin) sur le compte utilisateur en base, et verifier ce role avant de laisser entrer sur /admin/*.
- **4381** : creer l'interface de connexion dediee a l'admin une fois ce role disponible (peut reutiliser le style de la page de connexion actuelle).
- **4051** : creer les tables "prefixes autorises" et "operations activees" en base, pour que les boutons Activer/Desactiver de la page Configuration agissent pour de vrai (actuellement, c'est un affichage qui fonctionne a l'ecran mais qui ne sauvegarde rien).
- **4381** : une fois ces tables pretes, relier les boutons Activer/Desactiver au serveur (formulaire au lieu du JavaScript seul).
- **4051** : definir un vrai scenario qui peut produire une operation en statut "ECHEC" en base (aujourd'hui, une operation reussie est toujours enregistree en "VALIDE" ; il n'y a pas encore de cas reel d'echec autre que les refus avant enregistrement).
- **4051** : ecrire des tests automatiques PHPUnit (le dossier tests/ existe mais n'a pas ete rempli pour ces fonctionnalites).
- **4381** : faire une passe de test manuel sur mobile (les pages sont responsives mais n'ont pas ete verifiees sur un vrai petit ecran).

COULEURS DE BASE:
#FED200 
#FFFFF0
#317041
Text color: #3F3F44

COULEURS DE FOND:
#FED200 88% OPACITe

ILLSTRATIONS SOLEIL : SOLEIL.SVG 942X942
ILUSTRATIONS X: X.SVG 796X852


BLOC JAUNE DU LOGIN : #FED200 100% OPACITY (OMBRE PORTEE Y=4 blur =32 et opacity 25%)


BLOC BLAN DU LOGIN: #FFFFF0 100% OPACITY 

Texte color #3F3F44:
- Connexion a votre compte: DM sans Black 37.83

- Le service préféré des Malagasy pour envoyer, recevoir, emprunter et épargner de l’argent, payer ses factures facilement et bien plus encore, directement depuis votre mobile !: DM sans light 18.42

+261 : DM sans black 26.52
38 63 456 98 : Dm sans black: 40.42
Verifier mon numero DM sans black 26.52

FAce id illustration : face_id.svg 122x122

Soyez parmi les premiers a tester l’authentifcation biometrique: DM sans light 13.42

HTML BRUT : 

    <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="globals.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="mvola-dashboard" ><img class="masoandro" src="img/masoandro-1.svg" />
<img class="x" src="img/x-1.svg" />
<div class="rectangle" ></div>
<div class="div" ></div>
<img class="fichier" src="img/fichier-1-2.svg" />
<div class="text-wrapper" >Connexion à votre compte</div>
<p class="p" >Le service préféré des Malagasy pour envoyer, recevoir, emprunter et épargner de l’argent, payer ses factures facilement et bien plus encore, directement depuis votre mobile !</p>
<p class="text-wrapper-2" >Soyez parmi les premiers a tester l’authentifcation biometrique</p>
<div class="rectangle-2" ></div>
<div class="rectangle-3" ></div>
<div class="rectangle-4" ></div>
<div class="text-wrapper-3" >+261</div>
<div class="text-wrapper-4" >Vérifier mon numero</div>
<div class="text-wrapper-5" >38 63 456 98</div>
<img class="face-ID-logo-logo" src="img/face-ID-logo-logo.svg" /></div>
</body>
</html>


 GLOBAL CSS BRUT
@import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");
* {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}
html,
body {
  margin: 0px;
  min-height: 100%;
}
/* a blue color as a generic focus style */
button:focus-visible {
  outline: 2px solid #4a90e2 !important;
  outline: -webkit-focus-ring-color auto 5px !important;
}
a {
  text-decoration: none;
}
/* @FONTWARNING[{"type": "restricted", "family": "DM Sans-Black", "weight": "900", "style": "normal", "allowsCrossOrigin": false}] */

@font-face {
  font-family: "DM Sans-Black";
  src: local("DM Sans-Black");
}
/* @FONTWARNING[{"type": "restricted", "family": "DM Sans-Light", "weight": "300", "style": "normal", "allowsCrossOrigin": false}] */

@font-face {
  font-family: "DM Sans-Light";
  src: local("DM Sans-Light");
}

CSS BRUT :
.mvola-dashboard {
  position: relative;
  width: 1920px;
  height: 1117px;
  background-color: #fed200e0;
}

.mvola-dashboard .masoandro {
  position: absolute;
  top: 392px;
  left: 0;
  width: 755px;
  height: 725px;
}

.mvola-dashboard .x {
  position: absolute;
  top: 0;
  left: 1206px;
  width: 714px;
  height: 819px;
}

.mvola-dashboard .rectangle {
  position: absolute;
  top: 139px;
  left: 181px;
  width: 1542px;
  height: 847px;
  background-color: #fed200;
  box-shadow: 0px 4px 32px #00000040;
}

.mvola-dashboard .div {
  position: absolute;
  top: 139px;
  left: 952px;
  width: 771px;
  height: 846px;
  background-color: #fffff0;
}

.mvola-dashboard .fichier {
  position: absolute;
  width: 84.95%;
  height: 59.36%;
  top: 40.64%;
  left: 15.05%;
}

.mvola-dashboard .text-wrapper {
  position: absolute;
  top: 312px;
  left: 1053px;
  font-family: "DM Sans-Black", Helvetica;
  font-weight: 900;
  color: #3f3f44;
  font-size: 37.8px;
  letter-spacing: 0;
  line-height: normal;
}

.mvola-dashboard .p {
  position: absolute;
  top: 387px;
  left: 1055px;
  width: 555px;
  font-family: "DM Sans-Light", Helvetica;
  font-weight: 300;
  color: #3f3f44;
  font-size: 18.4px;
  letter-spacing: 0;
  line-height: normal;
}

.mvola-dashboard .text-wrapper-2 {
  position: absolute;
  top: 905px;
  left: 1166px;
  width: 555px;
  font-family: "DM Sans-Light", Helvetica;
  font-weight: 300;
  color: #3f3f44;
  font-size: 13.4px;
  letter-spacing: 0;
  line-height: normal;
}

.mvola-dashboard .rectangle-2 {
  position: absolute;
  top: 496px;
  left: 1055px;
  width: 125px;
  height: 77px;
  background-color: #317041;
  border: 2px solid;
  border-color: #000000;
}

.mvola-dashboard .rectangle-3 {
  position: absolute;
  top: 496px;
  left: 1180px;
  width: 422px;
  height: 77px;
  background-color: #f2f2f2;
  border-top-width: 2px;
  border-top-style: solid;
  border-right-width: 2px;
  border-right-style: solid;
  border-bottom-width: 2px;
  border-bottom-style: solid;
  border-color: #000000;
}

.mvola-dashboard .rectangle-4 {
  position: absolute;
  top: 594px;
  left: 1055px;
  width: 547px;
  height: 77px;
  background-color: #fed200;
  border: 2px solid;
  border-color: #000000;
}

.mvola-dashboard .text-wrapper-3 {
  position: absolute;
  top: 517px;
  left: 1089px;
  font-family: "DM Sans-Black", Helvetica;
  font-weight: 900;
  color: #ffffff;
  font-size: 26.5px;
  letter-spacing: 0;
  line-height: normal;
}

.mvola-dashboard .text-wrapper-4 {
  position: absolute;
  top: 615px;
  left: 1194px;
  font-family: "DM Sans-Black", Helvetica;
  font-weight: 900;
  color: #3f3f44;
  font-size: 26.5px;
  letter-spacing: 0;
  line-height: normal;
}

.mvola-dashboard .text-wrapper-5 {
  position: absolute;
  top: 509px;
  left: 1265px;
  font-family: "DM Sans-Black", Helvetica;
  font-weight: 900;
  color: #3f3f446b;
  font-size: 40.4px;
  letter-spacing: 0;
  line-height: normal;
}

.mvola-dashboard .face-ID-logo-logo {
  position: absolute;
  top: 748px;
  left: 1285px;
  width: 122px;
  height: 122px;
}





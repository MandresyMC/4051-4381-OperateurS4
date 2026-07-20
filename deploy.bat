@echo off
setlocal enabledelayedexpansion
title MVola - Deploiement local
cd /d "%~dp0"

echo ============================================
echo   MVola - Deploiement local (CodeIgniter 4)
echo ============================================
echo.

REM --- 1. Verification de PHP ---
where php >nul 2>nul
if errorlevel 1 (
    echo [ERREUR] PHP n'a pas ete trouve dans le PATH.
    echo Ajoutez votre dossier PHP de XAMPP au PATH ^(ex: C:\xampp\php^) puis relancez ce script.
    pause
    exit /b 1
)
echo [OK] PHP detecte :
php -v | findstr /r "^PHP"
echo.

REM --- 2. Installation des dependances Composer ---
if not exist "vendor\autoload.php" (
    echo [INFO] Dossier vendor absent, installation des dependances...
    where composer >nul 2>nul
    if errorlevel 1 (
        echo [ERREUR] Composer n'a pas ete trouve dans le PATH.
        echo Installez Composer ^(https://getcomposer.org/^) puis relancez ce script.
        pause
        exit /b 1
    )
    call composer install --no-interaction
    if errorlevel 1 (
        echo [ERREUR] L'installation Composer a echoue.
        pause
        exit /b 1
    )
) else (
    echo [OK] Dependances Composer deja installees.
)
echo.

REM --- 3. Fichier .env ---
if not exist ".env" (
    echo [INFO] Creation du fichier .env...
    echo CI_ENVIRONMENT = development> .env
) else (
    echo [OK] Fichier .env present.
)
echo.

REM --- 4. Base de donnees SQLite ---
if not exist "writable" (
    mkdir "writable"
)
echo [INFO] Application des migrations SQLite...
php spark migrate --all
if errorlevel 1 (
    echo [ATTENTION] Les migrations ont rencontre un souci ^(peut-etre deja a jour^).
)
echo.

echo [INFO] Execution des seeders ^(types d'operation^)...
php spark db:seed TypeSeeder
echo.

REM --- 5. Lancement du serveur ---
set HOST=localhost
set PORT=8080

echo ============================================
echo   Demarrage du serveur : http://%HOST%:%PORT%/
echo   Appuyez sur CTRL+C pour arreter le serveur
echo ============================================
echo.

start "" "http://%HOST%:%PORT%/"
php spark serve --host %HOST% --port %PORT%

pause
endlocal

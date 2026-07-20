<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= base_url('/operation') ?>" method="post">
        <label for="type_operation">Type d'opération:</label>
        <select id="type_operation" name="type_operation" required>
            <option value="retrait">Retrait</option>
            <option value="depot">Dépôt</option>
            <option value="transfert">Transfert</option>
        </select>
        <br><br>
        <label for="id_user_source">numero de l'utilisateur source:</label>
        <input type="text" id="id_user_source" name="id_user_source">
        <br><br>
        <label for="id_user_destination">numero de l'utilisateur destination:</label>
        <input type="text" id="id_user_destination" name="id_user_destination">
        <br><br>
        <label for="montant">Montant:</label>
        <input type="number" id="montant" name="montant" step="0.01" required>
        <br><br>
        <button type="submit">Créer l'opération</button>
    </form>
</body>
</html>
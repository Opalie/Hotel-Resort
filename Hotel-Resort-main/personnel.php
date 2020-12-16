<?php
    include_once 'header.php'
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css-manager.css">

    <title>Hotel F2</title>
</head>
<body>
    <form action="includes/createEmploye.inc.php" method="POST">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom">
        <label for="nom">Nom</label>
        <input type="text" name ="nom">
        <input type="submit" name="submit">
    </form>
</body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css-manager.css">
    <title>Hotel Ressort F2</title>
</head>

<?php include_once 'header.php' ?>
<body>
<div id="titrech">Gestion des Employés</div>
<form action="includes/createEmploye.inc.php" method="POST">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom">
        <label for="nom">Nom</label>
        <input type="text" name ="nom">
        <input type="submit" name="submit">
    </form>
</body>
</html>
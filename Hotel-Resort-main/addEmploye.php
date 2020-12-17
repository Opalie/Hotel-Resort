<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css-AddEmploye.css">
    <title>Hotel Ressort F2</title>
</head>

<?php include_once 'header.php' ?>
<body>
<div id="titrech">Gestion des Employés</div>
<form action="includes/createEmploye.inc.php" method="POST">
    <div class="inputWrapper">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom">
        </div>
        <div class="inputWrapper">
            <label for="nom">Nom</label>
            <input type="text" name ="nom">
        </div>
        <input type="submit" name="submit">
    </form>
</body>
</html>
<?php
    include_once 'header.php'
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css-manager.css">
    <link rel="stylesheet" href="style/css-employe.css">

    <title>Hotel F2</title>
</head>
<body>
    <form action="addEmploye.php">
        <button type="submit">Ajouter un(e) Employé(e)</button>
    </form>

<div class="affichageEmploye">
<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

//===============GET EMPLOYEES===========================

$sql = "SELECT nom, prenom, id FROM employe";
$stmt = mysqli_stmt_init($conn);

if  (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: login.php?error=test2");
    exit();
}

mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

$rows = mysqli_fetch_all($resultData);

foreach ($rows as $row) {
    echo ("<div class='employe'> {$row[1]} {$row[0]} </div>" );
}
?>
</div>
</body>
</html>

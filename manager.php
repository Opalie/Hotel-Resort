<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-manager.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed&display=swap" rel="stylesheet">
    <title>Hôtel Ressort F2</title>
</head>



<?php

require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

//===============GET ROOMS===========================

$sql = "SELECT * FROM chambre WHERE status_id = 2;";
$stmt = mysqli_stmt_init($conn);

if  (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: login.php?error=test");
    exit();
}

mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

$rows = mysqli_fetch_all($resultData);

$employees = getFreeEmployees($conn);

?>
<div id="bandeau">
    <div class="bandeau" id="menu">
        <div class="menu" id="Titre">Hôtel Ressort F2</div>
        <div class="menu" id="cham">Chambres</div>
        <div class="menu" id="cham">Personnel</div>
    </div>
    <div class="bandeau" id="decon">Déconnexion</div>
</div>

<div id="liste-chambres">

    <div id="titrech">Gestion des chambres</div>

    <div class="chambres" id="un">
        <div id="chambrenom">Chambre 01</div>
        <div id="chambretage">Étage 1</div>
        <div class="chambretat">Occupé</div>
    </div>

    <div class="chambres" id="deux">
        <div id="chambrenom">Chambre 02</div>
        <div id="chambretage">Étage 1</div>
        <div class="chambretat">Libre</div>
    </div>

    <div class="chambres" id="trois">
        <div id="chambrenom">Chambre 03</div>
        <div id="chambretage">Étage 1</div>
        <div class="chambretat">Nettoyage</div>
    </div>
<?php
foreach($rows as $row){
echo("
    <div class='container-chambre'>
    <div style='width: 29px;position: absolute;left: 0px;height: 100%;background-color: green;'></div>
    <div class='numeroChambre'>Chambre n°<span class='numeroNumeroChambre'>{$row[1]}</span></div>
        
    <div class='content-chambreManage'>

        <div class='manageChambre'>
            <form action='includes/affectEmployee.inc.php' method='post'>
                <ul>
                    <li><select name='affectUserList' id='affectUserList'><option selected></option>{$employees}</select></li>
                    <li><button type='submit' name='submit'>Attribuer</button></li>
                </ul>
                <input type='hidden' name='id_chambre' = value = '{$row[0]}'>
            </form>
        </div>
    </div>
    </div>");
}
?>
</div>

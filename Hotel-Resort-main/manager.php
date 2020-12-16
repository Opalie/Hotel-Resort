<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css-manager.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed&display=swap" rel="stylesheet">
    <title>Hôtel Ressort F2</title>
</head>



<?php

require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

//===============GET ROOMS===========================

$sql = "SELECT * FROM chambre";
$stmt = mysqli_stmt_init($conn);

if  (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: login.php?error=test2");
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
        <div class="menu">Chambres</div>
        <div class="menu">Personnel</div>
    </div>
    <div class="bandeau" id="decon">Déconnexion</div>
</div>

<div id="titrech">Gestion des chambres</div>

<div id="liste-chambres">

<?php
foreach($rows as $row){
    if($row[3]==3){
        echo("
        <div class='deux'>
                <div id='chambrenom'>Chambre {$row[1]}</div>
                <div id='chambretage'>Étage {$row[2]}</div>
                <div class='chambretat'>Libre</div>
            </div>
        ");
    }
    if($row[3]==2){
        echo("
        <div class='trois'>
            <div id='chambrenom'>Chambre {$row[1]}</div>
            <div id='chambretage'>Étage {$row[2]}</div>
            <div class='chambretat'>Nettoyage</div>
        </div>
        ");
    }
    if($row[3]==1){
        echo("
        <div class='un'>
                <div id='chambrenom'>Chambre {$row[1]}</div>
                <div id='chambretage'>Étage {$row[2]}</div>
                <div class='chambretat'>Occupée</div>
            </div>
        ");
    }
    
}
?>
</div>

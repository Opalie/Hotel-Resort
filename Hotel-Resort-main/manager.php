<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css-manager.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed&display=swap" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous">
    </script>
    </head>



<?php

session_start();
if(!isset($_SESSION['user_id'])){
    header('location: index.php');
}
  
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

include_once 'header.php'
?>

<div id="titrech">Gestion des chambres</div>

<div id="liste-chambres">

<?php
foreach($rows as $row){
    if($row[3]==3){
        echo("
        <div class='deux' id='{$row[0]}'>
                <div id='chambrenom'>Chambre {$row[1]}</div>
                <div id='chambretage'>Étage {$row[2]}</div>
                <div class='chambretat'>Libre</div>
                <div class='status'>
                    <label for='choix'>Statut</label><br>
                    <input type='button' id='choix' name='choix'>
                </div>
        </div>
        ");
    }
    if($row[3]==2){
        echo("
        <div class='trois' >
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

<script src="script.js"></script>
</div>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css-manager.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/css-modal.css">
    <script src="https://kit.fontawesome.com/0abcd961be.js" crossorigin="anonymous"></script>
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

$sql = "SELECT chambre.*, employe.prenom FROM chambre LEFT OUTER JOIN employe ON chambre.id =employe.id_chambre ORDER BY numero ASC ";
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
        <div class='deux'>
                <div id='chambrenom'>Chambre {$row[1]}</div>
                <div id='chambretage'>Étage {$row[2]}</div>
                <div class='chambretat'>Libre</div>
                <button data-modal-target='#modal-{$row[0]}' class='admin-chambre'><i class='fas fa-cog'></i></button>
            <div class='modal' id='modal-{$row[0]}'>
                <div class='modal-header'>
                    <div class='title'>Chambre {$row[1]}</div>
                    <button data-close-button class='close-button'>&times;</button>
                </div>
                <div class='modal-body'>
                <form action='includes/updateRoom.inc.php' method='post'>
                    <select name='StatusChambre'>
                    <option value='1'>Occupée</option>
                    <option value='2'>A nettoyer</option>
                    <option value='3'>Libre</option>
                    </select>
                    <button type='submit' name='submit'>Attribuer</button>
               
                <input type='hidden' name='id_chambre' value='{$row[0]}'>
            </form>
                </div>
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
            <button data-modal-target='#modal-{$row[0]}' class='admin-chambre'><i class='fas fa-cog'></i></button>
            <div class='modal' id='modal-{$row[0]}'>
                <div class='modal-header'>
                    <div class='title'>Chambre {$row[1]}</div>
                    <button data-close-button class='close-button'>&times;</button>
                </div>
                <div class='modal-body'>
                Affectée à {$row[5]}
                <form action='includes/affectEmployee.inc.php' method='post'>
                    <select name='affectUserList' id='affectUserList'><option value='free' selected>Liberer</option>{$employees}</select>
                    <button type='submit' name='submit'>Effectuer</button>
                    <input type='hidden' name='id_chambre' value='{$row[0]}'>
                </form>
                </div>
            </div>
        </div>
        ");
    }
    if($row[3]==1){
        echo("
        <div class='un'>
                <div id='chambrenom'>Chambre {$row[1]}</div>
                <div id='chambretage'>Étage {$row[2]}</div>
                <div class='chambretat'>Occupée</div>
                <button data-modal-target='#modal-{$row[0]}' class='admin-chambre'><i class='fas fa-cog'></i></button>
            <div class='modal' id='modal-{$row[0]}'>
                <div class='modal-header'>
                    <div class='title'>Chambre {$row[1]}</div>
                    <button data-close-button class='close-button'>&times;</button>
                </div>
                <div class='modal-body'>
                <form action='includes/updateRoom.inc.php' method='post'>
                    <select name='StatusChambre'>
                    <option value='1'>Occupée</option>
                    <option value='2'>A nettoyer</option>
                    <option value='3'>Libre</option>
                    </select>
                    <button type='submit' name='submit'>Attribuer</button>
               
                <input type='hidden' name='id_chambre' value='{$row[0]}'>
            </form>
                </div>
            </div>
            </div>
        ");
    }
    
}
?>

  <div id="overlay"></div>
<script src="script.js"></script>
</div>

<!--
    <div class='deux'>
                <div id='chambrenom'>Chambre {$row[1]}</div>
                <div id='chambretage'>Étage {$row[2]}</div>
                <div class='chambretat'>Libre</div>
                <button data-modal-target='#modal-{$row[0]}' class='admin-chambre'><i class='fas fa-cog'></i></button>
            <div class='modal' id='modal-{$row[0]}'>
                <div class='modal-header'>
                    <div class='title'>Chambre {$row[1]}</div>
                    <button data-close-button class='close-button'>&times;</button>
                </div>
                <div class='modal-body'>
                <form action='includes/updateRoom.inc.php' method='post'>
                    <select name='StatusChambre'>
                    <option value='1'>Occupée</option>
                    <option value='2'>A nettoyer</option>
                    <option value='3'>Libre</option>
                    </select>
                    <button type='submit' name='submit'>Attribuer</button>
               
                <input type='hidden' name='id_chambre' value='{$row[0]}'>
            </form>
                </div>
            </div>
        </div>


-->


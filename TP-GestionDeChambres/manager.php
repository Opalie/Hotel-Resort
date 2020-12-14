<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-manager.css">
    <title>Gestion Des Chambres</title>
</head>



<?php

require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

//===============GET ROOMS===========================

$sql = "SELECT * FROM chambres WHERE id_statut = 2;";
$stmt = mysqli_stmt_init($conn);

if  (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: login.php?error=stmtfailed");
    exit();
}

mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

$rows = mysqli_fetch_all($resultData);

$employees = getFreeEmployees($conn);

?>

<div id="liste-chambres">
<?php
foreach($rows as $row){
echo("
    <div class='container-chambre'>
    <div style='width: 29px;position: absolute;left: 0px;height: 100%;background-color: green;'></div>
    <div class='numeroChambre'>Chambre n°<span class='numeroNumeroChambre'>{$row[1]}</span></div>
        
    <div class='content-chambreManage'>
        <span class='messageSatus' style=' position: absolute; top: 25px;'>
            Disponible
        </span>

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

<?php
 require 'dbh.inc.php';
 require 'functions.inc.php';

 if(isset($_POST['submit'])){
    $employe = $_POST['affectUserList'];
    $id_chambre = $_POST['id_chambre'];

    if($employe == "free"){
       freeEmployee($conn,$id_chambre);
        updateRoom($conn,3,$id_chambre);
    }
    else{
        freeEmployee($conn,$id_chambre);
        affectEmployee($conn,$id_chambre,$employe);
    }
 }
   header("location: ../manager.php");
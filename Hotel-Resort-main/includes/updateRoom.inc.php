<?php
    require 'dbh.inc.php';
    require 'functions.inc.php';

    if(isset($_POST['submit'])){
        $id_chambre = $_POST['id_chambre'];
        $status = $_POST['StatusChambre'];
        updateRoom($conn,$status,$id_chambre);
    }

        header("location: ../manager.php");



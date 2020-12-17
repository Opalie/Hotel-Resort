<?php
    require 'dbh.inc.php';

    if(isset($_POST['submit'])){
        $employee = $_POST['affectUserList'];
        $id_chambre = $_POST['id_chambre'];

        //UPDATE THE ROOM TABLE
        $sql = "UPDATE chambre SET employe_id = ? , status_id = 2 WHERE id = ?; ";
        $stmt = mysqli_stmt_init($conn);

        if  (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../manager.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ii", $employee, $id_chambre);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //UPDATE THE USER TABLE

        $sql = "UPDATE employe SET id_chambre = ? WHERE id = ?; ";
        $stmt = mysqli_stmt_init($conn);

        if  (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../manager.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ii", $id_chambre, $employee);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../manager.php");


    }
    


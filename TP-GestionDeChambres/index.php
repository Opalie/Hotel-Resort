<?php
    session_start();
    if(isset($_SESSION['user_role'])){
        $role = $_SESSION['user_role'];

        if($role === 1){
            header('location: employee.php');
        }

        if($role === 2){
            header('location: receptionist.php');
        }

        if($role === 3){
            header('location: manager.php');
        }
    }
    else{
        header("location: signup.php");
    }
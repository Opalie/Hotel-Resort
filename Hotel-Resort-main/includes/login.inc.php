<?php

if (isset($_POST["submit"])){

    $login = $_POST["login"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if  (emptyInputLogin($login,$pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $login, $pwd);

}

else {
    header("location: ../login.php");
        exit();

}
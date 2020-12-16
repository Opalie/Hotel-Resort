<?php

if  (isset($_POST["submit"])){
    
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $role = $_POST["role"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if  (emptyInputSignup($FirstName,$LastName,$pwd,$pwdRepeat) !== false){
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    $login = strtolower($_POST["FirstName"].".".$_POST["LastName"]);

    if(invalidUid($login) !== false){
        header("location: ../signup.php?error=invaliduid");
        exit();
    }

    if(pwdMatch($pwd,$pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }

    if(uidExists($conn,$login) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn,$login,$pwd,$role);

}

else{
    header("location: ../signup.php");
    exit();
}
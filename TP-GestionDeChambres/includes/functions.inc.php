<?php

function emptyInputSignup($FirstName,$LastName,$pwd,$pwdRepeat){

    if  (empty($FirstName) || empty($LastName) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function invalidUid($login){

    if  (!preg_match("/^[a-z.]*$/", $login)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function invalidEmail($email){

    if  (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function pwdMatch($pwdRepeat,$pwd){
    
    if  ($pwd !== $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function uidExists($conn, $login){

    $sql = "SELECT * FROM users WHERE login = ?;";
    $stmt = mysqli_stmt_init($conn);

    if  (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $login);

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
   
}

function createUser($conn,$login,$pwd,$role){

    $sql = "INSERT INTO users (login,password,id_role) VALUES (?, ?, ?) ;";
    $stmt = mysqli_stmt_init($conn);

    if  (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ssi", $login, $hashedPwd, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    loginUser($conn,$login,$pwd);
}

function emptyInputLogin($login,$pwd){

    if  (empty($login) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function loginUser($conn, $login, $pwd){

    $uidExists = uidExists($conn, $login);

    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["password"];

    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true){
        session_start();
        $_SESSION["user_id"] = $uidExists["id"];
        $_SESSION["user_login"] = $uidExists["login"];
        $_SESSION["user_role"] = $uidExists["id_role"];
        header("location: ../index.php");
    }

}


function getFreeEmployees($conn){
    $sql = "SELECT * FROM users WHERE id_chambre IS null;";
    $stmt = mysqli_stmt_init($conn);

    if  (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    $rows = mysqli_fetch_all($resultData);

    $listeEmployees = "";

    foreach($rows as $row){
        $listeEmployees .= "<option value='{$row[0]}'>" . $row[1] . "</option>";
    }

    return $listeEmployees;

}

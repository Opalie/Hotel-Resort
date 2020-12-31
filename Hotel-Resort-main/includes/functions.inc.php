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

    $sql = "SELECT * FROM utilisateur WHERE mail = ?;";
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

function createUser($conn,$prenom,$nom){

    $sql = "INSERT INTO employe (prenom,nom) VALUES (?, ?) ;";
    $stmt = mysqli_stmt_init($conn);

    if  (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $prenom, $nom);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

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
        header("location: ../index.php?error=wronglogin");
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
        $_SESSION["user_login"] = $uidExists["mail"];
        header("location: ../manager.php");
    }

}


function getFreeEmployees($conn){
    $sql = "SELECT * FROM employe WHERE id_chambre IS NULL;";
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

function updateRoom($conn, $status, $room){
    $sql = "UPDATE chambre SET status_id = ? WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if  (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../manager.php?error=stmt(UpdateRoom)failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $status, $room);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function freeEmployee($conn,$chambre){
    $sql = "UPDATE employe
    SET id_chambre = null
    WHERE id_chambre = ?;";
    $stmt = mysqli_stmt_init($conn);

    if  (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../manager.php?error=stmt(freeEmployee)failed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $chambre);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "UPDATE chambre
    SET employe_id = null
    WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if  (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../manager.php?error=stmt(freeEmployee)failed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $chambre);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function affectEmployee($conn,$id_chambre,$employe){
    $sql = "UPDATE chambre SET employe_id = ? WHERE id = ?; ";
    $stmt = mysqli_stmt_init($conn);

        if  (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../manager.php?error=stmt(affectEmployee)failed");
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
}

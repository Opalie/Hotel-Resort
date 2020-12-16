<?php

$serverName = "localhost";
$cBUsername = "root";
$dBPassWord = "root";
$dBName = "hotel-f2";

$conn = mysqli_connect($serverName,$cBUsername,$dBPassWord,$dBName);

if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
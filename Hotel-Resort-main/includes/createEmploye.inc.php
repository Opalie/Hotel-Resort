<?php
require 'functions.inc.php';
require 'dbh.inc.php';

if(isset($_POST['submit'])){
    createUser($conn,$_POST['prenom'],$_POST['nom']);
    header('location: ../personnel.php');
}


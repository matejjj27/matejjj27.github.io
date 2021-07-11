<?php

if(isset($_POST["submit"])) {

    $username = $_POST["uidA"];
    $pwd = $_POST["pwdA"];

    require_once 'dbh.php';
    require_once 'functions.php';

    if(emptyInputLogin($username, $pwd) !== false) {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    loginAdmin($conn, $username, $pwd);
    }
    else {
        header ("location: ../admin.php");
        exit();
    }
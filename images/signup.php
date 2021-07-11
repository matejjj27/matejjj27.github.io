<?php
    include_once 'dbh.php';

    $first = $_POST['name'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    $sql = "INSERT INTO users (users_name, users_email, users_uid,
    users_pwd) VALUES ('$first', '$email', '$uid', '$pwd');";
    mysqli_query($conn, $sql);

    header("Location: ../index.php?signup=success");
?>
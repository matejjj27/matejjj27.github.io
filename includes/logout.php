<?php

require 'dbh.php';
$stmt = $conn->prepare("TRUNCATE cart");
$stmt->execute();

session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();
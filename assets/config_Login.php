<?php

require_once  __DIR__  . '/../assets/vendor/autoload.php';

$databseConn = new MongoDB\Client("mongodb://localhost:27017");

$mydb = $databseConn->MyDb;
$userCollection = $mydb->users;

// MySQL Database Connection
$mysqlHost = "localhost";
$mysqlUsername = "root";
$mysqlPassword = "";
$mysqlDatabase = "phpmysql";

// $conn = new mysqli($mysqlHost, $mysqlUsername, $mysqlPassword, $mysqlDatabase);

?>
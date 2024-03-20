<?php
require_once __DIR__ . './../assets/vendor/autoload.php';
require_once __DIR__ . './../assets/predis-2.x/autoload.php';

use Predis\Client;

Predis\Autoloader::register();

// Connect to Redis server
$redis = new Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

$databseConn = new MongoDB\Client("mongodb://localhost:27017");

// if ($databseConn) {
//     // echo "Connected to MongoDB successfully";
// } else {
//     // echo "Failed to connect to MongoDB";
// }

$mydb = $databseConn->Guvi;

$userCollection = $mydb->Users;

$mysqlHost = "localhost";
$mysqlUsername = "root";
$mysqlPassword = "";
$mysqlDatabase = "project";

$mysqlConn = new mysqli($mysqlHost, $mysqlUsername, $mysqlPassword, $mysqlDatabase);

if ($mysqlConn->connect_error) {
    die($mysqlConn->connect_error);
}
?>

<?php
// connecting the Database
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $checkEmailQuery = "SELECT * FROM login WHERE uname = '$email' AND upswd = '$password'";
    $result = $mysqlConn->query($checkEmailQuery);

    if ($result->num_rows > 0) {

        if ($redis->exists($email)) {
            $userDataSerialized = $redis->get($email);
            $userData = unserialize($userDataSerialized);
            echo json_encode(array("userFound" => "true", "userData" => $userData));
        } else {
            $filter = array("Email" => $email);
            $res = $userCollection->findOne($filter);

            if ($res) {

                $userDataSerialized = serialize($res);
                $redis->set($email, $userDataSerialized);

                $var = $redis->get($email);

                $userData = unserialize($var);

                echo json_encode(array("userFound" => "true", "userData" => $userData));
            }
        }
    }
    else{
        echo json_encode(array("userFound" => "false"));
    }
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo "Only POST requests are allowed!";
}

$mysqlConn->close();
?>

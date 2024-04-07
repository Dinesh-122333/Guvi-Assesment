<?php
// connecting the Database
require "./../assets/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $checkEmailQuery = "SELECT * FROM login WHERE uname = '$email' AND upswd = '$password'";
    $result = $mysqlConn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Set the email in the session variable
        session_start();
        $_SESSION['email'] = $email;

        // Fetch user data from MongoDB and echo JSON response
        $filter = array("Email" => $email);
        $res = $userCollection->findOne($filter);

        if ($res) {
            echo json_encode(array("userFound" => "true", "userData" => $res));
        } else {
            echo json_encode(array("userFound" => "false"));
        }
    } else {
        echo json_encode(array("userFound" => "false"));
    }
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo "Only POST requests are allowed!";
}

$mysqlConn->close();
?>

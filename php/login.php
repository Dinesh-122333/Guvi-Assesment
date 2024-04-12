<?php
<<<<<<< HEAD
// Connecting to the database
=======
// connecting the Database
>>>>>>> 02a9f74b9ced12f43bfbc645c5c0be4d28fe5138
require "./../assets/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    // Prepare and bind the SELECT statement
    $checkEmailQuery = "SELECT * FROM login WHERE uname = ? AND upswd = ?";
    $stmt = $mysqlConn->prepare($checkEmailQuery);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
<<<<<<< HEAD
        $data = array(
            "Email" => $email,
        );
        $find = $userCollection->findOne($data);
        if ($find) {
            $redisKey = $email;
            $redisValue = json_encode($find);
            $redis->set($redisKey, $redisValue);
            $value = $redis->get($email);

            echo json_encode(['success' => true, 'message' => 'Login successful' , "user" => $find,"value" => $value]);
        } else {
            echo json_encode(['success' => false, 'message' => 'data not found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
    
    $mysqlConn->close();
=======
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
>>>>>>> 02a9f74b9ced12f43bfbc645c5c0be4d28fe5138
}
?>

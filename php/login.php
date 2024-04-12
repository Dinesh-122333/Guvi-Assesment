<?php
// Connecting to the database
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
}
?>

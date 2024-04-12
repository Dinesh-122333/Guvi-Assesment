<?php

require "./../assets/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    // Prepare and bind the SELECT statement
    $checkEmailQuery = "SELECT * FROM login WHERE uname = ?";
    $stmt = $mysqlConn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        // Prepare and bind the INSERT statement
        $insertSql = "INSERT INTO login (uname, upswd) VALUES (?, ?)";
        $stmt = $mysqlConn->prepare($insertSql);
        $stmt->bind_param("ss", $email, $password);
        
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertSql . "<br>" . $stmt->error;
        }

        // Insert data into MongoDB
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $age = $_POST['age'];

        $data = array(
            "Firstname" => $fname,
            "Lastname" => $lname,
            "Email" => $email,
            "Phone Number" => $phone,
            "Date of Birth" => $dob,
            "Age" => $age,
            "City" => $city
        );

        $insert = $userCollection->insertOne($data);

        if ($insert->getInsertedCount() > 0) {
            echo "Document inserted successfully!";
        } else {
            echo "Error inserting data: " . $insert->getMessage();
        }
    }
    $mysqlConn->close();
}

?>

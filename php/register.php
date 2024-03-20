<?php

require "config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $checkEmailQuery = "SELECT * FROM login WHERE uname = '$email'";
    $result = $mysqlConn->query($checkEmailQuery);


    if ($result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        $insertSql = "INSERT INTO login (uname, upswd) VALUES ('$email', '$password')";
        
        if ($mysqlConn->query($insertSql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertSql . "<br>" . $mysqlConn->error;
        }

		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];


		$data = array(
			"Firstname" => $fname,
			"Lastname" => $lname,
			"Email" => $email,
			"Phone Number" => $phone,
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
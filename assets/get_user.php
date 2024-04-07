<?php
session_start(); // Initialize the session

// Include MongoDB configuration file
require "./../assets/config.php";

// Check if the session variable is set
if(isset($_SESSION['email'])) {
    // Fetch user data from MongoDB
    $filter = array("Email" => $_SESSION['email']); // Assuming you have a session variable storing the user's email
    $userData = $userCollection->findOne($filter);

    if ($userData) {
        // Convert MongoDB document to JSON format
        echo json_encode($userData);
    } else {
        // If user data not found, return an error response
        http_response_code(404); // Not Found
        echo json_encode(array("message" => "User data not found."));
    }
} else {
    // If session variable is not set, return an error response
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Session variable 'email' is not set."));
}
?>

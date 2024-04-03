<?php
// Include MongoDB extension
require '../assets/vendor/autoload.php';

use MongoDB\Client;

// MongoDB connection parameters
$mongoClient = new Client("mongodb://localhost:27017");
$mongoDatabase = $mongoClient->selectDatabase('Guvi'); // Replace 'Guvi' with your actual database name
$mongoCollection = $mongoDatabase->selectCollection('Users'); // Replace 'Users' with your actual collection name

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $FirstName = $_POST["firstName"];
    $LastName = $_POST["lastName"];
    $EmailID = $_POST["email"];
    $PhoneNumber = $_POST["phone"];

    // Update the user profile in MongoDB
    $result = $mongoCollection->updateOne(
        ['Email' => $EmailID], // Filter condition (e.g., email)
        ['$set' => [
            'Firstname' => $FirstName,
            'Lastname' => $LastName,
            'Email' => $EmailID,
            'Phone Number' => $PhoneNumber
        ]]
    );

    // Check if the update was successful
    if ($result->getModifiedCount() > 0) {
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
    }
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo "Only POST requests are allowed!";
}
?>

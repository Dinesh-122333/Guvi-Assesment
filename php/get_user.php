<?php
// Include MongoDB extension
require '../assets/vendor/autoload.php';

use MongoDB\Client;

// MongoDB connection parameters
$mongoClient = new Client("mongodb://localhost:27017");
$mongoDatabase = $mongoClient->selectDatabase('Guvi'); // Replace 'Guvi' with your actual database name
$mongoCollection = $mongoDatabase->selectCollection('Users'); // Replace 'Users' with your actual collection name

// Fetch user data
$userData = $mongoCollection->findOne([]);

// Check if user data exists
if ($userData) {
    // Return success response with user data
    echo json_encode(['status' => 'success', 'user' => $userData]);
} else {
    // Return error response if user data not found
    echo json_encode(['status' => 'error', 'message' => 'User data not found']);
}
?>

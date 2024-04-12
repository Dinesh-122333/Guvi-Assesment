<?php
<<<<<<< HEAD
require_once "../assets/config.php";

$email = $_GET['email'];
$jsonData = $redis->get($email);

if ($jsonData) {
    $userData = json_decode($jsonData, true);
    echo json_encode(['success' => true, 'data' => $userData]);
} else {
    echo json_encode(['success' => false, 'message' => 'Data not found']);
}
?>
=======
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
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $city = $_POST['city'];

    // Check if the data is different from the existing data in the database
    $userData = $mongoCollection->findOne(['Email' => $EmailID]);
    if ($userData && ($userData['Firstname'] !== $FirstName || $userData['Lastname'] !== $LastName || $userData['Phone Number'] !== $PhoneNumber || $userData['Date of Birth'] !== $dob || $userData['Age'] !== $age || $userData['City'] !== $city)) {
        // Update the user profile in MongoDB
        $updateResult = $mongoCollection->updateOne(
            ['Email' => $EmailID], // Filter condition (e.g., email)
            ['$set' => [
                'Firstname' => $FirstName,
                'Lastname' => $LastName,
                'Phone Number' => $PhoneNumber,
                'Date of Birth' => $dob,
                'Age'=> $age,
                'City'=> $city
            ]]
        );
       
        // Check if the update operation was acknowledged
        if ($updateResult->getMatchedCount() > 0 && $updateResult->getModifiedCount() > 0) {
            // Retrieve the updated user data from MongoDB
            $userData = $mongoCollection->findOne(['Email' => $EmailID]);
            // Return success response along with user data
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully', 'userData' => $userData]);
        } else {
            // Return error response with detailed message
            echo json_encode(['status' => 'error', 'message' => 'Failed to update profile: No modifications were made']);
        }
    } else {
        // No changes were detected, return success response with existing user data
        echo json_encode(['status' => 'success', 'message' => 'Profile is already up to date', 'userData' => $userData]);
    }
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo "Only POST requests are allowed!";
}
?>
>>>>>>> 02a9f74b9ced12f43bfbc645c5c0be4d28fe5138

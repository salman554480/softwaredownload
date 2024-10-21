<?php

// Database connection parameters
require_once('db.php');

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user_level and user_token from the POST data
    $user_level = $_POST['user_level'];
    $user_token = $_POST['user_token'];

    // Prepare and execute SQL query to update user_level in user table based on user_token
    $update_query = "UPDATE user SET user_level = ? WHERE user_token = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('ss', $user_level, $user_token);

    if ($stmt->execute()) {
        // If the update is successful
        http_response_code(200);
        echo json_encode(array('message' => 'User level updated successfully'));
    } else {
        // If the update fails
        http_response_code(500);
        echo json_encode(array('error' => 'Failed to update user level'));
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request method is not POST, respond with a "Method Not Allowed" error
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed'));
}

// Close the database connection
$conn->close();
?>

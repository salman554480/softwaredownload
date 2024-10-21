<?php

// Database connection parameters
require_once('db.php');

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Validate parameters
    if (empty($_GET['user_token']) || empty($_GET['ecg_id'])) {
        http_response_code(400);
        echo json_encode(array('error' => 'user_token and ecg_id are required'));
        exit();
    }

    $user_token = $_GET['user_token'];
    $ecg_id = $_GET['ecg_id'];

    // Fetch all records from sectionselected table associated with user_token and ecg_id
    $select_query = "
        SELECT ss.user_token, ss.sectionoption_id, ss.selected_status, so.section_id, so.sectionoption_name
        FROM sectionselected ss
        LEFT JOIN sectionoption so ON ss.sectionoption_id = so.sectionoption_id
        WHERE ss.user_token = ? AND ss.ecg_id = ?";

    $stmt = $conn->prepare($select_query);
    $stmt->bind_param('si', $user_token, $ecg_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the results
    $sectionselected_records = array();
    while ($row = $result->fetch_assoc()) {
        $sectionselected_records[] = $row;
    }

    // Close the statement
    $stmt->close();

    // Respond with the fetched records
    http_response_code(200);
    echo json_encode($sectionselected_records);
} else {
    // If the request method is not GET, respond with a "Method Not Allowed" error
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed'));
}

// Close the database connection
$conn->close();

?>

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
    if (empty($_GET['ecg_id'])) {
        http_response_code(400);
        echo json_encode(array('error' => 'ecg_id is required'));
        exit();
    }

    $ecg_id = $_GET['ecg_id'];

    // Prepare and execute query to fetch records from sectionanswers table
    $sectionanswers_query = "SELECT * FROM sectionanswers WHERE ecg_id = ?";
    $stmt_sectionanswers = $conn->prepare($sectionanswers_query);
    $stmt_sectionanswers->bind_param('i', $ecg_id);
    $stmt_sectionanswers->execute();
    $result_sectionanswers = $stmt_sectionanswers->get_result();

    // Array to store fetched records
    $sectionanswers_records = array();

    // Fetch records from sectionanswers table
    while ($row_sectionanswers = $result_sectionanswers->fetch_assoc()) {
        $sectionoption_id = $row_sectionanswers['sectionoption_id'];

        // Prepare and execute query to fetch record from sectionoption table for each sectionoption_id
        $sectionoption_query = "SELECT * FROM sectionoption WHERE sectionoption_id = ?";
        $stmt_sectionoption = $conn->prepare($sectionoption_query);
        $stmt_sectionoption->bind_param('i', $sectionoption_id);
        $stmt_sectionoption->execute();
        $result_sectionoption = $stmt_sectionoption->get_result();

        // Fetch all records from sectionoption table for the current sectionoption_id
        while ($row_sectionoption = $result_sectionoption->fetch_assoc()) {
            // Add fetched record to the result array
            $sectionanswers_records[] = $row_sectionoption;
        }

        // Close the statement for sectionoption query
        $stmt_sectionoption->close();
    }

    // Close the statement for sectionanswers query
    $stmt_sectionanswers->close();

    // Respond with the fetched records
    http_response_code(200);
    echo json_encode($sectionanswers_records);
} else {
    // If the request method is not GET, respond with a "Method Not Allowed" error
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed'));
}

// Close the database connection
$conn->close();

?>

<?php

// Database connection parameters
require_once('../parts/db.php');

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw JSON data
    $json_data = file_get_contents('php://input');

    // Decode JSON data
    $data = json_decode($json_data, true);

    // Validate JSON data
    if (empty($data['user_token']) || empty($data['ecg_id']) || empty($data['sectionoption_id'])) {
        http_response_code(400);
        echo json_encode(array('error' => 'user_token, ecg_id, and sectionoption_id are required'));
        exit();
    }

    $user_token = $data['user_token'];
    $ecg_id = $data['ecg_id'];
    $sectionoption_id = $data['sectionoption_id'];

    // Check if a record already exists for the given user_token, ecg_id, and sectionoption_id
    $check_existing_record_query = "SELECT COUNT(*) FROM sectionselected WHERE user_token = ? AND ecg_id = ? AND sectionoption_id = ?";
    $stmt_check_existing_record = $conn->prepare($check_existing_record_query);
    $stmt_check_existing_record->bind_param('sii', $user_token, $ecg_id, $sectionoption_id);
    $stmt_check_existing_record->execute();
    $stmt_check_existing_record->bind_result($existing_count);
    $stmt_check_existing_record->fetch();

    if ($existing_count > 0) {
        // If a record already exists, return a message
        http_response_code(400);
        echo json_encode(array('error' => 'A record already exists for the given user_token, ecg_id, and sectionoption_id'));
        exit();
    }

    // Close the statement
    $stmt_check_existing_record->close();
    
    
     // Count Total in sectionselected for user_token, ecg_id, 
    $check_total_record_query = "SELECT COUNT(*) FROM sectionselected WHERE user_token = ? AND ecg_id = ? ";
    $stmt_check_total_record = $conn->prepare($check_total_record_query);
    $stmt_check_total_record->bind_param('si', $user_token, $ecg_id);
    $stmt_check_total_record->execute();
    $stmt_check_total_record->bind_result($total_sectionselected_count);
    $stmt_check_total_record->fetch();
   // close the statement
    $stmt_check_total_record->close();
    
    
    
     // Count Total Answer
    $check_total_answer_query = "SELECT COUNT(*) FROM sectionanswers WHERE ecg_id = ? ";
    $stmt_check_total_answer = $conn->prepare($check_total_answer_query);
    $stmt_check_total_answer->bind_param('i',  $ecg_id);
    $stmt_check_total_answer->execute();
    $stmt_check_total_answer->bind_result($total_answer_count);
    $stmt_check_total_answer->fetch();
   // close the statement
    $stmt_check_total_answer->close();
    
    
    $right = 'right';
     // Check if a right already exists for the given user_token, ecg_id, 
    $check_total_right_query = "SELECT COUNT(*) FROM sectionselected WHERE user_token = ? AND ecg_id = ? AND selected_status = ?";
    $stmt_check_total_right = $conn->prepare($check_total_right_query);
    $stmt_check_total_right->bind_param('sis', $user_token, $ecg_id, $right);
    $stmt_check_total_right->execute();
    $stmt_check_total_right->bind_result($total_right_count);
    $stmt_check_total_right->fetch();
   // close the statement
    $stmt_check_total_right->close();
    
    
    

// Given values
$total_answer = $total_answer_count;
$total_right_answer = $total_right_count;

// Calculate percentage
$accuracy = ($total_right_answer / $total_answer) * 100;

$accuracy = round($accuracy);


    
    

    // Fetch the answer status from sectionanswers table
    $fetch_answer_query = "SELECT sectionoption_id FROM sectionanswers WHERE ecg_id = ? AND sectionoption_id = ?";
    $stmt_fetch_answer = $conn->prepare($fetch_answer_query);
    $stmt_fetch_answer->bind_param('ii', $ecg_id, $sectionoption_id);
    $stmt_fetch_answer->execute();
    $stmt_fetch_answer->store_result();

    // Get the number of rows returned
    $num_rows = $stmt_fetch_answer->num_rows;

    // Determine selected status based on the number of rows
    $selected_status = ($num_rows > 0) ? 'right' : 'wrong';

    // Close the statement
    $stmt_fetch_answer->close();

    // Insert data into the sectionselected table
    $insert_sectionselected_query = "INSERT INTO sectionselected (user_token, ecg_id, sectionoption_id, selected_status) VALUES (?, ?, ?, ?)";
    $stmt_insert_sectionselected = $conn->prepare($insert_sectionselected_query);
    $stmt_insert_sectionselected->bind_param('siis', $user_token, $ecg_id, $sectionoption_id, $selected_status);

    if ($stmt_insert_sectionselected->execute()) {
        // Get the auto-generated sectionselected_id
        $sectionselected_id = $stmt_insert_sectionselected->insert_id;

        // Respond with the inserted sectionselected_id
        http_response_code(200);
        echo json_encode(array('sectionselected_id' => $sectionselected_id, 'total_selected' => $total_sectionselected_count, 'total_asnwer' => $total_answer_count, 'total_right_count' => $total_right_count, 'accuracy' => $accuracy));
        
        
        //update accuracy
        // Prepare and execute the update query
        $update_query = "UPDATE ecgstatus SET ecg_accuracy = ? WHERE user_token = ? AND ecg_id = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param('isi', $accuracy, $user_token, $ecg_id);
        
        if ($stmt_update->execute()) {
            echo "Accuracy updated successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        
        // Close the statement and database connection
        $stmt_update->close();
        
        
        
    } else {
        // If the insertion fails, respond with an error
        http_response_code(500);
        echo json_encode(array('error' => 'Failed to insert into sectionselected table'));
    }

    $stmt_insert_sectionselected->close();
} else {
    // If the request method is not POST, respond with a "Method Not Allowed" error
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed'));
}

// Close the database connection
$conn->close();
?>

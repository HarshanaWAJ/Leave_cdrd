<?php
// Include the database connection file
include 'db.php';

// Check if the necessary POST data is provided
if (isset($_POST['id']) && isset($_POST['reason_for_delete'])) {
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize inputs
    $id = $conn->real_escape_string($_POST['id']);
    $reason_for_delete = $conn->real_escape_string($_POST['reason_for_delete']);

    // Log the reason for deletion before deleting the record (optional)
    // $logSql = "INSERT INTO deletion_logs (application_id, reason_for_delete, deleted_at) VALUES (?, ?, NOW())";
    // $logStmt = $conn->prepare($logSql);
    // if ($logStmt) {
    //     $logStmt->bind_param("is", $id, $reason_for_delete);
    //     $logStmt->execute();
    //     $logStmt->close();
    // }

    // SQL query to delete the record from leave_applications
    $deleteSql = "DELETE FROM leave_applications WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($deleteSql);

    if ($stmt === false) {
        echo "Error in preparing delete statement: " . $conn->error;
    } else {
        // Bind parameters
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect after success
            header("Location: manage_application.php?status_deleted=true");
            exit();
        } else {
            echo "Error in executing delete statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
} else {
    echo "ID or reason not provided";
}
?>

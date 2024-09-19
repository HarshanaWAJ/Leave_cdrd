<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection file
    include 'db.php';

    // Get the intern_id and status from the form submission
    $id = $_POST['id'];
    $newStatus = $_POST['status'];

    // SQL query to update the status in the 'leave_applications' table
    $updateSql = "UPDATE leave_applications_officers SET status = ? WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($updateSql);

    if ($stmt === false) {
        echo "Error in preparing statement: " . $conn->error;
    } else {
        // Bind parameters
        $stmt->bind_param("ss", $newStatus, $id);

        // Execute the statement
        $result = $stmt->execute();

        if ($result === false) {
            echo "Error in updating status: " . $stmt->error;
        } else {
            // Redirect back to the original page with a success parameter
            header("Location: approve_leave_cc.php?status_updated=true");
            exit();
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection (from db.php)
    $conn->close();
}
?>

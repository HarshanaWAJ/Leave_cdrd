<?php
// Include the database connection file
include 'db.php';

// Check if the officer ID is provided
if (isset($_POST['id'])) {
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the officer ID to prevent SQL injection
    $id = $conn->real_escape_string($_POST['id']);

    // SQL query to delete the officer
    $sql = "DELETE FROM leave_applications_officers WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Officer deleted successfully
        // Redirect back to the same page
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error deleting officer: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Officer ID not provided";
}
?>

<?php
// Include the database connection file
include 'db.php';

// Check if intern_id is provided in the POST request
if (isset($_POST['external_id'])) {
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the intern_id to prevent SQL injection
    $externalId = $conn->real_escape_string($_POST['external_id']);

    // SQL query to delete the intern with the specified intern_id
    $sql = "DELETE FROM external_research_officer WHERE external_id = '$externalId'";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page where interns are managed
        header("Location: manage_ero.php");
        exit();
    } else {
        echo "Error deleting external research officer: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    // Redirect to the page where interns are managed if intern_id is not provided
    header("Location: manage_ero.php");
    exit();
}
?>

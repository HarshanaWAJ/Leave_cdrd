<?php
// Include the database connection file
include 'db.php';

// Get fromDate and toDate from the AJAX request (sanitize user input)
$fromDate = mysqli_real_escape_string($conn, $_POST['fromDate']);
$toDate = mysqli_real_escape_string($conn, $_POST['toDate']);
$position = mysqli_real_escape_string($conn, $_POST['position']);

// SQL query to retrieve leaves for officers within the selected date range
$sql = "SELECT * FROM leave_applications_officers WHERE position = '$position' AND from_date BETWEEN '$fromDate' AND '$toDate'";

// Perform the query and check for errors
$result = $conn->query($sql);
if (!$result) {
    die("Error: " . $conn->error);
}

// Output the results in a table
if ($result->num_rows > 0) {
    // Output the leave data as a table row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['officer_number']) . "</td>";
        echo "<td>" . htmlspecialchars($row['leave_type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['from_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['to_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['position']) . "</td>";
        echo "</tr>";
    }
} else {
    // Output a message if there are no leaves in the table
    echo "<tr><td colspan='6'>No leaves found</td></tr>";
}

// Close the database connection
$conn->close();
?>

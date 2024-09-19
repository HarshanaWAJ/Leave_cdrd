<?php
include 'db.php';

// Get fromDate and toDate from the AJAX request (sanitize user input)
$fromDate = mysqli_real_escape_string($conn, $_POST['fromDate']);
$toDate = mysqli_real_escape_string($conn, $_POST['toDate']);
$force = isset($_POST['force']) ? mysqli_real_escape_string($conn, $_POST['force']) : '';
    

    // Fetch filtered leave data for officers
    $queryOfficers = "SELECT leave_applications_officers.*, officers.*
    FROM leave_applications_officers 
    INNER JOIN officers ON leave_applications_officers.officer_number = officers.officer_number
    WHERE from_date BETWEEN '$fromDate' AND '$toDate' AND
    (
        (leave_applications_officers.position = 'Research Officer' AND leave_applications_officers.status = 'approve' AND leave_applications_officers.status1 = 'approve' AND leave_applications_officers.status2 = 'approve' AND leave_applications_officers.status3 = 'approve') OR
        (leave_applications_officers.position = 'Quater Master' AND leave_applications_officers.status3 = 'approve') OR
        (leave_applications_officers.position = 'Account Officer' AND leave_applications_officers.status3 = 'approve') OR
        (leave_applications_officers.position = 'Wing Head' AND leave_applications_officers.status2 = 'approve' AND leave_applications_officers.status3 = 'approve') OR
        (leave_applications_officers.position = 'Staff Officer 1' AND leave_applications_officers.status3 = 'approve') OR
        (leave_applications_officers.position = 'Cheif Controller' AND leave_applications_officers.status3 = 'approve') OR
        (leave_applications_officers.position = 'Cheif Coordinator' AND leave_applications_officers.status3 = 'approve') OR
        (leave_applications_officers.position = 'Deputy Director Gene' AND leave_applications_officers.status3 = 'approve')
    )";

if (!empty($force)) {
    $queryOfficers .= " AND officers.forcee = '$force' OR officers.name = '$force'";
}
   // Perform the query and check for errors
$result = $conn->query($queryOfficers);
if (!$result) {
    die("Error: " . $conn->error);
}

// Output the results in a table
if ($result->num_rows > 0) {
    // Output the leave data as a table row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $row['officer_number'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['rank'] . '</td>';
        echo '<td>' . $row['leave_type'] . '</td>';
        echo '<td>' . $row['from_date'] . '</td>';
        echo '<td>' . $row['to_date'] . '</td>';
        echo '<td>' . $row['from_time'] . '</td>';
        echo '<td>' . $row['to_time'] . '</td>';
        echo '<td>' . $row['number_of_days'] . '</td>';
        echo '<td>' . $row['reason'] . '</td>';
        echo '<td>' . $row['remarks'] . '</td>';
        echo "</tr>";
    }
} else {
    // Output a message if there are no leaves in the table
    echo "<tr><td colspan='6'>No leaves found</td></tr>";
}

// Close the database connection
$conn->close();
?>
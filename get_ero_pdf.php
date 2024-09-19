<?php
include 'db.php';

if (isset($_POST['fromDate']) && isset($_POST['toDate'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Fetch filtered leave data for interns
    $queryERO = "SELECT * FROM leave_applications_ero WHERE from_date BETWEEN '$fromDate' AND '$toDate' AND status3 = 'approve'";
    $resultERO = mysqli_query($conn, $queryERO );

    // Fetch filtered leave data for officers
    
    // Output the intern data
    if ($resultERO) {
        while ($row = mysqli_fetch_assoc($resultERO)) {
            echo '<tr style="color: black;">';
            echo '<td>' . $row['external_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['leave_type'] . '</td>';
            echo '<td>' . $row['from_date'] . '</td>';
            echo '<td>' . $row['from_date'] . '</td>';
            echo '<td>' . $row['to_time'] . '</td>';
            echo '<td>' . $row['to_time'] . '</td>';
            echo '<td>' . $row['number_of_days'] . '</td>';
            echo '<td>' . $row['reason'] . '</td>';
            echo '</tr>';
        }
    }

    
}
?>

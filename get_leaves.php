<?php
include 'db.php';

if (isset($_POST['fromDate']) && isset($_POST['toDate'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    $sql = "SELECT * FROM leave_applications WHERE from_date BETWEEN '$fromDate' AND '$toDate' AND status3='approve'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            
            echo "<td>" . $row['intern_id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['leave_type'] . "</td>";
            echo "<td>" . $row['number_of_days'] . "</td>";
            echo "<td>" . $row['from_date'] . "</td>";
            echo "<td>" . $row['to_date'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No leaves found</td></tr>";
    }
}

$conn->close();
?>

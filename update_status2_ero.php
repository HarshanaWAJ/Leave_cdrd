<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection file
    include 'db.php';

    // Get the id, status2, and remark from the form submission
    $id = $_POST['id'];
    $newStatus = $_POST['status2']; // This will correctly get the value for delete
    $remark = $_POST['remark'];

    if ($newStatus === 'delete') {
        // SQL query to update the reason_for_delete and status in the 'leave_applications' table
        $deleteSql = "UPDATE leave_applications_ero SET reason_for_delete = ?, status2 = 'Deleted' WHERE id = ?";

        // Prepare the statement for deleting
        $stmt = $conn->prepare($deleteSql);

        if ($stmt === false) {
            echo "Error in preparing delete statement: " . $conn->error;
        } else {
            // Bind parameters: 's' for string (reason), 'i' for integer (id)
            $stmt->bind_param("si", $remark, $id);

            // Execute the statement
            $result = $stmt->execute();

            if ($result === false) {
                echo "Error in updating reason for delete: " . $stmt->error;
            } else {
                // Redirect to the approval page after delete
                header("Location: approve_leave_SO1.php?status_deleted=true");
                exit();
            }

            // Close the delete statement
            $stmt->close();
        }
    } else {
        // SQL query to update status2 and remarks for other actions
        $updateSql = "UPDATE leave_applications_ero SET status2 = ?, remarks = ? WHERE id = ?";

        // Prepare the statement
        $stmt = $conn->prepare($updateSql);

        if ($stmt === false) {
            echo "Error in preparing statement: " . $conn->error;
        } else {
            // Bind parameters
            $stmt->bind_param("ssi", $newStatus, $remark, $id);

            // Execute the statement
            $result = $stmt->execute();

            if ($result === false) {
                echo "Error in updating status: " . $stmt->error;
            } else {
                // Redirect back to the original page with a success parameter
                header("Location: approve_leave_SO1.php?status_updated=true");
                exit();
            }

            // Close the statement
            $stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
}
?>

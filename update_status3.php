<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection file
    include 'db.php';

    // Get the id, status, and remark from the form submission
    $id = $_POST['id'];
    $newStatus = $_POST['status'];
    $remark = $_POST['remark'];

    // Check if the action is 'delete'
    if ($newStatus === 'delete') {
        // SQL query to update the reason_for_delete and status in the 'leave_applications' table
        $deleteSql = "UPDATE leave_applications SET reason_for_delete = ?, status3 = 'Deleted' WHERE id = ?";

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
        // Handle the normal update action (Approve/Decline)
        // SQL query to update the status3 and remarks in the 'leave_applications' table
        $updateSql = "UPDATE leave_applications SET status3 = ?, remarks = ? WHERE id = ?";

        // Prepare the statement for status update
        $stmt = $conn->prepare($updateSql);

        if ($stmt === false) {
            echo "Error in preparing update statement: " . $conn->error;
        } else {
            // Bind parameters: 's' for string (status, remark), 'i' for integer (id)
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

            // Close the update statement
            $stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<?php
include 'db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set in $_POST
    if (isset($_POST["officerId"]) && isset($_POST["deleteReason"])) {
        $officerId = filter_input(INPUT_POST, "officerId", FILTER_SANITIZE_STRING);
        $deleteReason = filter_input(INPUT_POST, "deleteReason", FILTER_SANITIZE_STRING);

        // Update your database with the reason for deletion
        $sql = "UPDATE leave_applications_officers SET delete_record = ? WHERE officer_id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $deleteReason, $officerId);
            
            if ($stmt->execute()) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted',
                        text: 'Record deleted successfully!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'manage_application.php';
                        }
                    });
                </script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
        }
    } else {
        echo "Required fields are missing.";
    }
    
    $conn->close();
}
?>
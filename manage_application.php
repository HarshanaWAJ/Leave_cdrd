<?php
include 'db.php';

session_start();
if ($_SESSION['officer_username'] == "") {
    header("Location: login.php");
  exit;
}

// Initialize total count
$totalCount = 0;

// First SQL query
$sql1 = "SELECT * 
         FROM leave_applications_officers 
         WHERE (status2 IN ('pending', 'Unknown') OR status2 IS NULL OR status2 = '')
         AND ((status1 = 'approve' OR (position IN ('Wing Head', 'Quater Master') AND status = 'approve')) OR position = 'Account Officer' OR assigned_officer_name = 'None')";
         
$result1 = $conn->query($sql1);
$count1 = $result1->num_rows;
$totalCount += $count1;

// Second SQL query
$sql2 = "SELECT * FROM leave_applications_officers WHERE (status IN ('pending', 'Unknown') OR status IS NULL OR status = '')";
$result2 = $conn->query($sql2);
$count2 = 0;

while ($row = $result2->fetch_assoc()) {
    if ($row['assigned_officer_name'] == $_SESSION['officer_name']) {
        $count2++;
    }
}
$totalCount += $count2;

// Third SQL query
$sql3 = "SELECT * FROM leave_applications_ero WHERE status1='approve' AND (status2 IN ('pending', 'Unknown') OR status2 IS NULL OR status2 = '')";
$result3 = $conn->query($sql3);
$count3 = $result3->num_rows;
$totalCount += $count3;

// Fourth SQL query
$sql4 = "SELECT * FROM leave_applications WHERE (status2 = 'approve') AND (status3 IN ('pending', 'Unknown') OR status3 IS NULL OR status3 = '')";
$result4 = $conn->query($sql4);
$count4 = $result4->num_rows;
$totalCount += $count4;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre for Defense Research and Development</title>
    <link rel="icon" href="./assets/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <style type="text/css">
        .notif:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
        .sidebar-menu-container {
    max-height: calc(100vh - 80px); /* Adjust height as needed */
    overflow-y: auto;
}

/* Optional: To style the scrollbar */
.sidebar-menu-container::-webkit-scrollbar {
    width: 8px;
}

.sidebar-menu-container::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
}

.sidebar-menu-container::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}
.fixed-card {
      height: 400px;
      overflow-y: auto;
    }
    
        @keyframes moveLeftRight {
            0% { transform: translateX(0); }
            50% { transform: translateX(100%); }
            100% { transform: translateX(0); }
        }
        .moving-text {
            display: inline-block;
            animation: moveLeftRight 5s linear infinite;
        }
        .fa-gift {
            color: #ff6347;
            animation: bumpGift 0.5s infinite alternate;
        }
        @keyframes bumpGift {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }
        .birthday{
          text-align: center;
          color: blueviolet;
          font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        .custom-badge {
        background-color: yellow;
        color: red;
        border-radius: 50%;
        padding: 5px 10px;
        display: inline-block;
        text-align: center;
        margin-left: 40px;
        font-weight: bold; /* Make the text bold */
    }

    .flex-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .icon-spacing {
        margin-right: 10px; /* Add gap between icon and text */
    }

    </style>
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div id="app">
        <div id="sidebar" class='active'>
            
            <div class="sidebar-wrapper active">
               <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                  <a href="clerk.php" class="sidebar-link">
                    <i class="text-primary me-4"></i>
                    <img src="./assets/images/logo.jpg" />
                    <span>CDRD</span>
                    </a>
                </div>
               <div class="sidebar-menu">
               <ul class="menu">
                     <li class="sidebar-item">
                        <a href="so1.php" class='sidebar-link'>
                        <i class="fa fa-home text-primary"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="so1_apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-upload text-primary"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="so1_leave_status.php" class='sidebar-link'>
                        <i class="fa fa-clock text-primary"></i>
                        <span>Leave Status</span>
                        </a>
                     </li>
                     <li class="sidebar-item">
                        <a href="approve_leave_SO1.php" class="sidebar-link">
                            <i class="fa fa-check-circle text-primary icon-spacing"></i>
                            <div class="flex-container">
                                <span>Approve Leaves</span>
                                <?php if ($totalCount > 0): ?>
                                    <span class="custom-badge"><?php echo $totalCount; ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a href="manage_application.php" class='sidebar-link'>
                        <i class="fa fa-file-alt text-primary"></i>
                        <span>Manage Applications</span>
                        </a>
                     </li>
                     <li class="sidebar-item">
                        <a href="decline_application.php" class='sidebar-link'>
                        <i class="fa fa-file text-primary"></i>
                        <span>Decline Applications</span>
                        </a>
                     </li>
                     <li class="sidebar-item">
                        <a href="officer_download_leave_details.php" target="_blank"  class='sidebar-link'>
                        <i class="fa fa-download text-primary"></i>
                        <span>Download Leave Details</span>
                        </a>
                     </li>
                     <li class="sidebar-item">
                        <a href="intern_download_leave_details.php" target="_blank"  class='sidebar-link'>
                        <i class="fa fa-download text-primary"></i>
                        <span>Download Intern Leave Details</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                            <a href="update_officer_info.php" target="_blank" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="update_password_officer.php" target="_blank" class='sidebar-link'>
                                <i class="fa fa-cog text-primary"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="logout.php" class='sidebar-link'>
                                <i class="fa fa-sign-out-alt text-primary"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                  </ul>
               </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
                                    <div class="d-none d-md-block d-lg-inline-block">Welcome, <?php echo $_SESSION['officer_username'];?></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav> 
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Applications</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Applications</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>


    <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <h3>Application of Officers</h3>
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Officer Number</th>
                                        <th>Name</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Include the database connection file
                                    include 'db.php';

                                    // Create a connection
                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    // Check the connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // SQL query to retrieve officer details
                                    $sql = "SELECT * FROM leave_applications_officers";
                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result set
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["officer_number"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["from_date"] . "</td>";
                                            echo "<td>" . $row["to_date"] . "</td>";
                                            echo "<td>" . $row["from_time"] . "</td>";
                                            echo "<td>" . $row["to_time"] . "</td>";
                                            echo "<td>
                                                <div class='action-buttons' style='display: flex; gap: 10px;'>
                                                    <a href='view_application.php?id=" . $row['id'] . "' class='btn btn-info'> View </a>
                                                    <a href='update_application.php?id=" . $row['id'] . "' class='btn btn-primary'> Update </a>
                                                    <form id='deleteForm_" . $row['id'] . "' method='post' action='delete_application.php'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <input type='hidden' name='reason_for_delete' id='deleteReason_" . $row['id'] . "'>
                                                        <button type='button' onclick='confirmDelete(" . $row['id'] . ")' class='delete-button btn btn-danger'>Delete</button>
                                                    </form>
                                                </div>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No records found</td></tr>"; // Adjust the colspan according to the number of columns
                                    }

                                    // Close the connection
                                    $conn->close();
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h3>Application of External Research Officers</h3>
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    // Include the database connection file
                                    include 'db.php';

                                    // Create a connection
                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    // Check the connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // SQL query to retrieve officer details
                                    $sql = "SELECT * FROM leave_applications_ero";
                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result set
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["external_id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["from_date"] . "</td>";
                                            echo "<td>" . $row["to_date"] . "</td>";
                                            echo "<td>" . $row["from_time"] . "</td>";
                                            echo "<td>" . $row["to_time"] . "</td>";
                                            echo "<td>
                                                <div class='action-buttons' style='display: flex; gap: 10px;'>
                                                <a href='view_application_ero.php?id=" .$row['id'] ." 'class='btn btn-info'> View </a>
                                                    <a href='update_appication_ero.php?id=" .$row['id'] ." 'class='btn btn-primary'> Update </a>
                                                    <form id='deleteForm_" . $row['id'] . "' method='post' action='delete_application_ero.php'>
                                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                            <input type='hidden' name='reason_for_delete' id='deleteReason_" . $row['id'] . "'>
                                                            <button type='button' onclick='confirmDelete(" . $row['id'] . ")' class='delete-button btn btn-danger'>Delete</button>
                                                        </form>
                                                </div>
                                                </td>"; // Assuming there is an 'id' column in your table
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No records found</td></tr>";
                                    }

                                    // Close the connection
                                    $conn->close();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h3>Application of Interns</h3>
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Application ID</th>
                                        <th>Intern ID</th>
                                        <th>Name</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Include the database connection file
                                        include 'db.php';

                                        // Create a connection
                                        $conn = new mysqli($servername, $username, $password, $dbname);

                                        // Check the connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        // SQL query to retrieve officer details
                                        $sql = "SELECT * FROM leave_applications";
                                        $result = $conn->query($sql);

                                        // Check if there are rows in the result set
                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["intern_id"] . "</td>";
                                                echo "<td>" . $row["name"] . "</td>";
                                                echo "<td>" . $row["from_date"] . "</td>";
                                                echo "<td>" . $row["to_date"] . "</td>";
                                                echo "<td>" . $row["from_time"] . "</td>";
                                                echo "<td>" . $row["to_time"] . "</td>";
                                                echo "<td>
                                                    <div class='action-buttons' style='display: flex; gap: 10px;'>
                                                        <a href='view_application_intern.php?id=" . $row['id'] . "' class='btn btn-info'> View </a>
                                                        <a href='update_application_intern.php?id=" . $row['id'] . "' class='btn btn-primary'> Update </a>
                                                        <form id='deleteForm_" . $row['id'] . "' method='post' action='delete_application_intern.php'>
                                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                            <input type='hidden' name='reason_for_delete' id='deleteReason_" . $row['id'] . "'>
                                                            <button type='button' onclick='confirmDelete(" . $row['id'] . ")' class='delete-button btn btn-danger'>Delete</button>
                                                        </form>
                                                    </div>
                                                    </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No records found</td></tr>";
                                        }

                                        // Close the connection
                                        $conn->close();
                                    ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>

                </section>
                

    <form id="deleteForm_<?php echo $id; ?>" method="POST" action="delete_leave_intern.php">
    <!-- Hidden field for officer ID -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <!-- Reason input field -->
    <input type="hidden" id="deleteReason_<?php echo $id; ?>" name="deleteReason" value="">
</form>

            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>

    <!-- <script>
        function toggleEditDelete(id) {
            var button = document.querySelector("button[data-action='delete'][onclick*='" + id + "']");
            
            // Using a custom confirmation dialog
            var userConfirmed = window.confirm("Are you sure you want to delete this officer?");

            if (userConfirmed) {
                // Submit the form to delete the officer
                var form = button.closest('form');
                form.submit();
            } else {
                // Do nothing or add additional handling as needed
                alert("Deletion canceled.");
            }
        }
    </script> -->

<script>
    function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        input: 'textarea',
        inputLabel: 'Reason for deletion',
        inputPlaceholder: 'Enter the reason for deletion',
        inputAttributes: {
            'aria-label': 'Enter the reason for deletion'
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        preConfirm: (reason) => {
            if (!reason) {
                Swal.showValidationMessage('You need to enter a reason for deletion');
                return false;
            } else {
                // Set the reason in the hidden input field
                document.getElementById('deleteReason_' + id).value = reason;
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Get the form by the id and submit it
            var form = document.getElementById('deleteForm_' + id);
            form.submit(); // Submit the form after confirmation
        }
    });
}
</script>

</body>

</html>
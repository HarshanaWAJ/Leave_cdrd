<?php
include 'db.php';

session_start();
if ($_SESSION['admin_username'] == "") {
  header("Location: login.php");
exit;
}
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

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
             <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                <a href="admin.php">
                  <i class="text-primary me-4"></i>
                  <img src="./assets/images/logo.jpg" />
                  <span>CDRD</span>
                </a>
                </div>
                <div class="sidebar-menu-container">
                <div class="sidebar-menu" id="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item ">
                            <a href="admin.php" class='sidebar-link'>
                                <i class="fa fa-home text-primary"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="add_officers.php" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Add Officers</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="manage_officers.php" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Manage Officers</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="add_ero.php" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Add External Research Officers</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="manage_ero.php" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Manage External Research Officers</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="add_intern.php" class='sidebar-link'>
                                <i class="fa fa-university text-primary"></i>
                                <span>Add Interns</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a href="manage_interns.php" class='sidebar-link'>
                                <i class="fa fa-university text-primary"></i>
                                <span>Manage Interns</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="all_leave.php" class='sidebar-link'>
                                <i class="fa fa-table text-primary"></i>
                                <span>All Leaves</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="log_viewer.php" target="_blank" class='sidebar-link'>
                                <i class="fa fa-book text-primary"></i>
                                <span>Log Report</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="download_leave_details.php" target="_blank" class='sidebar-link'>
                                <i class="fa fa-download text-primary"></i>
                                <span>Download Leave Details</span>
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
                                    <div class="d-none d-md-block d-lg-inline-block">Welcome, Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Manage Interns</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-primary">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Interns</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Intern ID</th>
                                        <th>Name</th>
                                        <th>University</th>
                                        <th>Wing</th>
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

                                    // SQL query to retrieve intern details
                                    $sql = "SELECT * FROM intern";
                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result set
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["intern_id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["university"] . "</td>";
                                            echo "<td>" . $row["wing"] . "</td>";
                                            echo "<td>
                                                    <div class='action-buttons' style='display: flex; gap: 10px;'>
                                                        <a href='update_intern_info.php?id=" .$row['intern_id'] ." 'class='btn btn-primary'> Update </a>
                                                        <form id='deleteForm_" . $row["intern_id"] . "' method='post' action='delete_intern.php'>
                                                            <input type='hidden' name='intern_id' value='" . $row["intern_id"] . "'>
                                                            <button type='button' onclick='confirmDelete(" . $row["intern_id"] . ")' class='delete-button btn btn-danger'>Delete</button>
                                                        </form>
                                                    </div>
                                                </td>"; // Assuming there is an 'intern_id' column in your table
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No records found</td></tr>";
                                    }

                                    // Close the connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>

    <script>
        function toggleEditDelete(internId) {
            var button = document.querySelector("button[data-action='delete'][onclick*='" + internId + "']");
            
            // Using a custom confirmation dialog
            var userConfirmed = window.confirm("Are you sure you want to delete this intern?");

            if (userConfirmed) {
                // Submit the form to delete the intern
                var form = button.closest('form');
                form.submit();
            } else {
                // Do nothing or add additional handling as needed
                alert("Deletion canceled.");
            }
        }
    </script>

    <script>
        //function confirmDelete(internId) {
            //var userConfirmed = confirm("Are you sure you want to delete this intern?");
            
            //if (userConfirmed) {
                // If the user clicks "Yes," proceed with deletion
                //var form = document.getElementById('deleteForm_' + internId);
                //form.submit();
            //} else {
                // If the user clicks "No," do nothing or add additional handling as needed
            //}
        //}
    </script>
    <script>
    function confirmDelete(officerId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user clicks "Yes, delete it!", proceed with deletion
                var form = document.getElementById('deleteForm_' + officerId);
                form.submit();
            } else {
                // If user clicks "Cancel", do nothing or add additional handling as needed
            }
        });
    }
</script>

</body>

</html>
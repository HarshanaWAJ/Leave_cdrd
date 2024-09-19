<?php
    session_start();
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
    </style>
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
                <div class="sidebar-menu" id="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item ">
                            <a href="admin.php" class='sidebar-link'>
                                <i class="fa fa-home text-primary"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-users text-primary"></i>
                                <span>Employees</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_officers.php">Add Officers</a>
                                </li>
                                <li>
                                    <a href="manage_officers.php">Manage Officers</a>
                                </li>
                                <li>
                                    <a href="add_intern.php">Add Intern</a>
                                </li>
                                <li>
                                    <a href="manage_interns.php">Manage Interns</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-primary"></i>
                                <span>Leave Management</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="all_leave.php">All Leaves</a>
                                </li>
                            </ul>
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
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
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
                            <h3>Pending</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin.php" class="text-primary">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pending</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h4>Interns Leaves Declined</h4>
                                    <table class='table' id="table1">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Intern_Id</th>
                                                <th>Leave Type</th>
                                                <th>Posting Date</th>
                                                <th>To date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="leaveTableBody">
                                            <?php
                                            // Include the database connection file
                                            include 'db.php';
                                            
                                            // Fetch and display pending leaves for interns
                                            $sqlFetchPendingInterns = "SELECT * FROM leave_applications 
                                                                        WHERE NOT (status1 = 'approve' OR status1 = 'decline') 
                                                                        OR NOT (status2 = 'approve' OR status2 = 'decline') 
                                                                        OR NOT (status3 = 'approve' OR status3 = 'decline')";
                                            $resultFetchPendingInterns = $conn->query($sqlFetchPendingInterns);

                                            // Display canceled leaves for interns
                                            while ($row = $resultFetchPendingInterns->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $row['name'] . '</td>';
                                                echo '<td>' . $row['intern_id'] . '</td>';
                                                echo '<td>' . $row['leave_type'] . '</td>';
                                                echo '<td>' . $row['from_date'] . '</td>';
                                                echo '<td>' . $row['to_date'] . '</td>';
                                                echo '</tr>';
                                            }

                                            // Close the database connection
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div style='overflow-x: auto;'>
                                <table class='table' id="table1">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Officer number</th>
                                            <th>Leave Type</th>
                                            <th>Posting Date</th>
                                            <th>To date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="leaveTableBody2">
                                        <?php
                                        // Include the database connection file
                                        include 'db.php';

                                        // Fetch and display pending leaves for officers
                                        $sqlFetchPendingOfficers = "SELECT * FROM leave_applications_officers 
                                                                    WHERE NOT (status1 = 'approve' OR status1 = 'decline') 
                                                                    OR NOT (status2 = 'approve' OR status2 = 'decline') 
                                                                    OR NOT (status3 = 'approve' OR status3 = 'decline')";
                                        $resultFetchPendingOfficers = $conn->query($sqlFetchPendingOfficers);

                                        // Display canceled leaves for officers
                                        if ($resultFetchPendingOfficers->num_rows > 0) {
                                            while ($row = $resultFetchPendingOfficers->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $row['name'] . '</td>';
                                                echo '<td>' . $row['officer_number'] . '</td>';
                                                echo '<td>' . $row['leave_type'] . '</td>';
                                                echo '<td>' . $row['from_date'] . '</td>';
                                                echo '<td>' . $row['to_date'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            // Output a message if there are no leaves for officers
                                            echo "<tr><td colspan='5'>No Pending leaves found</td></tr>";
                                        }

                                        // Close the database connection
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
</body>

</html>
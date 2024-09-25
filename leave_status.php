<?php
    session_start();

        // Include database connection code here
        include_once 'db.php';

        if ($_SESSION['intern_username'] == "") {
            header("Location: login.php");
          exit;
          }

        // Function to determine overall status based on responses
        function determineOverallStatus1($response1, $response2) {
            if ($response2 == 'approve' ) {
                return 'approve';
            } elseif ($response1 == 'decline' || $response2 == 'decline') {
                return 'decline';
            } else {
                return 'pending';
            }
        }

        function determineOverallStatus2($response1, $response2, $response3) {
            if ($response3 == 'approve') {
                return 'approve';
            } elseif ($response1 == 'decline' || $response2 == 'decline' || $response3 == 'decline') {
                return 'decline';
            } else {
                return 'pending';
            }
        }

        function determineOverallStatus($response1, $response2, $response3) {
            if ($response1 == 'approve' && $response2 == 'approve' && $response3 == 'approve') {
                return 'approve';
            } elseif ($response1 == 'decline' || $response2 == 'decline' || $response3 == 'decline') {
                return 'decline';
            } else {
                return 'pending';
            }
        }
    
        // Getting the logged-in intern's ID from the session
        $intern_id = $_SESSION['intern_id'];
    
        // Fetch leave status from the database
        $query = "SELECT * FROM leave_applications WHERE intern_id = '$intern_id'";
        $result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Centre for Defense Research and Development</title>
    <link rel="icon" href="./assets/images/logo.jpg" type="image/x-icon" />

    <link rel="stylesheet" href="assets/css/bootstrap.css" />

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/css/app.css" />
    <style>
        #table1 {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse; /* Ensure borders are not doubled */
    }

    #table1 th, #table1 td {
        border: 1px solid #000; /* Cell borders */
        padding: 10px; /* Padding inside cells */
        text-align: left;
    }

    #table1 th {
        background-color: #4CAF50; /* Header background color */
        color: white; /* Header text color */
    }

    #table1 tr:nth-child(even) {
        background-color: #f2f2f2; /* Alternate row background color */
    }

    #table1 tr:hover {
        background-color: #ddd; /* Row hover effect */
    }

    #table1 th, #table1 td {
        border: 1px solid #ddd; /* Light grey cell borders */
    }

    #table1 th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
    }

    #table1 td {
        text-align: center;
    }

    #table1 th:nth-child(1) {
        width: 110px; /* Leave Type */
    }

    #table1 th:nth-child(2) {
        width: 110px; /* From date */
    }

    #table1 th:nth-child(3) {
        width: 110px; /* To date */
    }

    #table1 th:nth-child(4) {
        width: 100px; /* Reason for Leave */
    }

    #table1 th:nth-child(5) {
        width: 100px; /* Remarks */
        background-color: red;
    }

    #table1 th:nth-child(6) {
        width: 110px; 
    }

    #table1 th:nth-child(7) {
        width: 110px;
    }

    #table1 th:nth-child(8) {
        width: 110px; 
    }

    #table1 th:nth-child(9) {
        width: 110px;
    }

    .fixed-width-button {
    width: 110px; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    }

    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <!-- Sidebar content -->
            <div class="sidebar-wrapper active">
                <!-- Sidebar header -->
                <div class="sidebar-header" style="height: 50px; margin-top: -30px">
                    <a href="intern.php" class="sidebar-link">
                        <i class="text-primary me-4"></i>
                        <img src="./assets/images/logo.jpg" />
                        <span>CDRD</span>
                    </a>
                </div>
                <!-- Sidebar menu -->
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item">
                            <a href="intern.php" class="sidebar-link">
                                <i class="fa fa-home text-primary"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="intern_apply_leave.php" class="sidebar-link">
                                <i class="fa fa-plane text-primary"></i>
                                <span>Apply Leave</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a href="leave_status.php" class="sidebar-link">
                                <i class="fa fa-plane text-primary"></i>
                                <span>Leave Status</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="update_intern.php" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="update_password.php" class='sidebar-link'>
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
                <!-- Sidebar toggler -->
                <button class="sidebar-toggler btn x">
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <!-- Navbar content -->
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="" />
                                </div>
                                    <span>Welcome, <?php echo $_SESSION['intern_username'];?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Leave Status</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="intern.php" class="text-primary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Leave Status
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class='table table-striped' id="table1">
                                    <thead>
                                        <tr>
                                            <th class="col">Leave Type</th>
                                            <th class="col">From</th>
                                            <th class="col">To</th>
                                            <th class="col-6">Reason</th>
                                            <th class="col-6">Remarks</th>
                                            <th class="col">Research Officer</th>
                                            <th class="col">Wing Head</th>
                                            <th class="col">SO1</th>
                                            <th class="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['leave_type'] . "</td>";
                                                echo "<td>" . $row['from_date'] . "</td>";
                                                echo "<td>" . $row['to_date'] . "</td>";
                                                echo "<td>" . $row['reason'] . "</td>";
                                                echo "<td>" . $row['remarks'] . "</td>";
                                                
                                                // Display status as text instead of letters
                                                echo "<td>";
                                                switch ($row['status1']) {
                                                    case 'approve':
                                                        echo "<button class='btn btn-success fixed-width-button'>Recommended</button>";
                                                        break;
                                                    case 'decline':
                                                        echo "<button class='btn btn-danger fixed-width-button'>Not Recommended</button>";
                                                        break;
                                                    case 'pending':
                                                        echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                        break;
                                                    default:
                                                    echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                }
                                                echo "</td>";

                                                echo "<td>";
                                                $overallStatus1 = determineOverallStatus1 ($row['status1'], $row['status2']);
                                                switch ($overallStatus1) {
                                                    case 'approve':
                                                        echo "<button class='btn btn-success fixed-width-button'>Recommended</button>";
                                                        break;
                                                    case 'decline':
                                                        echo "<button class='btn btn-danger fixed-width-button'>Not Recommended</button>";
                                                        break;
                                                    case 'pending':
                                                        echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                        break;
                                                    default:
                                                    echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                }
                                                echo "</td>";

                                                echo "<td>";
                                                $overallStatus2 = determineOverallStatus($row['status1'], $row['status2'], $row['status3']);
                                                switch ($overallStatus2) {
                                                    case 'approve':
                                                        echo "<button class='btn btn-success fixed-width-button'>Approved</button>";
                                                        break;
                                                    case 'decline':
                                                        echo "<button class='btn btn-danger fixed-width-button'>Not Approved</button>";
                                                        break;
                                                    case 'pending':
                                                        echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                        break;
                                                    default:
                                                    echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                }
                                                echo "</td>";

                                                echo "<td>";
                                                $overallStatus = determineOverallStatus($row['status1'], $row['status2'], $row['status3']);
                                                switch ($overallStatus) {
                                                    case 'approve':
                                                        echo "<button class='btn btn-success fixed-width-button'>Approved</button>";
                                                        break;
                                                    case 'decline':
                                                        echo "<button class='btn btn-danger fixed-width-button'>Not Approved</button>";
                                                        break;
                                                    case 'pending':
                                                        echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                        break;
                                                    default:
                                                    echo "<button class='btn btn-warning fixed-width-button'>Pending</button>";
                                                }
                                                echo "</td>";
                                        
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>No leave status found</td></tr>";
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


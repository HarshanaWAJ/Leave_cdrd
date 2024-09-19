<?php
    session_start();

        // Include database connection code here
        include_once 'db.php';

        if ($_SESSION['officer_username'] == "") {
        header("Location: login.php");
        exit;
        }

        // Function to determine overall status based on responses
        function determine( $status, $status3) {
            if ( $status3 == 'approve') {
                return 'approve';
            } elseif ($status3 == 'decline' || $status == 'decline') {
                return 'decline';
            } 
            else {
                return 'pending'; // Default case if status is unknown
            }
        }
        function overroll($status, $status3) {
            if ($status == 'approve' && $status3 == 'approve') {
                return 'approve';
            } elseif ($status3 == 'decline' || $status == 'decline') {
                return 'decline';
            } else {
                return 'pending';
            }
        }
    
        // Getting the logged-in officer's ID from the session
        $officer_id = $_SESSION['officer_number'];
    
        // Fetch leave status from the database
        $query = "SELECT * FROM leave_applications_officers WHERE officer_number = '$officer_id'";
        $result = $conn->query($query);

        // Officer name from session
$officer_name = $_SESSION['officer_name'];

// SQL query to count pending leave applications assigned to the logged-in officer
$sql = "SELECT COUNT(*) as count 
        FROM leave_applications_officers 
        WHERE (status IN ('pending', 'Unknown') OR status IS NULL OR status = '')
        AND assigned_officer_name = ?";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $officer_name);
$stmt->execute();
$stmt->bind_result($pendingCount);
$stmt->fetch();

$stmt->close();

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
        text-align: left; /* Align text to the left */
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
        width: 100px; /* Leave Type */
    }

    #table1 th:nth-child(2) {
        width: 100px; /* From date */
    }

    #table1 th:nth-child(3) {
        width: 100px; /* To date */
    }

    #table1 th:nth-child(4) {
        width: 140px; /* Reason for Leave */
    }

    #table1 th:nth-child(5) {
        width: 140px; /* Remarks */
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

    .fixed-width-button {
    width: 130px; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    }

    .custom-badge {
        background-color: yellow;
        color: red;
        border-radius: 50%;
        padding: 5px 10px;
        display: inline-block;
        text-align: center;
        margin-left: 40px;
        font-weight: bold;
    }
    .flex-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .icon-spacing {
        margin-right: 13px; /* Add gap between icon and text */
    }
    </style>
</head>

<body>
<div id="app">
         <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
               <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                  <a href="cc.php" class="sidebar-link">
                    <i class="text-primary me-4"></i>
                    <img src="./assets/images/logo.jpg" />
                    <span>CDRD</span>
                    </a>
                </div>
                <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-item  ">
              <a href="cc.php" class='sidebar-link'>
                <i class="fa fa-home text-primary"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item ">
                        <a href="cc_apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-upload text-primary"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                     <li class="sidebar-item active">
                        <a href="cc_leave_status.php" class='sidebar-link'>
                        <i class="fa fa-clock text-primary"></i>
                        <span>Leave Status</span>
                        </a>
                     </li>

                     <li class="sidebar-item">
                      <a href="approve_leave_cc.php" class="sidebar-link">
                      <i class="fa fa-check-circle text-primary icon-spacing"></i>
                      <div class="flex-container">
                      <span>Approve Leaves</span>
                      <?php if ($pendingCount > 0): ?>
                <span class="custom-badge"><?php echo $pendingCount; ?></span>
            <?php endif; ?>
                      </div>
                      </a>
                     </li>

            <li class="sidebar-item ">
              <a href="cc_all_leaves.php" class='sidebar-link'>
                <i class="fa fa-plane text-primary"></i>
                <span>All Officer Leaves</span>
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
            <li class="sidebar-item">
              <a href="logout.php" class="sidebar-link">
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
                                    <span>Welcome, <?php echo $_SESSION['officer_username'];?></span>
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
                                            <th class="col-6">Acting Officer</th>
                                            <th class="col">DG</th>
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
                                                switch ($row['status']) {
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
                                                $dg = determine( $row['status'], $row['status3']);
                                                switch ($dg) {
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
                                                $overroll = overroll( $row['status'], $row['status3']);
                                                switch ($overroll) {
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
                                            echo "<tr><td colspan='8'>No leave status found</td></tr>";
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
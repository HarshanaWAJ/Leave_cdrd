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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
      <style type="text/css">
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
                        <li class="sidebar-item active">
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
                        <li class="sidebar-item ">
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
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    
                                    <h4 style="font-family: Fantasy;">Welcome, Admin</h4>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Admin Dashboard</h3>
                </div>
                <section class="section">
                    <div class="row mb-2">
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <i class="fa fa-users text-warning fa-3x me-4"></i>
                                            </div>
                                            <div>
                                                <?php
                                                include 'db.php';

                                                // For interns
                                                $sqlIntern = "SELECT COUNT(*) AS total_interns FROM intern";
                                                $resultIntern = $conn->query($sqlIntern);

                                                // For officers
                                                $sqlOfficers = "SELECT COUNT(*) AS total_officers FROM officers";
                                                $resultOfficers = $conn->query($sqlOfficers);

                                                // For ero
                                                $sqlero = "SELECT COUNT(*) AS total_ero FROM external_research_officer";
                                                $resultero = $conn->query($sqlero);

                                                // Initialize variables
                                                $totalInterns = 0;
                                                $totalOfficers = 0;
                                                $totalero = 0;

                                                // Check results for interns
                                                if ($resultIntern->num_rows > 0) {
                                                    $rowIntern = $resultIntern->fetch_assoc();
                                                    $totalInterns = $rowIntern['total_interns'];
                                                }

                                                // Check results for officers
                                                if ($resultOfficers->num_rows > 0) {
                                                    $rowOfficers = $resultOfficers->fetch_assoc();
                                                    $totalOfficers = $rowOfficers['total_officers'];
                                                }

                                                if ($resultero->num_rows > 0) {
                                                    $rowero = $resultero->fetch_assoc();
                                                    $totalero = $rowero['total_ero'];
                                                }

                                                // Calculate the total count
                                                $totalEmployees = $totalInterns + $totalOfficers + $totalero;

                                                // Close the database connection
                                                $conn->close();
                                                ?>
                                                <h4>Employees</h4>
                                                <h2 class="h1 mb-0"><?php echo $totalEmployees; ?></h2>

                                                <div>
                                                    <h6 class="mb-0">Total Interns : <?php echo $totalInterns ?></h6>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Total Officers : <?php echo $totalOfficers ?></h6>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Total ERO : <?php echo $totalero ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <i class="fa fa-upload text-success fa-3x me-4"></i>
                                            </div>
                                            <div>
                                                <?php
                                                // Include the database connection file
                                                include 'db.php';

                                                // SQL query to count the total leaves for interns
                                                $sqlInterns = "SELECT COUNT(*) AS total_leaves_interns FROM leave_applications";
                                                $resultInterns = $conn->query($sqlInterns);

                                                // SQL query to count the total leaves for officers
                                                $sqlOfficers = "SELECT COUNT(*) AS total_leaves_officers FROM leave_applications_officers";
                                                $resultOfficers = $conn->query($sqlOfficers);

                                                // SQL query to count the total leaves for ero
                                                $sqlero = "SELECT COUNT(*) AS total_leaves_ero FROM leave_applications_ero";
                                                $resultero = $conn->query($sqlero);

                                                // Initialize variables
                                                $totalInterns = 0;
                                                $totalOfficers = 0;
                                                $totalero = 0;

                                                // Check results for interns
                                                if ($resultInterns->num_rows > 0) {
                                                    $rowInterns = $resultInterns->fetch_assoc();
                                                    $totalInterns = $rowInterns['total_leaves_interns'];
                                                }

                                                // Check results for officers
                                                if ($resultOfficers->num_rows > 0) {
                                                    $rowOfficers = $resultOfficers->fetch_assoc();
                                                    $totalOfficers = $rowOfficers['total_leaves_officers'];
                                                }

                                                if ($resultero->num_rows > 0) {
                                                    $rowero = $resultero->fetch_assoc();
                                                    $totalero = $rowero['total_leaves_ero'];
                                                }

                                                // Total Leaves
                                                $totalLeaves = $totalInterns + $totalOfficers + $totalero;

                                                // Close the database connection
                                                $conn->close();
                                                ?>
                                                <h4>Total Leaves</h4>
                                                <h2 class="h1 mb-0"><?php echo $totalLeaves; ?></h2>
                                                <!-- Move these lines below the total leaves -->
                                                <div>
                                                    <h6 class="mb-0">Total Intern leaves: <?php echo $totalInterns; ?>
                                                    </h6>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Total Officer leaves: <?php echo $totalOfficers; ?>
                                                    </h6>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Total ERO leaves: <?php echo $totalero; ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <i class="fa fa-refresh text-warning fa-3x me-4"></i>
                                            </div>
                                            <div>
                                                <?php
                                                // Include the database connection file
                                                include 'db.php';

                                                // SQL query to count the total pending leaves for interns
                                                $sqlPendingInterns = "SELECT COUNT(*) AS total_pending_interns FROM leave_applications 
                                                                        WHERE NOT (
                                                                                (status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve') 
                                                                                OR (status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline')
                                                                            )";

                                                $resultPendingInterns = $conn->query($sqlPendingInterns);

                                                // SQL query to count the total pending leaves for officers
                                                $sqlPendingOfficers = "SELECT SUM(total_pending_officers) AS total_pending_officers FROM (
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Research Officer' AND NOT (
                                                        (status = 'approve' AND status1 = 'approve' AND status2 = 'approve')
                                                        OR (status = 'decline' OR status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline')
                                                    )
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Quater Master' AND NOT (
                                                        (status = 'approve' AND status2 = 'approve' AND status3 = 'approve')
                                                        OR (status = 'decline' OR status2 = 'decline' OR status3 = 'decline')
                                                    )
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Account Officer' AND NOT (
                                                        (status2 = 'approve' AND status3 = 'approve')
                                                        OR (status2 = 'decline' OR status3 = 'decline')
                                                    )
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Wing Head' AND  (
                                                    (assigned_officer_name != 'None' AND (
                                                        (status != 'approve' OR status2 != 'approve' OR status3 != 'approve') AND
                                                        (status != 'decline' AND status2 != 'decline' AND status3 != 'decline')
                                                    ))
                                                    OR
                                                    (assigned_officer_name = 'None' AND (
                                                        (status2 != 'approve' OR status3 != 'approve') AND
                                                        (status2 != 'decline' AND status3 != 'decline')
                                                    ))
                                                    )
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Staff Officer 1' AND NOT (
                                                        (status = 'approve' AND status3 = 'approve')
                                                        OR (status = 'decline' OR status3 = 'decline')
                                                    )
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Cheif Controller' AND NOT (
                                                        (status = 'approve' AND status3 = 'approve')
                                                        OR (status = 'decline' OR status3 = 'decline')
                                                    )
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Cheif Coordinator' AND NOT (
                                                        (status = 'approve' AND status3 = 'approve')
                                                        OR (status = 'decline' OR status3 = 'decline')
                                                    )
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_pending_officers FROM leave_applications_officers 
                                                    WHERE position = 'Deputy Director Gene' AND NOT (
                                                        (status = 'approve' AND status3 = 'approve')
                                                        OR (status = 'decline' OR status3 = 'decline')
                                                    )
                                                ) AS total_pending_officers";

                                                $resultPendingOfficers = $conn->query($sqlPendingOfficers);

                                                $sqlPendingero = "SELECT COUNT(*) AS total_pending_ero FROM leave_applications_ero 
                                                                        WHERE NOT (
                                                                                (status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve') 
                                                                                OR (status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline')
                                                                            )";

                                                $resultPendingero = $conn->query($sqlPendingero);

                                                // Initialize variables
                                                $totalPendingInterns = 0;
                                                $totalPendingOfficers = 0;
                                                $totalPendingero = 0;

                                                // Check results for pending leaves for interns
                                                if ($resultPendingInterns->num_rows > 0) {
                                                    $rowPendingInterns = $resultPendingInterns->fetch_assoc();
                                                    $totalPendingInterns = $rowPendingInterns['total_pending_interns'];
                                                }

                                                // Check results for pending leaves for officers
                                                if ($resultPendingOfficers->num_rows > 0) {
                                                    $rowPendingOfficers = $resultPendingOfficers->fetch_assoc();
                                                    $totalPendingOfficers = $rowPendingOfficers['total_pending_officers'];
                                                }

                                                if ($resultPendingero->num_rows > 0) {
                                                    $rowPendingero = $resultPendingero->fetch_assoc();
                                                    $totalPendingero = $rowPendingero['total_pending_ero'];
                                                }

                                                // Total Pending Leaves
                                                $totalPendingLeaves = $totalPendingInterns + $totalPendingOfficers + $totalPendingero;

                                                // Display total pending leaves only if at least one status is not 'approve' or 'decline'
                                                echo '<h4>Pending</h4>';
                                                echo '<h2 class="h1 mb-0">' . $totalPendingLeaves . '</h2>';

                                                // Display total Pending leaves for interns and officers
                                                echo '<div><h6 class="mb-0">Total Intern leaves pending: ' . $totalPendingInterns . '</h6></div>';
                                                echo '<div><h6 class="mb-0">Total Officer leaves pending: ' . $totalPendingOfficers . '</h6></div>';
                                                echo '<div><h6 class="mb-0">Total ERO leaves pending: ' . $totalPendingero . '</h6></div>';

                                                // Close the database connection
                                                $conn->close();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <i class="fa fa-check text-info fa-3x me-4"></i>
                                            </div>
                                            <div>
                                                <?php
                                                // Include the database connection file
                                                include 'db.php';

                                                // SQL query to count the total approved leaves for interns
                                                $sqlApprovedInterns = "SELECT COUNT(*) AS total_approved_interns FROM leave_applications 
                                                                    WHERE status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve'";
                                                $resultApprovedInterns = $conn->query($sqlApprovedInterns);

                                                // SQL query to count the total approved leaves for officers
                                               $sqlApprovedOfficers = "SELECT SUM(total_approved_officers) AS total_approved_officers FROM (
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Research Officer' AND 
                                                        status = 'approve' AND status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve'
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Quater Master' AND 
                                                        status = 'approve' AND status2 = 'approve' AND status3 = 'approve'
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Account Officer' AND 
                                                        status2 = 'approve' AND status3 = 'approve'
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Wing Head' AND 
                                                        ((assigned_officer_name != 'None' AND status = 'approve' AND status2 = 'approve' AND status3 = 'approve')
                                                        OR
                                                        (assigned_officer_name = 'None' AND status2 = 'approve' AND status3 = 'approve'))
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Staff Officer 1' AND 
                                                        status = 'approve' AND status3 = 'approve'
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Cheif Controller' AND 
                                                        status = 'approve' AND status3 = 'approve'
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Cheif Coordinator' AND 
                                                        status = 'approve' AND status3 = 'approve'
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total_approved_officers FROM leave_applications_officers 
                                                    WHERE position = 'Deputy Director Gene' AND 
                                                        status = 'approve' AND status3 = 'approve'
                                                ) AS total_approved_officers";

                                                $resultApprovedOfficers = $conn->query($sqlApprovedOfficers);

                                                $sqlApprovedero = "SELECT COUNT(*) AS total_approved_ero FROM leave_applications_ero 
                                                                    WHERE status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve'";
                                                $resultApprovedero = $conn->query($sqlApprovedero);

                                                // Initialize variables
                                                $totalApprovedInterns = 0;
                                                $totalApprovedOfficers = 0;
                                                $totalApprovedero = 0;

                                                // Check results for approved leaves for interns
                                                if ($resultApprovedInterns->num_rows > 0) {
                                                    $rowApprovedInterns = $resultApprovedInterns->fetch_assoc();
                                                    $totalApprovedInterns = $rowApprovedInterns['total_approved_interns'];
                                                }

                                                // Check results for approved leaves for officers
                                                if ($resultApprovedOfficers->num_rows > 0) {
                                                    $rowApprovedOfficers = $resultApprovedOfficers->fetch_assoc();
                                                    $totalApprovedOfficers = $rowApprovedOfficers['total_approved_officers'];
                                                }

                                                if ($resultApprovedero->num_rows > 0) {
                                                    $rowApprovedero = $resultApprovedero->fetch_assoc();
                                                    $totalApprovedero = $rowApprovedero['total_approved_ero'];
                                                }

                                                // Total Approved Leaves
                                                $totalApprovedLeaves = $totalApprovedInterns + $totalApprovedOfficers + $totalApprovedero;

                                                // Display total approved leaves
                                                echo '<h4>Approved</h4>';
                                                echo '<h2 class="h1 mb-0">' . $totalApprovedLeaves . '</h2>';

                                                // Display total approved leaves for interns and officers
                                                echo '<div><h6 class="mb-0">Total Intern leaves approve: ' . $totalApprovedInterns . '</h6></div>';
                                                echo '<div><h6 class="mb-0">Total Officer leaves approve: ' . $totalApprovedOfficers . '</h6></div>';
                                                echo '<div><h6 class="mb-0">Total ERO leaves approve: ' . $totalApprovedero . '</h6></div>';

                                                // Close the database connection
                                                $conn->close();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                    <div class="align-self-center">
                        <i class="fa fa-trash text-danger fa-3x me-4"></i>
                    </div>
                    <div>
    <?php
    // Include the database connection file
    include 'db.php';

    // SQL query to count the total canceled leaves for interns
    $sqlCanceledInterns = "SELECT COUNT(*) AS total_canceled_interns FROM leave_applications 
                           WHERE status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline'";
    $resultCanceledInterns = $conn->query($sqlCanceledInterns);

    // SQL query to count the total canceled leaves for officers
    $sqlCanceledOfficers = "SELECT SUM(total_declined_officers) AS total_declined_officers FROM (
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Research Officer' AND 
              (status = 'decline' OR status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline')
        UNION ALL
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Quater Master' AND 
              (status = 'decline' OR status2 = 'decline' OR status3 = 'decline')
        UNION ALL
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Account Officer' AND 
              (status2 = 'decline' OR status3 = 'decline')
        UNION ALL
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Wing Head' AND 
              ((assigned_officer_name != 'None' AND (status = 'decline' OR status2 = 'decline' OR status3 = 'decline'))
        OR
        (assigned_officer_name = 'None' AND (status2 = 'decline' OR status3 = 'decline')))
        UNION ALL
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Staff Officer 1' AND 
              (status = 'decline' OR status3 = 'decline')
        UNION ALL
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Cheif Controller' AND 
              (status = 'decline' OR status3 = 'decline')
        UNION ALL
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Cheif Coordinator' AND 
              (status = 'decline' OR status3 = 'decline')
        UNION ALL
        SELECT COUNT(*) AS total_declined_officers FROM leave_applications_officers 
        WHERE position = 'Deputy Director Gene' AND 
              (status = 'decline' OR status3 = 'decline')
    ) AS total_declined_officers";
    
    $resultCanceledOfficers = $conn->query($sqlCanceledOfficers);

    $sqlCanceledero = "SELECT COUNT(*) AS total_canceled_ero FROM leave_applications_ero 
                           WHERE status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline'";
    $resultCanceledero = $conn->query($sqlCanceledero);

    // Initialize variables
    $totalCanceledInterns = 0;
    $totalCanceledOfficers = 0;
    $totalCanceledero = 0;

    // Check results for canceled leaves for interns
    if ($resultCanceledInterns->num_rows > 0) {
        $rowCanceledInterns = $resultCanceledInterns->fetch_assoc();
        $totalCanceledInterns = $rowCanceledInterns['total_canceled_interns'];
    }

    // Check results for canceled leaves for officers
    if ($resultCanceledOfficers->num_rows > 0) {
        $rowCanceledOfficers = $resultCanceledOfficers->fetch_assoc();
        if (isset($rowCanceledOfficers['total_declined_officers'])) {
            $totalCanceledOfficers = $rowCanceledOfficers['total_declined_officers'];
        }
    }

    // Check results for canceled leaves for ERO
    if ($resultCanceledero->num_rows > 0) {
        $rowCanceledero = $resultCanceledero->fetch_assoc();
        if (isset($rowCanceledero['total_canceled_ero'])) {
            $totalCanceledero = $rowCanceledero['total_canceled_ero'];
        }
    }

    // Total Canceled Leaves
    $totalCanceledLeaves = $totalCanceledInterns + $totalCanceledOfficers + $totalCanceledero;

    // Display total canceled leaves
    echo '<h4>Declined</h4>';
    echo '<h2 class="h1 mb-0">' . $totalCanceledLeaves . '</h2>';

    // Display total canceled leaves for interns and officers
    echo '<div><h6 class="mb-0">Total Intern leaves declined: ' . $totalCanceledInterns . '</h6></div>';
    echo '<div><h6 class="mb-0">Total Officer leaves declined: ' . $totalCanceledOfficers . '</h6></div>';
    echo '<div><h6 class="mb-0">Total ERO leaves declined: ' . $totalCanceledero . '</h6></div>';

    // Close the database connection
    $conn->close();
    ?>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class=" col-md-3"></div>

          <div class=" col-md-6">
            <div class="card">
              <div class="card-body animate__animated animate__bounceIn">
                <h5 class="birthday">Today's Birthdays of Officers</h5>
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-gift text-info fa-3x me-4 animate__animated animate__bounceIn" ></i>
                    </div>
                    <div>
                    <?php
            include 'db.php';
            $today = date('Y-m-d');
            // Query to get officers whose birthday is today
              $birthdaySql = "
              SELECT 
                  wing, 
                  name,
                  position
              FROM 
                  officers 
              WHERE 
                  DATE_FORMAT(birth, '%m-%d') = DATE_FORMAT('$today', '%m-%d')";

              $birthdayResult = $conn->query($birthdaySql);
              $birthdayData = [];
              if ($birthdayResult->num_rows > 0) {
              while ($row = $birthdayResult->fetch_assoc()) {
                  $birthdayData[] = [
                      'wing' => $row['wing'],
                      'name' => $row['name'],
                      'position' => $row['position']
                  ];
              }
              }
             
              if (empty($birthdayData)) {
                echo 'No birthdays today';
              } else {
                foreach ($birthdayData as $birthday) {
                  if ($birthday['wing'] === 'None') {
                      echo "{$birthday['name']} - {$birthday['position']}<br>";
                  } else {
                      echo "{$birthday['name']}- {$birthday['position']} in {$birthday['wing']} wing<br>";
                  }
              }
              }
                                     
              $conn->close();
              ?>           
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class=" col-md-3"></div>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Get the current page path
        var currentPath = window.location.pathname;

        // Get all the links in the sidebar
        var sidebarLinks = document.querySelectorAll('#sidebar-menu a');

        // Loop through each link and check if its href matches the current page path
        sidebarLinks.forEach(function (link) {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active'); // Add 'active' class if it's the current page
            }
        });
    </script>
</body>

</html>
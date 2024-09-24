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

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .btn-black-text {
    color: #000 !important; /* Set the text color to black */
}

#table1 {
    width: 100%;
    border-collapse: collapse; /* Ensure borders are not doubled */
}

#table1 th, #table1 td {
    border: 1px solid #000; /* Cell borders */
    padding: 8px; /* Padding inside cells */
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
    width: 100px; /* Adjusted width for Intern ID */
}

#table1 th:nth-child(2) {
    width: 120px; /* Full Name */
}

#table1 th:nth-child(3) {
    width: 110px; /* Leave Type */
}

#table1 th:nth-child(4) {
    width: 110px; /* From date */
}

#table1 th:nth-child(5) {
    width: 110px; /* To date */
}

#table1 th:nth-child(6) {
    width: 100px; /* From time */
}

#table1 th:nth-child(7) {
    width: 90px; /* To time */
}

#table1 th:nth-child(8) {
    width: 90px; 
}

#table1 th:nth-child(9) {
    width: 100px; /* Reason for Leave */
}

#table1 th:nth-child(10) {
    width: 100px; /* Remarks */
    background-color: red;
}

#table1 th:nth-child(11) {
    width: 140px; /* Action */
}

#table2 {
    width: 100%;
    border-collapse: collapse; /* Ensure borders are not doubled */
}

#table2 th, #table2 td {
    border: 1px solid #000; /* Cell borders */
    padding: 8px; /* Padding inside cells */
    text-align: left; /* Align text to the left */
}

#table2 th {
    background-color: #4CAF50; /* Header background color */
    color: white; /* Header text color */
}

#table2 tr:nth-child(even) {
    background-color: #f2f2f2; /* Alternate row background color */
}

#table2 tr:hover {
    background-color: #ddd; /* Row hover effect */
}

#table2 th, #table2 td {
    border: 1px solid #ddd; /* Light grey cell borders */
}

#table2 th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #4CAF50;
    color: white;
}

#table2 td {
    text-align: center;
}

#table2 th:nth-child(1) {
    width: 100px;
}

#table2 th:nth-child(2) {
    width: 120px;
}

#table2 th:nth-child(3) {
    width: 110px;
}

#table2 th:nth-child(4) {
    width: 110px;
}

#table2 th:nth-child(5) {
    width: 110px;
}

#table2 th:nth-child(6) {
    width: 100px;
}

#table2 th:nth-child(7) {
    width: 90px;
}

#table2 th:nth-child(8) {
    width: 100px;
}

#table2 th:nth-child(9) {
    width: 100px;
}

#table2 th:nth-child(10) {
    width: 130px;
    background-color: red;
}

#table2 th:nth-child(11) {
    width: 140px; /* Action */
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

input#remark {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
            margin-right: 10px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
            margin-bottom: 10px
        }

        input#remark:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

</style>

</head>


<body>
<div id="app">
         <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
               <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                  <a href="so1.php" class="sidebar-link">
                    <i class="text-primary me-4"></i>
                    <img src="./assets/images/logo.jpg" />
                    <span>CDRD</span>
                    </a>
                </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li class="sidebar-item  ">
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
                     <li class="sidebar-item active">
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
                    <li class="sidebar-item">
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
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
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
                            <h3>Approve Leaves</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-primary">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Approve Leaves</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                        <h3>Officer Leave Recommendation</h3>
                        <?php
                            // Include the database connection file
                            include 'db.php';

                            // Function to get the status label and corresponding color
                            function getStatusInfo2($statusCode) {
                                switch ($statusCode) { 
                                    case 'approve':
                                        return array('Approve', 'bg-success'); // Green
                                    case 'decline':
                                        return array('Decline', 'bg-danger'); // Red
                                    case 'pending':
                                        return array('Pending', 'bg-warning'); // Orange
                                    default:
                                        return array('Unknown', 'bg-secondary'); // Default color
                                }
                            }

                            // SQL query to fetch all columns from the 'leave_applications_officers' table
                            $sql = "SELECT * 
                            FROM leave_applications_officers 
                            WHERE (status2 IN ('pending', 'Unknown') OR status2 IS NULL OR status2 = '')
                            AND ((status1 = 'approve' OR (position IN ('Wing Head', 'Quater Master') AND status = 'approve')) OR position = 'Account Officer' OR assigned_officer_name = 'None')";
                    


                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result === false) {
                                echo "Error: " . $conn->error;
                            } else {
                                // Display the fetched data in the table
                                echo "<div style='overflow-x: auto;'>";
                                echo "<table class='table' id='table2'>";
                                echo "<thead>
                                        <tr>
                                            <th>Officer ID</th>
                                            <th>Name</th>
                                            <th>Leave Type</th>
                                            <th>From date</th>
                                            <th>To date</th>
                                            <th>From time</th>
                                            <th>To time</th>
                                            <th>Number of days</th>
                                            <th>Reason</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                // Loop through the fetched data and display it in the table
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['officer_number'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['leave_type'] . "</td>";
                                    echo "<td>" . $row['from_date'] . "</td>";
                                    echo "<td>" . $row['to_date'] . "</td>";
                                    echo "<td>" . $row['from_time'] . "</td>";
                                    echo "<td>" . $row['to_time'] . "</td>";
                                    echo "<td>" . $row['number_of_days'] . "</td>";
                                    echo "<td>" . $row['reason'] . "</td>";
                                    echo "<td>" . $row['remarks'] . "</td>";

                                    // Get status label and color
                                    list($statusLabel, $statusColor) = getStatusInfo2($row['status2']);
                                    

                                    // Check if status1 and status2 are 'approve'
                                    
                                    $isApproved = $row['status1'] == 'approve' || $row['position'] == 'Wing Head';
                                    $disabled = $isApproved ? '' : 'disabled';
                                    // Display the selected action in the "Status" column as a button
                                    echo "<td>
                                            <form action='update_status_so1.php' method='post'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <input type = 'text' name = 'remark' id = 'remark' placeholder = 'Remark'>
                                                <div class='d-flex'>
                                                    <button type='submit' class='btn btn-success me-2 custom-btn' name='status' value='approve' >
                                                            <i class='fas fa-check small-icon'></i> Accept
                                                        </button>
                                                        <button type='submit' class='btn btn-danger me-2 custom-btn' name='status' value='decline' >
                                                            <i class='fas fa-times small-icon'></i> Decline
                                                        </button>
                                                        <button type='submit' class='btn btn-danger me-2 custom-btn' name='status' value='delete'>
                                                            <i class='fas fa-trash small-icon'></i> Delete
                                                        </button>
                                                </div>
                                            </form>
                                        </td>";

                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            }                           

                            // Close the database connection (from db.php)
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </section>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <h3>Leave Recommendation as Acting Officer</h3>
                        <?php
                            // Include the database connection file
                            include 'db.php';

                            // Function to get the status label and corresponding color
                            function getStatus($statusCode) {
                                switch ($statusCode) { 
                                    case 'approve':
                                        return array('Approve', 'bg-success'); // Green
                                    case 'decline':
                                        return array('Decline', 'bg-danger'); // Red
                                    case 'pending':
                                        return array('Pending', 'bg-warning'); // Orange
                                    default:
                                        return array('Unknown', 'bg-secondary'); // Default color
                                }
                            }

                            // SQL query to fetch all columns from the 'leave_applications' table
                            // SQL query to fetch columns from the 'leave_applications_officers' table with statuses 'pending', 'decline', 'Unknown', and also where status is blank or NULL
                            $sql = "SELECT * FROM leave_applications_officers WHERE  (status IN ('pending', 'Unknown') OR status IS NULL OR status = '')";


                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result === false) {
                                echo "Error: " . $conn->error;
                            } else {
                                // Display the fetched data in the table
                                echo "<div style = 'overflow-x: auto;'>";
                                echo "<table id='table1'>";
                                echo "<thead>
                                        <tr>
                                            <th>Officer ID</th>
                                            <th>Name</th>
                                            <th>Leave Type</th>
                                            <th>From date</th>
                                            <th>To date</th>
                                            <th>From time</th>
                                            <th>To time</th>
                                            <th>Number of days</th>
                                            <th>Reason</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                // Loop through the fetched data and display it in the table
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['assigned_officer_name'] == $_SESSION['officer_name']) {
                                    echo "<tr>";
                                    echo "<td>" . $row['officer_number'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['leave_type'] . "</td>";
                                    echo "<td>" . $row['from_date'] . "</td>";
                                    echo "<td>" . $row['to_date'] . "</td>";
                                    echo "<td>" . $row['from_time'] . "</td>";
                                    echo "<td>" . $row['to_time'] . "</td>";
                                    echo "<td>" . $row['number_of_days'] . "</td>";
                                    echo "<td>" . $row['reason'] . "</td>";
                                    echo "<td>" . $row['remarks'] . "</td>";


                                    
                                    // Get status label and color
                                    list($statusLabel, $statusColor) = getStatus($row['status']);
                                    

                                    // Display the selected action in the "Status" column as a button
                                    echo "<td>
                                            <form action='update_status_so1_acting.php' method='post'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <input type = 'text' name = 'remark' id = 'remark' placeholder = 'Remark'>
                                                <div class='d-flex'>
                                                    <button type='submit' class='btn btn-success me-2 custom-btn' name='status' value='approve'>
                                                            <i class='fas fa-check small-icon'></i> Approve
                                                        </button>
                                                        <button type='submit' class='btn btn-danger me-2 custom-btn' name='status' value='decline'>
                                                            <i class='fas fa-times small-icon'></i> Decline
                                                        </button>
                                                        <button type='submit' class='btn btn-danger me-2 custom-btn' name='status2' value='delete'>
                                                            <i class='fas fa-trash small-icon'></i> Delete
                                                        </button>
                                                </div>
                                            </form>
                                        </td>";

                                    echo "</tr>";
                                    }
                                }
                                echo "</tbody></table>";
                            }                           

                            // Close the database connection (from db.php)
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </section>

                <section class="section">
                <div class="card">
                    <div class="card-body">
                        <h3>External Research Officer Leave Recommendation</h3>
                        <?php
                        // Include the database connection file
                        include 'db.php';

                        function getStatusInfo1($statusCode) {
                            switch ($statusCode) {
                                case 'approve':
                                    return array('Approve', 'bg-success'); // Green
                                case 'decline':
                                    return array('Decline', 'bg-danger'); // Red
                                case 'pending':
                                    return array('Pending', 'bg-warning'); // Orange
                                default:
                                    return array('Unknown', 'bg-secondary'); // Default color
                            }
                        }
                        
                        // SQL query to fetch all columns from the 'leave_applications' table
                        $sql = "SELECT * FROM leave_applications_ero WHERE  status1='approve' AND (status2 IN ('pending', 'Unknown') OR status2 IS NULL OR status2 = '')";


                        // Execute the query
                        $result = $conn->query($sql);

                        // Check if the query was successful
                        if ($result === false) {
                            echo "Error: " . $conn->error;
                        } else {
                            // Display the fetched data in the table
                            echo "<div style = 'overflow-x: auto;'>";
                            echo "<table  id='table1'>";
                            echo "<thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>From date</th>
                                        <th>To date</th>
                                        <th>From time</th>
                                        <th>To time</th>
                                        <th>Number of days</th>
                                        <th>Reason</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";

                            // Loop through the fetched data and display it in the table
                            while ($row = $result->fetch_assoc()) {
                               
                                    echo "<tr>";
                                    echo "<td>" . $row['external_id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['leave_type'] . "</td>";
                                    echo "<td>" . $row['from_date'] . "</td>";
                                    echo "<td>" . $row['to_date'] . "</td>";
                                    echo "<td>" . $row['from_time'] . "</td>";
                                    echo "<td>" . $row['to_time'] . "</td>";
                                    echo "<td>" . $row['number_of_days'] . "</td>";
                                    echo "<td>" . $row['reason'] . "</td>";
                                    echo "<td>" . $row['remarks'] . "</td>";

                                    list($statusLabel, $statusColor) = getStatusInfo1($row['status1']);

                                    

                                    // Check if the status is 'approve' to enable/disable the button
                                    $disabled = ($row['status1'] === 'approve') ? '' : 'disabled';

                                    // Display the selected action in the "Status" column as a button
                                    echo "<td>
                                        <form action='update_status2_ero.php' method='post'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <input type='text' name='remark' id='remark' placeholder='Remark'>
                                            <div class='d-flex'>
                                                <button type='submit' class='btn btn-success me-2 custom-btn' name='status2' value='approve'>
                                                    <i class='fas fa-check small-icon'></i> Approve
                                                </button>
                                                <button type='submit' class='btn btn-danger me-2 custom-btn' name='status2' value='decline'>
                                                    <i class='fas fa-times small-icon'></i> Decline
                                                </button>
                                                <button type='submit' class='btn btn-danger me-2 custom-btn' name='status2' value='delete'>
                                                    <i class='fas fa-trash small-icon'></i> Delete
                                                </button>
                                            </div>
                                        </form>
                                    </td>";
                                    echo "</tr>";
                                
                            }
                            echo "</tbody></table>";
                        }                           

                        // Close the database connection (from db.php)
                        $conn->close();
                        ?>
                    </div>
                </div>
            </section>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <h3>Intern Leave Approval</h3>
                        <?php
                            // Include the database connection file
                            include 'db.php';

                            // Function to get the status label and corresponding color
                            function getStatusInfo($statusCode) {
                                switch ($statusCode) {
                                    case 'approve':
                                        return array('Approve', 'bg-success'); // Green
                                    case 'decline':
                                        return array('Decline', 'bg-danger'); // Red
                                    case 'pending':
                                        return array('Pending', 'bg-warning'); // Orange
                                    default:
                                        return array('Unknown', 'bg-secondary'); // Default color
                                }
                            }

                            // SQL query to fetch all columns from the 'leave_applications' table
                            $sql = "SELECT * FROM leave_applications WHERE (status2 = 'approve') AND (status3 IN ('pending', 'Unknown') OR status3 IS NULL OR status3 = '')";

                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result === false) {
                                echo "Error: " . $conn->error;
                            } else {
                                // Display the fetched data in the table
                                echo "<div style='overflow-x: auto;'>";
                                echo "<table id='table1'>";
                                echo "<thead>
                                        <tr>
                                            <th>Intern ID</th>
                                            <th>Name</th>
                                            <th>Leave Type</th>
                                            <th>From date</th>
                                            <th>To date</th>
                                            <th>From time</th>
                                            <th>To time</th>
                                            <th>Number of days</th>
                                            <th>Reason</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                // Loop through the fetched data and display it in the table
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['intern_id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['leave_type'] . "</td>";
                                    echo "<td>" . $row['from_date'] . "</td>";
                                    echo "<td>" . $row['to_date'] . "</td>";
                                    echo "<td>" . $row['from_time'] . "</td>";
                                    echo "<td>" . $row['to_time'] . "</td>";
                                    echo "<td>" . $row['number_of_days'] . "</td>";
                                    echo "<td>" . $row['reason'] . "</td>";
                                    echo "<td>" . $row['remarks'] . "</td>";

                                    // Get status label and color
                                    list($statusLabel, $statusColor) = getStatusInfo($row['status3']);
                                    

                                    // Check if status1 and status2 are 'approve'
                                    $isApproved = $row['status1'] == 'approve' && $row['status2'] == 'approve';
                                    $disabled = $isApproved ? '' : 'disabled';

                                    // Display the selected action in the "Status" column as a button
                                    echo "<td>
                                            <form action='update_status3.php' method='post'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <input type = 'text' name = 'remark' id = 'remark' placeholder = 'Remark or Reason'>
                                                <div class='d-flex'>
                                                    <button type='submit' class='btn btn-success me-2 custom-btn' name='status' value='approve' >
                                                            <i class='fas fa-check small-icon'></i> Accept
                                                        </button>
                                                        <button type='submit' class='btn btn-danger me-2 custom-btn' name='status' value='decline'>
                                                            <i class='fas fa-times small-icon'></i> Decline
                                                        </button>
                                                        <button type='submit' class='btn btn-danger me-2 custom-btn' name='status' value='delete'>
                                                            <i class='fas fa-trash small-icon'></i> Delete
                                                        </button>
                                                </div>
                                            </form>
                                        </td>";

                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            }                           

                            // Close the database connection (from db.php)
                            $conn->close();
                            ?>

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

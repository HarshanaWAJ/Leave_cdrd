<?php
include 'db.php';

session_start();
if ($_SESSION['officer_username'] == "") {
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
                     <li class="sidebar-item ">
                        <a href="clerk.php" class='sidebar-link'>
                        <i class="fa fa-home text-primary"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item active">
                        <a href="clerk_view_application.php"  class='sidebar-link'>
                        <i class="fa fa-download text-primary"></i>
                        <span>View Applications</span>
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
                <h3>View Applications</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Applications</li>
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
                                                <a href='view_application.php?id=" .$row['id'] ." 'class='btn btn-info'> View </a>
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
                                            echo "<td>" . $row["intern_id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["from_date"] . "</td>";
                                            echo "<td>" . $row["to_date"] . "</td>";
                                            echo "<td>" . $row["from_time"] . "</td>";
                                            echo "<td>" . $row["to_time"] . "</td>";
                                            echo "<td>
                                                <div class='action-buttons' style='display: flex; gap: 10px;'>
                                                <a href='view_application_intern.php?id=" .$row['id'] ." 'class='btn btn-info'> View </a>
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
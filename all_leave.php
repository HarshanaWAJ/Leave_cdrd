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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
                        <li class="sidebar-item ">
                            <a href="manage_interns.php" class='sidebar-link'>
                                <i class="fa fa-university text-primary"></i>
                                <span>Manage Interns</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
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
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>All Leaves</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-primary">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Leaves</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="main-content container-fluid">
                <!-- Add date pickers for selecting date range -->
                <div class="row mb-3">
                <div class="col-6">
                        <label for="fromDate">From Date:</label>
                        <input type="date" id="fromDate" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-6">
                        <label for="toDate">To Date:</label>
                        <input type="date" id="toDate" class="form-control" autocomplete="off">
                    </div>
                </div>
                <!-- Add a Search button and Clear button -->
                <div class="row mb-3">
                    <div class="col-12">
                        <button class="btn btn-primary" id="searchBtn">Search</button>
                        <button class="btn btn-secondary" id="clearBtn">Clear</button>
                    </div>
                </div>
                    <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <h3>All Leaves of Officers</h3>
                        <div style = 'overflow-x: auto;'>;
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Officer Number</th>
                                        <th>Full Name</th>
                                        <th>Leave Type</th>
                                        <th>Number of Days</th>
                                        <th>From Date</th>
                                        <th>To date</th>
                                    </tr>
                                </thead>
                                <tbody id="leaveTableBody2">
                                <?php
                                    // Include the database connection file
                                    include 'db.php';

                                    // SQL query to retrieve all leaves from leave_applications table
                                    $sql = "SELECT * FROM leave_applications_officers";
                                    $result = $conn->query($sql);

                                    // Check if there are any rows in the result set
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Output each row as a table row
                                            echo "<tr>";
                                            echo "<td>" . $row['officer_number'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['leave_type'] . "</td>";
                                            echo "<td>" . $row['number_of_days'] . "</td>";
                                            echo "<td>" . $row['from_date'] . "</td>";
                                            echo "<td>" . $row['to_date'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if there are no leaves in the table
                                        echo "<tr><td colspan='12'>No leaves found</td></tr>";
                                    }

                                    // Close the database connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                        <h3>All Leaves of Interns</h3>
                            <table class='table' id="table1">
                            <div class="row mb-3">
                            <div class="row mb-3">
                                <thead>
                                    <tr>
                                        <th>Intern Id</th>
                                        <th>Full Name</th>
                                        <th>Leave Type</th>
                                        <th>Number of Days</th>
                                        <th>From Date</th>
                                        <th>To date</th>
                                    </tr>
                                </thead>
                                <tbody id="leaveTableBody">
                                <?php
                                    // Include the database connection file
                                    include 'db.php';

                                    // SQL query to retrieve all leaves from leave_applications table
                                    $sql = "SELECT * FROM leave_applications";
                                    $result = $conn->query($sql);

                                    // Check if there are any rows in the result set
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Output each row as a table row
                                            echo "<tr>";
                                            echo "<td>" . $row['intern_id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['leave_type'] . "</td>";
                                            echo "<td>" . $row['number_of_days'] . "</td>";
                                            echo "<td>" . $row['from_date'] . "</td>";
                                            echo "<td>" . $row['to_date'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if there are no leaves in the table
                                        echo "<tr><td colspan='12'>No leaves found</td></tr>";
                                    }

                                    // Close the database connection
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


<!-- script tag for handling date pickers, search button, clear button, and all leaves button -->
<script>
    // Function to fetch and update leave data based on the selected date range
    function updateLeaveData(fromDate, toDate) {
        // Make an AJAX request to fetch leave data based on the selected date range for interns
        var xhr1 = new XMLHttpRequest();
        xhr1.open('POST', 'get_leaves.php', true);
        xhr1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr1.onreadystatechange = function () {
            if (xhr1.readyState === 4 && xhr1.status === 200) {
                // Update the leave table for interns with the retrieved data
                document.getElementById('leaveTableBody').innerHTML = xhr1.responseText;
            }
        };
        xhr1.send('fromDate=' + fromDate + '&toDate=' + toDate);

        // Make another AJAX request to fetch leave data based on the selected date range for officers
        var xhr2 = new XMLHttpRequest();
        xhr2.open('POST', 'get_leaves_officers.php', true);
        xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr2.onreadystatechange = function () {
            if (xhr2.readyState === 4 && xhr2.status === 200) {
                // Update the leave table for officers with the retrieved data
                document.getElementById('leaveTableBody2').innerHTML = xhr2.responseText;
            }
        };
        xhr2.send('fromDate=' + fromDate + '&toDate=' + toDate);
    }

    // Initialize date pickers and fetch initial leave data
    document.addEventListener("DOMContentLoaded", function () {
        var fromDateInput = document.getElementById('fromDate');
        var toDateInput = document.getElementById('toDate');
        var searchBtn = document.getElementById('searchBtn');
        var clearBtn = document.getElementById('clearBtn');

        // Set default values to the current date
        var currentDate = new Date().toISOString().split('T')[0];
        fromDateInput.value = currentDate;
        toDateInput.value = currentDate;

        // Fetch initial leave data for the current date
        updateLeaveData(currentDate, currentDate);

        fromDateInput.addEventListener('change', updateSearchButtonState);
        toDateInput.addEventListener('change', updateSearchButtonState);

        // Add click event for the Search button
        searchBtn.addEventListener('click', function () {
            // Get selected date range from date pickers
            var fromDate = fromDateInput.value;
            var toDate = toDateInput.value;

            // Fetch and update leave data based on the selected date range
            updateLeaveData(fromDate, toDate);
        });

        // Add click event for the Clear button
        clearBtn.addEventListener('click', function () {
            // Set date inputs to the current date
            fromDateInput.value = currentDate;
            toDateInput.value = currentDate;

            // Fetch and update leave data for the current date
            updateLeaveData(currentDate, currentDate);
        });

        function updateSearchButtonState() {
            searchBtn.disabled = fromDateInput.value === '' || toDateInput.value === '';
        }
    });
</script>

</body>

</html>
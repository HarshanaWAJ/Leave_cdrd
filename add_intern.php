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
                        <li class="sidebar-item active">
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
                <h3>Add Interns</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Interns</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Intern ID</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Intern ID" id="first-name-icon" name="intern_id" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-id-card"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Name</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Name" id="first-name-icon" name="name" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Name in full</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Name in Full" id="first-name-icon" name="name_in_full" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Permanent Address</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Permanent Address" id="first-name-icon" name="permanent_address" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">University</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="University" id="first-name-icon" name="university" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-university"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Trade (Role)</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Trade" id="first-name-icon" name="trade" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Wing</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" onchange="updatePlaceholder()" name="wing" required>
                                                    <option value="" disabled selected>Select Wing</option>
                                                        <option>IT/GIS</option>
                                                        <option>CYBER</option>
                                                        <option>ELECTRICAL AND MECHANICAL</option>
                                                        <option>SATELLITE AND SURVEILLANCE</option>
                                                        <option>RADIO AND ELECTRONICS</option>
                                                        <option>NANO AND MODERN TECHNOLOGY</option>
                                                    </select>
                                                </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Email</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Email" id="first-name-icon" name="email" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Username</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="username" id="first-name-icon" name="username" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user-tag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Password</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control" placeholder="password" id="first-name-icon" name="password" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    </div>

                                    <?php
                                    include_once 'db.php';

                                    // Handle form submission
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        // Check if the required fields are set in $_POST
                                        if (
                                            isset($_POST["intern_id"]) &&
                                            isset($_POST["name"]) &&
                                            isset($_POST["name_in_full"]) &&
                                            isset($_POST["permanent_address"]) &&
                                            isset($_POST["university"]) &&
                                            isset($_POST["trade"]) &&
                                            isset($_POST["wing"]) &&
                                            isset($_POST["username"]) &&
                                            isset($_POST["password"])
                                        ) {
                                            // Retrieve form data (sanitize and validate inputs as needed)
                                            $internId = $conn->real_escape_string($_POST["intern_id"]);
                                            $name = $conn->real_escape_string($_POST["name"]);
                                            $nameInFull = $conn->real_escape_string($_POST["name_in_full"]);
                                            $permanentAddress = $conn->real_escape_string($_POST["permanent_address"]);
                                            $university = $conn->real_escape_string($_POST["university"]);
                                            $trade = $conn->real_escape_string($_POST["trade"]);
                                            $wing = $conn->real_escape_string($_POST["wing"]);
                                            $email = $conn->real_escape_string($_POST["email"]);
                                            $username = $conn->real_escape_string($_POST["username"]);
                                            $password = $conn->real_escape_string($_POST["password"]);

                                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                                            // Perform database insertion using prepared statements for security
                                            $sql = "INSERT INTO intern (intern_id, name, name_in_full, permanent_address, university, trade, wing, email, username, password)
                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                                            // Prepare the statement
                                            $stmt = $conn->prepare($sql);

                                            // Bind parameters
                                            $stmt->bind_param("ssssssssss", $internId, $name, $nameInFull, $permanentAddress, $university, $trade, $wing, $email, $username, $hashedPassword);


                                            // Execute the statement
                                            if ($stmt->execute()) {
                                                echo "<script>
                                                            Swal.fire({
                                                                icon: 'success',
                                                            title: 'Added',
                                                             text: 'Intern added successfully!',
                                                        });
                                                 </script>";
                                            } else {
                                                echo "Error: " . $stmt->error;
                                            }

                                            // Close the statement
                                            $stmt->close();
                                        }
                                    }

                                    // Close the database connection
                                    $conn->close();
                                    ?>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
    <script>
        function updatePlaceholder() {
        var dropdown = document.getElementById("basicSelect");
        var selectedOption = dropdown.options[dropdown.selectedIndex].value;

        // Update the placeholder text
        if (selectedOption === "") {
            dropdown.classList.remove("selected");
        } else {
            dropdown.classList.add("selected");
        }
    }
    </script>
    
</body>
</html>

<?php
include 'db.php';

session_start();
if ($_SESSION['ero_username'] == "") {
  header("Location: login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Centre for Defense Research and Development</title>
    <link rel="icon" href="./assets/images/logo.jpg" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />

    <!-- Font Awesome -->
    <script defer src="assets/fontawesome/js/all.min.js"></script>

    <!-- Perfect Scrollbar CSS -->
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/app.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <!-- Sidebar content -->
            <div class="sidebar-wrapper active">
                <div class="sidebar-header" style="height: 50px; margin-top: -30px">
                    <!-- Sidebar header content -->
                    <a href="external_research_officer.php" class="sidebar-link">
                    <i class="text-primary me-4"></i>
                    <img src="./assets/images/logo.jpg" />
                    <span>CDRD</span>
                    </a>
                </div>
                <div class="sidebar-menu">
                    <!-- Sidebar menu -->
                    <ul class="menu">
                     <li class="sidebar-item ">
                        <a href="external_research_officer.php" class='sidebar-link'>
                        <i class="fa fa-home text-primary"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item active">
                        <a href="external_research_officer_apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-primary"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="external_research_officer_leave_status.php" class='sidebar-link'>
                        <i class="fa fa-plane text-primary"></i>
                        <span>Leave Status</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                            <a href="update_ero_info.php" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="update_password_ero.php"  class='sidebar-link'>
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
                <button class="sidebar-toggler btn x">
                    <!-- Sidebar toggler button -->
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>
        <div id="main">
            <!-- Main content -->
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <!-- Navbar content -->
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <!-- Dropdown menu -->
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="" />
                                    <span>Welcome, <?php echo $_SESSION['ero_username'];?></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <!-- Page title -->
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Apply for Leave</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <!-- Breadcrumb navigation -->
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="intern.php" class="text-primary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Leave Application
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section id="multiple-column-form">
                    <!-- Form section -->
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <?php
include_once 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (
        isset($_POST["name"]) &&
        isset($_POST["leaveType"]) &&
        isset($_POST["fromDate"]) &&
        isset($_POST["toDate"]) &&
        isset($_POST["fromTime"]) &&
        isset($_POST["toTime"]) &&
        isset($_POST["externalId"]) && // Changed from external_id to externalId to match the form name
        isset($_POST["reason"]) &&
        isset($_POST["wing"]) &&
        isset($_POST["numberOfDays"]) && // Ensure numberOfDays is also checked
        is_numeric($_POST["numberOfDays"]) // Ensure numberOfDays is numeric
    ) {
        // Retrieve form data (sanitize and validate inputs as needed)
        $name = $conn->real_escape_string($_POST["name"]);
        $leaveType = $conn->real_escape_string($_POST["leaveType"]);
        $fromDate = $conn->real_escape_string($_POST["fromDate"]);
        $toDate = $conn->real_escape_string($_POST["toDate"]);
        $fromTime = $conn->real_escape_string($_POST["fromTime"]);
        $toTime = $conn->real_escape_string($_POST["toTime"]);
        $externalId = $conn->real_escape_string($_POST["externalId"]); // Changed from external_id to externalId
        $reason = $conn->real_escape_string($_POST["reason"]);
        $wing = $conn->real_escape_string($_POST["wing"]);
        $numberOfDays = $conn->real_escape_string($_POST["numberOfDays"]);

        $month = date('m', strtotime($fromDate));

        // Check the total number of leave days for the intern in the specified month
        $totalLeaveDaysQuery = "SELECT SUM(number_of_days) AS total_leave_days 
                                FROM leave_applications_ero
                                WHERE external_id = ? 
                                AND MONTH(from_date) = ?";

        $stmt = $conn->prepare($totalLeaveDaysQuery);
        $stmt->bind_param("si", $externalId, $month); // "si" indicates one string parameter and one integer parameter
        $stmt->execute();
        $totalLeaveDaysResult = $stmt->get_result();

        if ($totalLeaveDaysResult) {
            $userData = $totalLeaveDaysResult->fetch_assoc();
            $totalLeaveDays = $userData['total_leave_days'];

            // Check if the new leave application will exceed the limit
            if (($totalLeaveDays + $numberOfDays) > 3) {
                echo "<div class='error-message' style='color: red;text-align: center;'>";
                echo "You cannot apply for leave, as it will exceed the maximum limit of 3 days in total.<br>";
                echo "If you have a special reason, click below button to apply<br><br>";
                echo "<button class='btn btn-danger' onclick='window.location.href=\"ero_special_leave_application.php\"'>Apply for Special Leave</button>";
                echo "</div>";
            } else {
                // Perform database insertion using prepared statements for security
                $sql = "INSERT INTO leave_applications_ero (name, leave_type, from_date, to_date, from_time, to_time, number_of_days, external_id, reason, wing)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                // Prepare the statement
                $stmt = $conn->prepare($sql);

                // Bind parameters
                $stmt->bind_param("ssssssssss", $name, $leaveType, $fromDate, $toDate, $fromTime, $toTime, $numberOfDays, $externalId, $reason, $wing);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Applied',
                                text: 'Leave applied successfully!',
                            });
                          </script>";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            }
        } else {
            echo "Error retrieving total leave days.";
        }
    } else {
        echo "All form fields are required.";
    }
}

// Close the database connection
$conn->close();
?>
                                        <!-- Leave application form -->
                                        <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="leave-form">
                                            <div class="row">
                                                <!-- Intern ID -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="employee-id">External Research Officer ID</label>
                                                      <div class="position-relative">
                                                          <input type="text" class="form-control" placeholder="External Research Officer ID" id="employee-id" name="externalId" value= "<?php echo $_SESSION['external_id'];?>" readonly/>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-id-card"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                <!-- Name of the Applicant -->
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Name of the Applicant</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Name"
                                                                id="first-name-icon" name="name" value= "<?php echo $_SESSION['name'];?>" readonly/>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                            <div class="col-md-6 col-12">
                                                       
                                                       <label for="country-floating">Wing</label>
                                                       <input type="text" class="form-control" id="basicSelect" name="wing" value="<?php echo $_SESSION['ero_wing']; ?>"  readonly>
                                                         
                                                   
                                               </div>

                                             <!-- Number of Days -->
                                             <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="number-of-days">Number of Days</label>
                                                      <div class="position-relative">
                                                      <input type="text" class="form-control" placeholder="Number of Days" id="number-of-days" name="numberOfDays" required/>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-calendar"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <!-- From Date -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="from-date-icon">From Date</label>
                                                      <div class="position-relative">
                                                          <input type="date" class="form-control" placeholder="from date" id="from-date-icon" name="fromDate" required/>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-calendar"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>

                                                <!-- To Date -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="to-date-icon">To Date</label>
                                                      <div class="position-relative">
                                                          <input type="date" class="form-control" placeholder="to date" id="to-date-icon" name="toDate" required/>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-calendar"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <!-- From Time -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="from-time-icon">From Time</label>
                                                      <div class="position-relative">
                                                      <input type="time" class="form-control" placeholder="from time" id="from-time-icon" name="fromTime" required/>          
                                                      <div class="form-control-icon">
                                                              <i class="fa fa-clock"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>

                                                <!-- To Time -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="to-time-icon">To Time</label>
                                                      <div class="position-relative">
                                                          <input type="time" class="form-control" placeholder="to time" id="to-time-icon" name="toTime" required/>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-clock"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Select Leave Type -->
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="leave-type">Select Leave Type</label>
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="leave-type" name="leaveType" required>
                                                                    <option value="" disabled selected required>Select Leave Type</option>
                                                                    <option value="Casual Leave">Casual Leave</option>
                                                                    <option value="Sick Leave">Sick Leave</option>
                                                                    <option value="Half Day">Half Day</option>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Reason for Leave -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="reason">Reason for Leave</label>
                                                      <div class="position-relative">
                                                      <textarea class="form-control" placeholder="Reason for Leave" id="reason" name="reason" required></textarea>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-pencil"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                           

                                                
                                            <div class="col-12 d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary me-2">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Feather Icons -->
    <script src="assets/js/feather-icons/feather.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- Custom Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        // Get the date inputs, time inputs, and number of days input
        const fromDateInput = document.getElementById("from-date-icon");
        const toDateInput = document.getElementById("to-date-icon");
        const fromTimeInput = document.getElementById("from-time-icon");
        const toTimeInput = document.getElementById("to-time-icon");
        const numberOfDaysInput = document.getElementById("number-of-days");

        // Add event listeners to the date and time inputs
        fromDateInput.addEventListener("change", updateNumberOfDays);
        toDateInput.addEventListener("change", updateNumberOfDays);
        fromTimeInput.addEventListener("change", updateNumberOfDays);
        toTimeInput.addEventListener("change", updateNumberOfDays);

    // Function to calculate and update the number of days
        function updateNumberOfDays() {
            const fromDate = new Date(fromDateInput.value + " " + fromTimeInput.value);
            const toDate = new Date(toDateInput.value + " " + toTimeInput.value);

        // Calculate the difference in milliseconds
            const timeDifference = toDate - fromDate;

        // Calculate the number of days and round to the nearest half day
            const daysDifference = Math.round(timeDifference / (1000 * 60 * 60 * 24) * 2) / 2;

        // Update the number of days input
            numberOfDaysInput.value = daysDifference;
            }
        });
    
          // Calculate the number of days
          var numberOfDays = calculateNumberOfDays(fromDate, toDate);
    
          // Set the calculated value back to the input field
          numberOfDaysInput.value = numberOfDays;

      // Function to calculate the number of days between two dates
      function calculateNumberOfDays(fromDate, toDate) {
          var fromDateTime = new Date(fromDate).getTime();
          var toDateTime = new Date(toDate).getTime();
          var timeDiff = toDateTime - fromDateTime;
          var daysDiff = timeDiff / (1000 * 3600 * 24);
          return Math.round(daysDiff);
      }
    </script>
</body>

</html>

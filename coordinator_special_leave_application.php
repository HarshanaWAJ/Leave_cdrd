<?php
    session_start();

    include_once 'db.php';

    if ($_SESSION['officer_username'] == "") {
        header("Location: login.php");
      exit;
    }
    
    $query = "SELECT name FROM officers WHERE position IN ('Cheif Controller', 'Chief Coordinator')";
    $result = $conn->query($query);
    
    // Check if the query was successful and there are rows returned
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Assign each row to $rows array
            $rows[] = $row;
        }
    } else {
        // Handle the case where no data is found
        $rows = [];
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
    <style type="text/css">
        
        body{
            background: #5a8dee;
        }
                 .notif:hover {
                    background-color: rgba(0, 0, 0, 0.1);
                }
                nav{
                    padding-top: 50px;
                    margin-left: 100px;
                    padding-bottom: 20px;
                    color: #000;
                }
                #multiple-column-form{
                    margin-left: 100px;
                    margin-right: 100px;
                    padding-bottom: 70px;
                }
                .breadcrumb{
                    color: #000;
                }
    </style>
</head>

<body>
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
                                    <span>Welcome, <?php echo $_SESSION['officer_username'];?></span>
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
                            <h3>Apply for Special Leave</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <!-- Breadcrumb navigation -->
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="so1.php" class="text-primary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Special Leave Application
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
                                        <!-- Leave application form -->
                                        <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="leave-form">
                                         
                                        

                                        <div class="row">
                                                <!-- Intern ID -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="employee-id">Officer ID</label>
                                                      <div class="position-relative">
                                                          <input type="text" class="form-control" placeholder="Officer ID" id="employee-id" name="officer_number"  value= "<?php echo $_SESSION['officer_number'];?>" readonly/>
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
                                                                id="first-name-icon" name="name" value= "<?php echo $_SESSION['officer_name'];?>" readonly/>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                                     
                                        <div class="row">
                                                <!-- officer position -->
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Position</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" id="first-name-icon" name="position" value="<?php echo $_SESSION['officer_position']; ?>"  readonly>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user-tag"></i>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                        <label for="leave-type">Leave Type</label>
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

                                        <?php
                                        // Establish database connection
                                        include 'db.php'; 

                                        // Fetch officer details from the database
                                        $query = "SELECT name, officer_number FROM officers WHERE position IN ('Deputy Director General', 'Cheif Controller')";
                                        $result = $conn->query($query);

                                        $officers = array();
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                if (isset($row['name']) && $row['name'] !== $_SESSION['officer_name']) {
                                                    $officer_id = isset($row['officer_number']) ? $row['officer_number'] : ''; // Use an empty string as default if 'officer_number' is not set
                                                    $officers[] = array('name' => $row['name'], 'id' => $officer_id);
                                                }
                                            }
                                        }

                                        
                                        ?>

                                        <div class="row">
                                                    <!-- Select assign officer -->
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="leave-type">Acting Officer Name</label>
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="assigned_officer_name" name="assigned_officer_name" required>
                                                                        <option value="" disabled selected required>Select Officer</option>
                                                                        <?php if(!empty($officers)): ?>
                                                                            <?php foreach($officers as $officer): ?>
                                                                                <option value="<?php echo $officer['name']; ?>"><?php echo $officer['name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Replace officer ID -->
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="employee-id">Acting Officer ID</label>
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" placeholder="Acting Officer ID" id="assigned_officer_id" name="assigned_officer_id" required/>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-id-card"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                         <div class="row">
                                                <!-- Remarks for Leave -->
                                            <div class="col-md-12 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="remarks">Remarks</label>
                                                    <div class="position-relative">
                                                        <textarea class="form-control" placeholder="Remarks" id="remarks" name="remarks" required></textarea>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-pen"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            <?php
                                            include_once 'db.php';

                                            // Handle form submission
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                // Check if the required fields are set in $_POST
                                                if (
                                                    isset($_POST["name"]) &&
                                                    isset($_POST["leaveType"]) &&
                                                    isset($_POST["fromDate"]) &&
                                                    isset($_POST["toDate"]) &&
                                                    isset($_POST["fromTime"]) &&
                                                    isset($_POST["toTime"]) &&
                                                    isset($_POST["numberOfDays"]) &&
                                                    isset($_POST["officer_number"]) &&
                                                    isset($_POST["position"]) &&
                                                    isset($_POST["reason"]) &&
                                                    isset($_POST["remarks"]) &&
                                                    isset($_POST["assigned_officer_id"]) &&
                                                    isset($_POST["assigned_officer_name"])
                                                ) {
                                                    // Retrieve form data (sanitize and validate inputs as needed)
                                                    $name = $conn->real_escape_string($_POST["name"]);
                                                    $leaveType = $conn->real_escape_string($_POST["leaveType"]);
                                                    $fromDate = $conn->real_escape_string($_POST["fromDate"]);
                                                    $toDate = $conn->real_escape_string($_POST["toDate"]);
                                                    $fromTime = $conn->real_escape_string($_POST["fromTime"]);
                                                    $toTime = $conn->real_escape_string($_POST["toTime"]);
                                                    $numberOfDays = $conn->real_escape_string($_POST["numberOfDays"]);
                                                    $officer_number = $conn->real_escape_string($_POST["officer_number"]);
                                                    $position = $conn->real_escape_string($_POST['position']);
                                                    $reason = $conn->real_escape_string($_POST["reason"]);
                                                    $remarks = $conn->real_escape_string($_POST["remarks"]);
                                                    $assigned_officer_id = $conn->real_escape_string($_POST["assigned_officer_id"]);
                                                    $assigned_officer_name = $conn->real_escape_string($_POST["assigned_officer_name"]);
                                                            

                                                            // Insert the data for special leave application
                                                            $sql = "INSERT INTO leave_applications_officers (name, leave_type, from_date, to_date, from_time, to_time, number_of_days, officer_number, position,  reason,remarks, assigned_officer_id, assigned_officer_name)
                                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";

                                                            // Prepare the statement
                                                            $stmt = $conn->prepare($sql);
                                                            
                                                            // Bind parameters
                                                            $stmt->bind_param("sssssssssssss", $name, $leaveType, $fromDate, $toDate, $fromTime, $toTime, $numberOfDays, $officer_number, $position, $reason,$remarks, $assigned_officer_id, $assigned_officer_name);
                                                            
                                                            // Execute the statement
                                                            if ($stmt->execute()) {
                                                                echo "<script>
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    title: 'Applied',
                                                                    text: 'Leave applied successfully!',
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        window.location.href = 'coordinator_apply_leave.php';
                                                                        }
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



                                            <div class="col-12 d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary me-2 mb-3">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
    <script>
    // Create a mapping of officer names to their IDs
    const officerMapping = <?php echo json_encode($officers); ?>;
    
    // Function to handle the change event
    document.getElementById('assigned_officer_name').addEventListener('change', function() {
        const selectedName = this.value;
        const officer = officerMapping.find(officer => officer.name === selectedName);
        document.getElementById('assigned_officer_id').value = officer ? officer.id : '';
    });
</script>
</body>

</html>

<?php
    session_start();

    include_once 'db.php';

    if ($_SESSION['officer_username'] == "") {
        header("Location: login.php");
      exit;
    }
    
    $query = "SELECT name FROM officers WHERE position IN ('Research Officer', 'wing head')";
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                                <div class="col-md-6 col-12">
                                                       
                                                       <label for="country-floating">Wing</label>
                                                       <input type="text" class="form-control" id="basicSelect" name="officerwing" value="<?php echo $_SESSION['officer_wing']; ?>"  readonly>
                                                         
                                                   
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
                                        </div>
                                        <div class="row">

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
  
                                                <?php
                                                // Establish database connection
                                                include 'db.php'; 

                                               // Fetch officer details from the database
                                                $query = "SELECT name, officer_number, wing FROM officers WHERE position IN ('Research Officer', 'wing head')";
                                                $result = $conn->query($query);

                                                $officers = array();
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        if (isset($row['name']) && $row['name'] !== $_SESSION['officer_name']) {
                                                            $officer_id = isset($row['officer_number']) ? $row['officer_number'] : ''; // Use an empty string as default if 'officer_number' is not set
                                                            $officers[$row['wing']][] = array('name' => $row['name'], 'id' => $officer_id);
                                                        }
                                                    }
                                                }

                                                $conn->close();
                                                ?>

                                               
                                                   <!-- Select wing -->
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="wing">Acting Officer Wing</label>
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="wing" name="wing" required>
                                                                        <option value="" disabled selected>Select Wing</option>
                                                                        <?php foreach(array_keys($officers) as $wing): ?>
                                                                            <option value="<?php echo $wing; ?>"><?php echo $wing; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div> 
                                        <div class="row">     

                                                    <!-- Select assign officer -->
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="assigned_officer_name">Acting Officer Name</label>
                                                            <div class="position-relative">
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="assigned_officer_name" name="assigned_officer_name" required>
                                                                        <option value="" disabled selected>Select Officer</option>
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

                                            <?php

                                            include 'db.php'; // Make sure you have the database connection file

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
                                                    isset($_POST["wing"]) &&
                                                    isset($_POST["position"]) &&
                                                    isset($_POST["reason"]) &&
                                                    isset($_POST["assigned_officer_id"]) &&
                                                    isset($_POST["assigned_officer_name"]) &&
                                                    isset($_POST["remarks"])
                                                ) {
                                                    // Retrieve form data (sanitize and validate inputs as needed)
                                                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                                                    $leaveType = filter_input(INPUT_POST, "leaveType", FILTER_SANITIZE_STRING);
                                                    $fromDate = filter_input(INPUT_POST, "fromDate", FILTER_SANITIZE_STRING);
                                                    $toDate = filter_input(INPUT_POST, "toDate", FILTER_SANITIZE_STRING);
                                                    $fromTime = filter_input(INPUT_POST, "fromTime", FILTER_SANITIZE_STRING);
                                                    $toTime = filter_input(INPUT_POST, "toTime", FILTER_SANITIZE_STRING);
                                                    $numberOfDays = filter_input(INPUT_POST, "numberOfDays", FILTER_SANITIZE_NUMBER_INT);
                                                    $officer_number = filter_input(INPUT_POST, "officer_number", FILTER_SANITIZE_STRING);
                                                    //$wing = filter_input(INPUT_POST, "wing", FILTER_SANITIZE_STRING);
                                                    $officerwing = $_POST['officerwing'];
                                                    $position = filter_input(INPUT_POST, "position", FILTER_SANITIZE_STRING);
                                                    $reason = filter_input(INPUT_POST, "reason", FILTER_SANITIZE_STRING);
                                                    $assigned_officer_id = filter_input(INPUT_POST, "assigned_officer_id", FILTER_SANITIZE_STRING);
                                                    $assigned_officer_name = filter_input(INPUT_POST, "assigned_officer_name", FILTER_SANITIZE_STRING);
                                                    $remarks = filter_input(INPUT_POST, "remarks", FILTER_SANITIZE_STRING);

                                                   

                                                            // Perform database insertion using prepared statements for security
                                                            //$sql = "INSERT INTO leave_applications_officers (name, leave_type, from_date, to_date, from_time, to_time, number_of_days, officer_number, wing, position, reason, assigned_officer_id, assigned_officer_name, remarks)
                                                                    //VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$sql = "INSERT INTO leave_applications_officers (name, leave_type, from_date, to_date, from_time, to_time, number_of_days, officer_number, wing, position, reason, assigned_officer_id, assigned_officer_name, remarks)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                                                            // Prepare the statement
                                                            if ($stmt = $conn->prepare($sql)) {
                                                                // Bind parameters
                                                                //$stmt->bind_param("ssssssssssssss", $name, $leaveType, $fromDate, $toDate, $fromTime, $toTime, $numberOfDays,$officerwing, $officer_number, $wing, $position, $reason, $assigned_officer_id, $assigned_officer_name, $remarks);
                                                                $stmt->bind_param("ssssssssssssss", $name, $leaveType, $fromDate, $toDate, $fromTime, $toTime, $numberOfDays, $officer_number, $officerwing, $position, $reason, $assigned_officer_id, $assigned_officer_name, $remarks);
                                                                // Execute the statement
                                                                if ($stmt->execute()) {
                                                                    echo "<script>
                                                                        Swal.fire({
                                                                            icon: 'success',
                                                                            title: 'Applied',
                                                                            text: 'Leave applied successfully!',
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) {
                                                                                window.location.href = 'research_officer_apply_leave.php';
                                                                                }
                                                                            });
                                                                        </script>";
                                                                } else {
                                                                    echo "Error: " . $stmt->error;
                                                                }

                                                                // Close the statement
                                                                $stmt->close();
                                                            } 
                                                    echo "All fields are required.";
                                                }

                                                // Close the database connection
                                                $conn->close();
                                            }
                                            ?>



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
        
            <script>
        $(document).ready(function() {
            // Officers data
            var officers = <?php echo json_encode($officers); ?>;

            // Populate officers based on selected wing
            $('#wing').change(function() {
                var selectedWing = $(this).val();
                var officerDropdown = $('#assigned_officer_name');
                officerDropdown.empty(); // Clear previous options
                officerDropdown.append('<option value="" disabled selected>Select Officer</option>');

                if (selectedWing in officers) {
                    $.each(officers[selectedWing], function(index, officer) {
                        officerDropdown.append('<option value="' + officer.name + '">' + officer.name + '</option>');
                    });
                }
            });

            // Auto-fill officer ID based on selected name
            $('#assigned_officer_name').change(function() {
                var selectedOfficerName = $(this).val();
                var selectedWing = $('#wing').val();
                var officerIdInput = $('#assigned_officer_id');

                if (selectedWing in officers) {
                    var officer = officers[selectedWing].find(o => o.name === selectedOfficerName);
                    if (officer) {
                        officerIdInput.val(officer.id);
                    } else {
                        officerIdInput.val('');
                    }
                }
            });
        });
    </script>
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

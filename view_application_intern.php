<?php
    session_start();

    include_once 'db.php';

    if ($_SESSION['officer_username'] == "") {
        header("Location: login.php");
      exit;
      }
    
    $query = "SELECT name FROM officers";
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

    $id = $_GET['id'];

if (isset($id)) {
    // Prepare and execute the query to fetch officer data
    $stmt = $conn->prepare("SELECT * FROM `leave_applications` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize variables
    $name = '';
    $number = '';
    $wing = '';
    $leaveType = '';
    $fromDate = '';
    $toDate = '';
    $fromTime = '';
    $toTime = '';
    $numberOfDays = '';
    $reason = '';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $number = $row['intern_id'];
        $wing = $row['wing'];
        $leaveType = $row['leave_type'];
        $fromDate = $row['from_date'];
        $toDate = $row['to_date'];
        $fromTime = $row['from_time'];
        $toTime = $row['to_time'];
        $numberOfDays = $row['number_of_days'];
        $reason = $row['reason'];
    } else {
        echo "No record found with ID $id";
    }

    $stmt->close();
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
        .notif:hover {
            background-color: #5a8dee;
        }
        body{
            background: #5a8dee;
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
                            <h3>View Leave Application</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <!-- Breadcrumb navigation -->
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="intern.php" class="text-primary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        View Leave Application
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
                                                <!-- Officer ID -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="employee-id">Intern ID</label>
                                                      <div class="position-relative">
                                                          <input type="text" class="form-control" placeholder="Intern ID" id="employee-id" name="intern_number" value="<?php echo $number;?>" readonly/>
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
                                                                id="first-name-icon" name="name" value= "<?php echo $name?>" readonly/>
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
                                                       <input type="text" class="form-control" id="basicSelect" name="wing" value="<?php echo $wing ?>"  readonly>
                                                         
                                                   
                                               </div>
                                                <!-- Number of Days -->
                                                <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="number-of-days">Number of Days</label>
                                                      <div class="position-relative">
                                                      <input type="text" class="form-control" placeholder="Number of Days" id="number-of-days" name="numberOfDays" value="<?php echo $numberOfDays; ?>" readonly/>
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
                                                          <input type="date" class="form-control" placeholder="from date" id="from-date-icon" name="fromDate" value="<?php echo $fromDate; ?>" readonly/>
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
                                                          <input type="date" class="form-control" placeholder="to date" id="to-date-icon" name="toDate" value="<?php echo $toDate; ?>" readonly/>
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
                                                      <input type="time" class="form-control" placeholder="from time" id="from-time-icon" name="fromTime" value="<?php echo $fromTime; ?>" readonly/>          
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
                                                          <input type="time" class="form-control" placeholder="to time" id="to-time-icon" name="toTime" value="<?php echo $toTime; ?>" readonly/>
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
                                                            <input type="leave" class="form-control" placeholder="Leave Type" id="leave-type--icon" name="leaveType" value="<?php echo $leaveType; ?>" readonly/>
                                                            <div class="form-control-icon">
                                                              <i class="fa fa-file-alt"></i>
                                                          </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Reason for Leave -->
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="reason">Reason for Leave</label>
                                                            <div class="position-relative">
                                                            <input class="form-control" placeholder="Reason for Leave" id="reason" name="reason" value="<?php echo $reason; ?>" readonly/>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                      
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

<?php
include 'db.php';

session_start();
if ($_SESSION['intern_username'] == "") {
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
      <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
      <style>
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
        
  </style>
   </head>
  
   <body>
      <div id="app">
         <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
               <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                  <a href="intern.php" class="sidebar-link">
                    <i class="text-primary me-4"></i>
                    <img src="./assets/images/logo.jpg" />
                    <span>CDRD</span>
                    </a>
                </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li class="sidebar-item active ">
                        <a href="intern.php" class='sidebar-link'>
                        <i class="fa fa-home text-primary"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="intern_apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-primary"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="leave_status.php" class='sidebar-link'>
                        <i class="fa fa-plane text-primary"></i>
                        <span>Leave Status</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                            <a href="update_intern.php" class='sidebar-link'>
                                <i class="fa fa-user text-primary"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="update_password.php" class='sidebar-link'>
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
                    
                     <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                           <div class="avatar me-1">
                              
                           </div>
                           <h4 style="font-family: Fantasy;">Welcome, <?php echo $_SESSION['intern_username'];?></h4>
                        </a>
                     </li>
                  </ul>
               </div>
            </nav>
            <div class="main-content container-fluid">
               <div class="page-title">
                  <h3>Intern Dashboard</h3>
               </div>
               <br>
               <section class="section">
                  <div class="row mb-2">
            <div class=" col-md-6 ">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-upload text-primary fa-3x me-4"></i>
                    </div>
                    <div>
                      <?php
                      // Include the database connection file
                      include 'db.php';

                      // Get the logged-in intern's ID from the session
                      $intern_id = $_SESSION['intern_id'];

                      // SQL query to count the total leaves for the logged-in user
                      //$sql = "SELECT COUNT(*) AS total_leaves FROM leave_applications WHERE intern_id = '$intern_id'";
                      $sql = "SELECT SUM(number_of_days) AS total_leaves FROM leave_applications WHERE intern_id = '$intern_id'";
                      
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          $row = $result->fetch_assoc();
                          $totalLeaves = $row['total_leaves'];
                      } else {
                          $totalLeaves = 0;
                      }

                      // Close the database connection
                      $conn->close();
                      ?>
                      <h4>Total Leaves</h4>
                      <h2 class="h1 mb-0"><?php echo $totalLeaves; ?></h2>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
          <div class=" col-md-6 ">
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

                      // Get the intern ID from the session or wherever it is stored
                      $internId = $_SESSION['intern_id']; // Replace with the actual way you retrieve the intern ID

                      // SQL query to count the total pending leaves for a specific intern
                      $sqlPendingInterns = "SELECT COUNT(*) AS total_pending_interns FROM leave_applications 
                                            WHERE (intern_id = '$internId') 
                                            AND NOT (
                                            (status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve') 
                                            OR (status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline')    
                                        )";

                      $resultPendingInterns = $conn->query($sqlPendingInterns);

                      // Initialize variables
                      $totalPendingInterns = 0;

                      // Check results for pending leaves for the specific intern
                      if ($resultPendingInterns->num_rows > 0) {
                          $rowPendingInterns = $resultPendingInterns->fetch_assoc();
                          $totalPendingInterns = $rowPendingInterns['total_pending_interns'];
                      }

                      // Display total pending leaves only if at least one status is not 'approve' or 'decline'
                      echo '<h4>Pending</h4>';
                      echo '<h2 class="h1 mb-0">' . $totalPendingInterns . '</h2>';

                      // Close the database connection
                      $conn->close();
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>         
          <div class=" col-md-6">
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
                     $intern_id = $_SESSION['intern_id'];
                                                
                     // SQL query to count the total approved leaves for interns
                     $sqlApprovedInterns = "SELECT COUNT(*) AS total_approved_interns FROM leave_applications
                                            WHERE status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve' AND intern_id = '$intern_id'";

                     $resultApprovedInterns = $conn->query($sqlApprovedInterns);

                                                
                     // Initialize variables
                     $totalApprovedInterns = 0;
                                                
                     // Check results for approved leaves for interns
                     if ($resultApprovedInterns->num_rows > 0) {
                      $rowApprovedInterns = $resultApprovedInterns->fetch_assoc();
                      $totalApprovedInterns = $rowApprovedInterns['total_approved_interns'];
                    }
                                                
                    // Display total approved Interns
                    echo '<h4>Approved</h4>';
                    echo '<h2 class="h1 mb-0">' . $totalApprovedInterns . '</h2>';
                                                
                    // Close the database connection
                    $conn->close();
                    ?>                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
                    
          <div class="col-md-6">
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
                                              WHERE (status1 = 'decline' OR status2 = 'decline' OR status3 = 'decline') AND intern_id = '$intern_id'"; 
                      $resultCanceledInterns = $conn->query($sqlCanceledInterns);

                      // Initialize variables
                      $totalCanceledInterns = 0;

                      // Check results for canceled leaves for interns
                      if ($resultCanceledInterns->num_rows > 0) {
                          $rowCanceledInterns = $resultCanceledInterns->fetch_assoc();
                          $totalCanceledInterns = $rowCanceledInterns['total_canceled_interns'];
                      }

                      // Display total canceled leaves
                      echo '<h4>Declined</h4>';
                      echo '<h2 class="h1 mb-0">' . $totalCanceledInterns . '</h2>';

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
        </div>
      </section>
    </div>
  </div>
</div>
<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/vendors/chartjs/Chart.min.js"></script>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
<?php
include 'db.php';

session_start();
if ($_SESSION['officer_username'] == "") {
  header("Location: login.php");
exit;
}

// First SQL query to count pending leave applications
$sql1 = "SELECT COUNT(*) as count1 
         FROM leave_applications_officers 
         WHERE position != 'Director General' 
         AND (status3 IN ('pending', 'Unknown') OR status3 IS NULL OR status3 = '') 
         AND (status2 = 'approve' OR (position IN ('Staff Officer 1','Cheif Controller','Cheif Coordinator','Deputy Director Gene', 'Account Officer','Quater Master')) AND status='approve')";
         
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$count1 = $row1['count1'];

// Second SQL query to count pending leave applications assigned to the logged-in officer
$sql2 = "SELECT COUNT(*) as count2 
         FROM leave_applications_ero 
         WHERE status2='approve' 
         AND (status3 IN ('pending', 'Unknown') OR status3 IS NULL OR status3 = '')";

$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
$count2 = $row2['count2'];

$conn->close();

// Calculate the total count
$totalCount = $count1 + $count2;
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
    .black-caption {
      color: black;
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




</head>

<body>
  <div id="app">
    <div id="sidebar" class='active'>
      <div class="sidebar-wrapper active">
        <div class="sidebar-header" style="height: 50px;margin-top: -30px">
          <a href="dg.php" class="sidebar-link">
            <i class="text-primary me-4"></i>
            <img src="./assets/images/logo.jpg" />
            <span>CDRD</span>
          </a>
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-item active ">
              <a href="dg.php" class='sidebar-link'>
                <i class="fa fa-home text-primary"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
                        <a href="approve_leave_DG.php" class="sidebar-link">
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
              <a href="dg_all_leaves.php" class="sidebar-link">
                <i class="fa fa-plane text-primary"></i>
                <span>All Officer Leaves</span>
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
            <li class="sidebar-item">
              <a href="logout.php" class="sidebar-link">
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
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">

            <li class="dropdown">
              <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="avatar me-1">
                <h4 style="font-family: Fantasy;">Welcome, <?php echo $_SESSION['officer_username'];?></h4>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="main-content container-fluid">
        <div class="page-title">
          <h3>Director General Dashboard</h3>
        </div>
        <br>
        <section class="section">
          <div class="row">
          <div class="row mb-2">
            
            <?php
            include 'db.php';
            $today = date('Y-m-d');
            $sql = "
                  SELECT 
                      o.wing, 
                      o.name, 
                      l.from_date, 
                      l.to_date 
                  FROM 
                      officers o
                  JOIN 
                      leave_applications_officers l 
                  ON 
                      o.officer_number = l.officer_number 
                  WHERE 
                      '$today' BETWEEN l.from_date AND l.to_date AND
                      (o.position = 'Research Officer' AND l.status = 'approve' AND l.status1 = 'approve' AND l.status2 = 'approve' AND l.status3 = 'approve')
                      OR
                      (o.position = 'Quater Master' AND l.status = 'approve' AND l.status3 = 'approve')
                      OR
                      (o.position = 'Account Officer' AND l.status = 'approve' AND l.status3 = 'approve')
                      OR
                      (o.position = 'Wing Head' AND l.status = 'approve' AND l.status2 = 'approve' AND l.status3 = 'approve')
                      OR
                      (o.position = 'Staff Officer 1' AND l.status = 'approve' AND l.status3 = 'approve')
                      OR
                      (o.position = 'Cheif Controller' AND l.status = 'approve' AND l.status3 = 'approve')
                      OR
                      (o.position = 'Cheif Coordinator' AND l.status = 'approve' AND l.status3 = 'approve')
                      OR
                      (o.position = 'Deputy Director Gene' AND l.status = 'approve' AND l.status3 = 'approve')";
            $result = $conn->query($sql);
            $leaveData = [];
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $fromDate = new DateTime($row['from_date']);
                $toDate = new DateTime($row['to_date']);
                $interval = $fromDate->diff($toDate)->format('%a') + 1;

                for ($i = 0; $i < $interval; $i++) {
                  $currentDate = clone $fromDate;
                  $currentDate->modify("+$i day");
                  if ($currentDate->format('Y-m-d') == $today) {
                    $leaveData[$row['wing']][] = [
                      'wing' => $row['wing'],
                      'name' => $row['name']
                    ];
                  }
                }
              }
            }
            ?>
            <!-- officer leave table -->
            <div class="col-xl-6 col-md-12 mb-4">
              <div class="card fixed-card">
                <div class="card-body">
                  <div class="justify-content-center">
                    <div>
                      <table class="table caption-top text-center">
                        <caption class="black-caption"><b>Officers Leaves on <?php echo $today?></b></caption>
                        <thead>
                          <tr>
                            <th>Wing</th>
                            <th>Name</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (empty($leaveData)) {
                            echo '<tr><td colspan="2">All officers are present</td></tr>';
                          } else {
                            foreach ($leaveData as $wing => $wingData) {
                              $rowSpan = count($wingData); // Calculate rowspan dynamically
                              echo "<tr><td rowspan='$rowSpan'>$wing</td>";
                              foreach ($wingData as $leave) {
                                echo "<td>{$leave['name']}</td></tr><tr>";
                              }
                            }
                          }
                          $conn->close();
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            include 'db.php';
            // Fetch leave applications where today is within the leave period
            $today = date('Y-m-d');
            $sql = "SELECT id, name, wing, from_date, to_date FROM leave_applications WHERE (status1 = 'approve' AND status2 = 'approve' AND status3 = 'approve') AND '$today' BETWEEN from_date AND to_date";
            $result = $conn->query($sql);

            $leaveData = [];
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $fromDate = new DateTime($row['from_date']);
                $toDate = new DateTime($row['to_date']);
                $interval = $fromDate->diff($toDate)->format('%a') + 1; // Number of days of leave
            
                for ($i = 0; $i < $interval; $i++) {
                  $currentDate = clone $fromDate;
                  $currentDate->modify("+$i day");
                  if ($currentDate->format('Y-m-d') == $today) {
                    $leaveData[$row['wing']][] = [
                      'wing' => $row['wing'],
                      'name' => $row['name']
                    ];
                  }
                }
              }
            }
            ?>
            <!-- pending approval-->
            <div class="col-xl-6 col-md-12 mb-4">
              <div class="card fixed-card">
                <div class="card-body">
                  <div class="justify-content-center">
                    <div>
                    <?php
                            // Include the database connection file
                            include 'db.php';

                            // SQL query to fetch all columns from the 'leave_applications_officers' table
                            $sql = "SELECT leave_applications_officers.*, 
                                    CASE 
                                        WHEN officers.wing = 'none' THEN leave_applications_officers.position 
                                        ELSE officers.wing 
                                    END AS wing_or_position 
                              FROM leave_applications_officers 
                              JOIN officers ON leave_applications_officers.officer_number = officers.officer_number
                              WHERE leave_applications_officers.position != 'Director General' 
                              AND (leave_applications_officers.status3 IN ('pending', 'Unknown') 
                                  OR leave_applications_officers.status3 IS NULL 
                                  OR leave_applications_officers.status3 = '') 
                              AND (leave_applications_officers.status2 = 'approve' 
                                  OR (leave_applications_officers.position IN ('Staff Officer 1','Cheif Controller','Cheif Coordinator','Deputy Director Gene', 'Account Officer','Quater Master') 
                                      AND leave_applications_officers.status = 'approve'))";


                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result === false) {
                                echo "Error: " . $conn->error;
                            } else {
                                // Display the fetched data in the table
                                echo "<div>";
                                echo "<table class='table caption-top text-center'>";
                                echo "<caption class='black-caption'><b>Pending officers' Leave Approval</b></caption>";
                                echo "<thead>
                                        <tr>
                                            <th>Wing/Position</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                // Loop through the fetched data and display it in the table
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['wing_or_position'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";

                                   
                                    

                                    echo "</tr>";
                                }
                                echo "</tbody></table>";
                            }                           

                            // Close the database connection (from db.php)
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
              <div class="card-body animate__animated animate__bounceIn ">
                <h5 class="birthday">Today's Birthdays of Officers</h5>
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-gift text-info fa-3x me-4 animate__animated animate__bounceIn" ></i>
                    </div>
                    <div>
                    <?php
            include 'db.php';
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
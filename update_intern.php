<?php
session_start();

include('db.php');

if(!isset($_SESSION['intern_email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['intern_email'];

// Query to retrieve user data from the database based on email
$sql= "SELECT * FROM intern WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result-> fetch_assoc();

    // Assign fetched data to variables
    $intern_id = $row['intern_id'];
    $name = $row['name'];
    $name_in_full = $row['name_in_full'];
    $permanent_address = $row['permanent_address'];
    $university = $row['university'];
    $trade = $row['trade'];
    $wing = $row['wing'];
    $email = $row['email'];
    $username = $row['username'];
    $password = $row['password'];
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
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header" style="height: 50px;margin-top: -30px">
        <i class="me-4"></i>
        <img src="./assets/images/logo.jpg" />
        <a href="intern.php"><span>CDRD</span></a>
 
                </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li class="sidebar-item ">
                        <a href="intern.php" class='sidebar-link'>
                        <i class="fa fa-home text-primary"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item">
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
                            <a href="update_intern_info.php" class='sidebar-link'>
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
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                     <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                           <div class="avatar me-1">
                              <img src="assets/images/admin.png" alt="" srcset="">
                              <span>Welcome, <?php echo $_SESSION['intern_username'];?></span>
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
                <h3>Account</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="intern.php" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account</li>
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
                            <form class="form" method="POST" action = "update_profile.php">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Intern ID</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"  id="first-name-icon" name="intern_id" value="<?php echo $intern_id ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-id-card"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Username</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="username" value="<?php echo $username ?>"  readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user-tag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="row">
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Name</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="name" value="<?php echo $name ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Name in full</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="first-name-icon" name="name_in_full" value="<?php echo $name_in_full ?>" readonly>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                     </div>

                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Wing</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="first-name-icon" name="wing" value="<?php echo $wing ?>" readonly>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">University</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="first-name-icon" name="university" value="<?php echo $university ?>"  readonly>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-university"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Permanent Address</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="first-name-icon" name="permanent_address" value="<?php echo $permanent_address ?>"  readonly>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Email</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="email" value="<?php echo $email ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-envelope"></i>
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
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password-input');
        var togglePasswordIcon = document.getElementById('toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordIcon.innerHTML = '<i class="fa fa-eye-slash" onclick="togglePasswordVisibility()"></i>';
        } else {
            passwordInput.type = 'password';
            togglePasswordIcon.innerHTML = '<i class="fa fa-eye" onclick="togglePasswordVisibility()"></i>';
        }
    }
    </script>

</body>
</html>

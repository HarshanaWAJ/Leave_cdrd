<?php
session_start();

include('db.php');

if(!isset($_SESSION['officer_email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['officer_email'];

// Query to retrieve officer data from the database based on email
$sql = "SELECT * FROM officers WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();

    // Assign fetched data to variables
    $officer_id = $row['officer_number'];
    $rank = $row['rank'];
    $name = $row['name'];
    $unit = $row['unit'];
    $name_in_full = $row['name_in_full'];
    $permanent_address = $row['permanent_address'];
    $temporary_address = $row['temporary_address'];
    $trade = $row['trade'];
    $position = $row['position'];
    $district = $row['district'];
    $gs_division = $row['gs_division'];
    $nearest_police_station = $row['nearest_police_station'];
    $wing = $row['wing'];
    $email = $row['email'];
    $username = $row['username'];
    $password = $row['password'];
    $forcee = $row['forcee'];
    $birth = $row['birth'];
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
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <!-- Navbar content -->
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
                                    <img src="assets/images/admin.png" alt="" srcset="" />
                                    <span>Welcome, <?php echo $_SESSION['officer_username'];?></span>
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
                            <nav aria-label="breadcrumb" class="breadcrumb-header">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="intern.php" class="text-primary">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Account
                                    </li>
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
                                            <label for="first-name-icon">Officer ID</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"  id="first-name-icon" name="officer_id" value="<?php echo $officer_id ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-id-card"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Rank</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="rank" value="<?php echo $rank ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Unit</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="first-name-icon" name="unit" value="<?php echo $unit ?>"  readonly>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Trade</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="trade" value="<?php echo $trade ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Position</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="position" value="<?php echo $position ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Force</label>
                                            <div class="position-relative">
                                            <input type="text" class="form-control" id="first-name-icon" name="forcee" value="<?php echo $forcee ?>" readonly>
                                            <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                   

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
                                                <label for="first-name-icon">name in full</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="first-name-icon" name="name_in_full" value="<?php echo $name_in_full ?>"  readonly>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-university"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Permanent Address</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="first-name-icon" name="permanent_address" value="<?php echo $permanent_address ?>"  readonly>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                                   

                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Temporary Address</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="temporary_address" value="<?php echo $temporary_address ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="from-date-icon">Birth Of Date</label>
                                                      <div class="position-relative">
                                                          <input type="date" class="form-control" placeholder="Birth Of Date" id="from-date-icon" name="birth" value="<?php echo htmlspecialchars($birth); ?>" readonly/>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-calendar"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">District</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="district" value="<?php echo $district ?>"  readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user-tag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">GS Division</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="first-name-icon" name="gs_division" value="<?php echo $gs_division ?>" readonly>
                                            <div class="form-control-icon">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Nearest Police Station</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="first-name-icon" name="nearest_police_station" value="<?php echo $nearest_police_station ?>" readonly>
                                            <div class="form-control-icon">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Wing</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="first-name-icon" name="wing" value="<?php echo $wing ?>" readonly>
                                            <div class="form-control-icon">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Email</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="first-name-icon" name="email" value="<?php echo $email ?>"  readonly>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user-tag"></i>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

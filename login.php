<?php
session_start();
include_once 'db.php';

// Set the default timezone to Asia/Colombo
date_default_timezone_set('Asia/Colombo');

// Function to log actions
function logAction($action, $user) {
    $logFile = 'log.txt';
    $timestamp = date('Y-m-d H:i:s');   
    $logMessage = "[$timestamp] $user: $action\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Admin logging credentials
$adminEmail = "admin@cdrd.lk";
$adminPassword = "admin1234";
$admin_username = "Admin";


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for admin login
    if ($email === $adminEmail && $password === $adminPassword) {
        // Set common session variables for admin
        $_SESSION['admin_username'] = $admin_username;
        logAction('Admin login', $admin_username);

        // Redirect to admin page
        echo "<script>window.location.href = 'admin.php';</script>";
        exit();
    }

    // Check in the intern table
    $selectIntern = "SELECT * FROM intern WHERE email = ?";
    $stmtIntern = $conn->prepare($selectIntern);
    $stmtIntern->bind_param('s', $email);
    $stmtIntern->execute();
    $resultIntern = $stmtIntern->get_result();

    if ($resultIntern->num_rows > 0) {
        $row = $resultIntern->fetch_assoc();
        
        // Check if 'password' column exists in the result row
        if (isset($row['password'])) {
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Set session variables for intern
                $_SESSION['id'] = $row['id'];
                $_SESSION['intern_id'] = $row['intern_id'];
                $_SESSION['intern_name'] = $row['name'];
                $_SESSION['intern_name_in_full'] = $row['name_in_full'];
                $_SESSION['intern_permanent_address'] = $row['permanent_address'];
                $_SESSION['intern_university'] = $row['university'];
                $_SESSION['intern_trade'] = $row['trade'];
                $_SESSION['intern_wing'] = $row['wing'];
                $_SESSION['intern_email'] = $row['email'];
                $_SESSION['intern_username'] = $row['username'];
                $_SESSION['intern_password'] = $row['password'];

                // Redirect to intern page
                logAction('Intern login', $row['name']);
                echo "<script>window.location.href = 'intern.php';</script>";
                exit();
            } else {
                $error = "Invalid Username or Password <br> Try again!!!!";
            }
        }
    } else {
        // Check in the officers table
        $selectOfficer = "SELECT * FROM officers WHERE email = ?";
        $stmtOfficer = $conn->prepare($selectOfficer);
        $stmtOfficer->bind_param('s', $email);
        $stmtOfficer->execute();
        $resultOfficer = $stmtOfficer->get_result();

        if ($resultOfficer->num_rows > 0) {
            $row = $resultOfficer->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set common session variables for officer
                $_SESSION['officer_number'] = $row['officer_number'];
                $_SESSION['officer_rank'] = $row['rank'];
                $_SESSION['officer_name'] = $row['name'];
                $_SESSION['officer_unit'] = $row['unit'];
                $_SESSION['officer_name_in_full'] = $row['name_in_full'];
                $_SESSION['officer_permanent_address'] = $row['permanent_address'];
                $_SESSION['officer_temporary_address'] = $row['temporary_address'];
                $_SESSION['officer_trade'] = $row['trade'];
                $_SESSION['officer_position'] = $row['position'];
                $_SESSION['officer_district'] = $row['district'];
                $_SESSION['officer_gs_division'] = $row['gs_division'];
                $_SESSION['officer_nearest_police_station'] = $row['nearest_police_station'];
                $_SESSION['officer_wing'] = $row['wing'];
                $_SESSION['officer_email'] = $row['email'];
                $_SESSION['officer_username'] = $row['username'];
                $_SESSION['officer_password'] = $row['password'];
                $_SESSION['birth'] = $row['birth'];
                $_SESSION['forcee'] = $row['forcee'];

                // Check user position and dynamically set session variables and redirect
                logAction('Officer login', $row['name']);
                switch ($row['position']) {
                    case 'Senior Non Commissioned Officer':
                        $_SESSION['officer_position'] = 'Senior Non Commissioned Officer';
                        echo "<script>window.location.href = 'snco.php';</script>";
                        break;
                        case 'Cheif Clerk':
                            $_SESSION['officer_position'] = 'Cheif Clerk';
                            echo "<script>window.location.href = 'clerk.php';</script>";
                            break;
                    case 'Research Officer':
                        $_SESSION['officer_position'] = 'Research Officer';
                        echo "<script>window.location.href = 'research_officer.php';</script>";
                        break;
                    case 'Quater Master':
                        $_SESSION['officer_position'] = 'Quater Master';
                        echo "<script>window.location.href = 'quater_master.php';</script>";
                        break;
                    case 'Account Officer':
                        $_SESSION['officer_position'] = 'Account Officer';
                        echo "<script>window.location.href = 'account_officer.php';</script>";
                        break;
                    case 'Wing Head':
                        $_SESSION['officer_position'] = 'Wing Head';
                        echo "<script>window.location.href = 'wing_head.php';</script>";
                        break;
                    case 'Staff Officer 1':
                        $_SESSION['officer_position'] = 'Staff Officer 1';
                        echo "<script>window.location.href = 'so1.php';</script>";
                        break;
                    case 'Cheif Controller':
                        $_SESSION['officer_position'] = 'Cheif Controller';
                        echo "<script>window.location.href = 'cc.php';</script>";
                        break;
                    case 'Cheif Coordinator':
                        $_SESSION['officer_position'] = 'Cheif Coordinator';
                        echo "<script>window.location.href = 'coordinator.php';</script>";
                        break;
                    case 'Deputy Director General':
                        $_SESSION['officer_position'] = 'Deputy Director General';
                        echo "<script>window.location.href = 'ddg.php';</script>";
                        break;
                    case 'Director General':
                        $_SESSION['officer_position'] = 'Director General';
                        echo "<script>window.location.href = 'dg.php';</script>";
                        break;
                    default:
                        header("Location: login.php");
                        break;
                }
                exit();
            } else {
                $error = "Invalid Username or Password <br> Try again!!!!";
            }
        } else {
            // Check in the external_research_officers table
            $selectExternalResearchOfficer = "SELECT * FROM external_research_officer WHERE email = ?";
            $stmtExternalResearchOfficer = $conn->prepare($selectExternalResearchOfficer);
            $stmtExternalResearchOfficer->bind_param('s', $email);
            $stmtExternalResearchOfficer->execute();
            $resultExternalResearchOfficer = $stmtExternalResearchOfficer->get_result();

            if ($resultExternalResearchOfficer->num_rows > 0) {
                $row = $resultExternalResearchOfficer->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    // Set session variables for external research officer
                    $_SESSION['external_id'] = $row['external_id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['ero_wing'] = $row['wing'];
                    $_SESSION['ero_username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];

                    // Redirect to external research officer page
                    logAction('External Research Officer login', $row['name']);
                    echo "<script>window.location.href = 'external_research_officer.php';</script>";
                    exit();
                } else {
                    $error = "Invalid Username or Password <br> Try again!!!!";
                }
            } else {
                $error = "Invalid Username or Password <br> Try again!!!!";
            }
        }
    }
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
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                            <img src="./assets/images/logo.jpg" alt="Logo" class="mb-3">
                                <h3>Sign In</h3>
                            </div>
                            <form method="post" onsubmit="return validateForm()">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="email">Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="email" name="email">
                                        <div class="form-control-icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="error-message" id="email-error"></div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <div class="form-control-icon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                    <div class="error-message" id="password-error"></div>
                                    <br>
                                </div>
                                <iv class="clearfix" style="display: flex; justify-content: center; align-items: center; ">
                                    <input type="submit" class="btn btn-primary me-2" name="submit" value="Login">
                                </div>
                            </form>
                            <?php if(isset($error) && !empty($error)): ?>
                                <div class="alert alert-danger mt-3"><?= $error ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>

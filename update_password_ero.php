<?php
// Include database connection and start session
include 'db.php';
session_start();

// Redirect to login page if the user is not logged in
if (empty($_SESSION['ero_username'])) {
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
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
<div id="app">
    <div id="sidebar" class='active'>
        <div class="sidebar-wrapper active">
            <div class="sidebar-header" style="height: 50px; margin-top: -30px;">
                <a href="external_research_officer.php" class="sidebar-link">
                    <img src="./assets/images/logo.jpg" />
                    <span>CDRD</span>
                </a>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-item"><a href="external_research_officer.php" class='sidebar-link'><i class="fa fa-home text-primary"></i><span>Dashboard</span></a></li>
                    <li class="sidebar-item"><a href="external_research_officer_apply_leave.php" class='sidebar-link'><i class="fa fa-plane text-primary"></i><span>Apply Leave</span></a></li>
                    <li class="sidebar-item"><a href="external_research_officer_leave_status.php" class='sidebar-link'><i class="fa fa-plane text-primary"></i><span>Leave Status</span></a></li>
                    <li class="sidebar-item"><a href="update_ero_info.php" class='sidebar-link'><i class="fa fa-user text-primary"></i><span>Account</span></a></li>
                    <li class="sidebar-item active"><a href="update_password_ero.php" class='sidebar-link'><i class="fa fa-cog text-primary"></i><span>Settings</span></a></li>
                    <li class="sidebar-item"><a href="logout.php" class='sidebar-link'><i class="fa fa-sign-out-alt text-primary"></i><span>Logout</span></a></li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <nav class="navbar navbar-header navbar-expand navbar-light">
            <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                    <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="avatar me-1">
                                <h4 style="font-family: Fantasy;">Welcome, <?php echo $_SESSION['ero_username']; ?></h4>
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
                        <h3>Update Password</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class='breadcrumb-header'>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="external_research_officer.php" class="text-primary">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Setting</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" action="update_password_ero.php" method="post">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="old_password">Old Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" placeholder="Old password" id="old_password" name="old_password">
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="new_password">New Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" placeholder="New password" id="new_password" name="new_password">
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="confirm_password">Confirm Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" name="confirm_password">
                                                        <div class="form-control-icon">
                                                            <i class="fa fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                    <?php
                                    // Process form submission
                                    if (isset($_POST['submit'])) {
                                        $oldPassword = $_POST['old_password'];
                                        $newPassword = $_POST['new_password'];
                                        $confirmPassword = $_POST['confirm_password'];

                                        // Validate passwords
                                        if ($newPassword != $confirmPassword) {
                                            echo "<script>";
                                            echo "Swal.fire({";
                                            echo "    icon: 'error',";
                                            echo "    title: 'Oops...',";
                                            echo "    text: 'New password and confirm password do not match!',";
                                            echo "});";
                                            echo "</script>";
                                        } else {
                                            $externalId = $_SESSION['external_id'];
                                            $oldPasswordFromSession = $_SESSION['password']; // Assuming this is a hashed password

                                            // Check if the old password matches the one stored in the session
                                            if (password_verify($oldPassword, $oldPasswordFromSession)) {
                                                // Hash the new password
                                                $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                                                // Update the password in the database
                                                $updatePasswordQuery = $conn->prepare("UPDATE external_research_officer SET password = ? WHERE external_id = ?");
                                                $updatePasswordQuery->bind_param('ss', $hashedNewPassword, $externalId);

                                                if ($updatePasswordQuery->execute()) {
                                                    // Update the password in the session
                                                    $_SESSION['password'] = $hashedNewPassword;
                                                    echo "<script>";
                                                    echo "Swal.fire({";
                                                    echo "    icon: 'success',";
                                                    echo "    title: 'Success',";
                                                    echo "    text: 'Password updated successfully!',";
                                                    echo "}).then(() => {";
                                                    echo "    window.location.href = 'external_research_officer.php';";
                                                    echo "});";
                                                    echo "</script>";
                                                    exit;
                                                } else {
                                                    echo "<script>";
                                                    echo "Swal.fire({";
                                                    echo "    icon: 'error',";
                                                    echo "    title: 'Error',";
                                                    echo "    text: 'Error updating password: " . $conn->error . "',";
                                                    echo "});";
                                                    echo "</script>";
                                                }
                                            } else {
                                                echo "<script>";
                                                echo "Swal.fire({";
                                                echo "    icon: 'error',";
                                                echo "    title: 'Error',";
                                                echo "    text: 'Incorrect old password.',";
                                                echo "});";
                                                echo "</script>";
                                            }
                                        }
                                    }
                                    ?>
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
</body>
</html>

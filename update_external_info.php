<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leave_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if ($id) {
    // Prepare and execute the query to fetch officer data
    $stmt = $conn->prepare("SELECT * FROM `external_research_officer` WHERE external_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $external_id = '';
    $name = '';
    $name_in_full = '';
    $permanent_address = '';
    $trade = '';
    $wing = '';
    $email = '';
    $username = '';
    $password = '';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $external_id = $row['external_id'];
        $name = $row['name'];
        $name_in_full = $row['name_in_full'];
        $permanent_address = $row['permanent_address'];
        $trade = $row['trade'];
        $wing = $row['wing'];
        $email = $row['email'];
        $username = $row['username'];
        $password = $row['password'];
    } else {
        echo "No record found with ID $id";
    }

    // Close the statement
    $stmt->close();
}

$updateSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["external_id"]) &&
        isset($_POST["name"]) &&
        isset($_POST["name_in_full"]) &&
        isset($_POST["permanent_address"]) &&
        isset($_POST["trade"]) &&
        isset($_POST["wing"]) &&
        isset($_POST['email']) &&
        isset($_POST["username"]) &&
        isset($_POST["password"])
    ) {
        $external_id = (int)$_POST["external_id"];
        $name = $conn->real_escape_string($_POST["name"]);
        $name_in_full = $conn->real_escape_string($_POST["name_in_full"]);
        $permanent_address = $conn->real_escape_string($_POST["permanent_address"]);
        $trade = $conn->real_escape_string($_POST["trade"]);
        $wing = $conn->real_escape_string($_POST["wing"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $username = $conn->real_escape_string($_POST["username"]);
        $password = $conn->real_escape_string($_POST["password"]);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE external_research_officer SET name=?, name_in_full=?, permanent_address=?, trade=?, wing=?, email=?, username=?, password=? WHERE external_id=?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }

        $stmt->bind_param("isssssssi", $name, $name_in_full, $permanent_address, $trade, $wing, $email, $username, $hashedPassword, $external_id);

        if ($stmt->execute()) {
            $updateSuccess = true;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Required fields are missing.";
    }
}

// Close the database connection
$conn->close();
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
                                    <div class="d-none d-md-block d-lg-inline-block">Welcome, Admin</div>
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
                <h3>Update External Research Officers</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update External Research Officers</li>
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
                            <form class="form" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">External Research Officer ID</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="External Research Officer ID" id="first-name-icon" name="external_id" value="<?php echo htmlspecialchars($external_id); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-id-card"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Name</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Name" id="first-name-icon" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Name in full</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Name in Full" id="first-name-icon" name="name_in_full" value="<?php echo htmlspecialchars($name_in_full); ?>" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Permanent Address</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Permanent Address" id="first-name-icon" name="permanent_address" value="<?php echo htmlspecialchars($permanent_address); ?>" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     
                                    <div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Trade (Role)</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Trade" id="first-name-icon" name="trade" value="<?php echo htmlspecialchars($trade); ?>" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Wing</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" onchange="updatePlaceholder()" name="wing" required>
                                                    <option value="" disabled <?php echo empty($wing) ? 'selected' : ''; ?>>Select Wing</option>
                                                    <option value="IT/GIS" <?php echo ($wing === 'IT/GIS') ? 'selected' : ''; ?>>IT/GIS</option>
                                                    <option value="CYBER" <?php echo ($wing === 'CYBER') ? 'selected' : ''; ?>>CYBER</option>
                                                    <option value="ELECTRICAL AND MECHANICAL" <?php echo ($wing === 'ELECTRICAL AND MECHANICAL') ? 'selected' : ''; ?>>ELECTRICAL AND MECHANICAL</option>
                                                    <option value="SATELLITE AND SURVEILLANCE" <?php echo ($wing === 'SATELLITE AND SURVEILLANCE') ? 'selected' : ''; ?>>SATELLITE AND SURVEILLANCE</option>
                                                    <option value="RADIO AND ELECTRONICS" <?php echo ($wing === 'RADIO AND ELECTRONICS') ? 'selected' : ''; ?>>RADIO AND ELECTRONICS</option>
                                                    <option value="NANO AND MODERN TECHNOLOGY" <?php echo ($wing === 'NANO AND MODERN TECHNOLOGY') ? 'selected' : ''; ?>>NANO AND MODERN TECHNOLOGY</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Email</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Email" id="first-name-icon" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Username</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="username" id="first-name-icon" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user-tag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Password</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control" placeholder="password" id="first-name-icon" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    </div>

                                    

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
    <?php if ($updateSuccess): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Updated',
                text: 'External Research Officers updated successfully!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'manage_ero.php';
                }
            });
        </script>
    <?php endif; ?>
    <script>
        function updatePlaceholder() {
        var dropdown = document.getElementById("basicSelect");
        var selectedOption = dropdown.options[dropdown.selectedIndex].value;

        // Update the placeholder text
        if (selectedOption === "") {
            dropdown.classList.remove("selected");
        } else {
            dropdown.classList.add("selected");
        }
    }
    </script>

</body>
</html>

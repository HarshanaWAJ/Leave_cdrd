<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leave_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$id = $_GET['id'];

if (isset($id)) {
    // Prepare and execute the query to fetch officer data
    $stmt = $conn->prepare("SELECT * FROM `officers` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize the variable
    $officerNumber = '';
    $rank = '';
    $name = '';
    $unit = '';
    $nameInFull = '';
    $permanentAddress = '';
    $temporaryAddress = '';
    $trade = '';
    $position = '';
    $district = '';
    $gsDivision = '';
    $nearestPoliceStation = '';
    $wing = '';
    $email = '';
    $username = '';
    $password = '';
    $forcee = '';
    $birth = '';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $officerNumber = $row['officer_number'];
        $rank = $row['rank'];
        $name = $row['name'];
        $unit = $row['unit'];
        $nameInFull = $row['name_in_full'];
        $permanentAddress = $row['permanent_address'];
        $temporaryAddress = $row['temporary_address'];
        $trade = $row['trade'];
        $position = $row['position'];
        $district = $row['district'];
        $gsDivision = $row['gs_division'];
        $nearestPoliceStation = $row['nearest_police_station'];
        $wing = $row['wing'];
        $email = $row['email'];
        $username = $row['username'];
        $password = $row['password'];
        $forcee = $row['forcee'];
        $birth = $row['birth'];
    } else {
        echo "No record found with ID $id";
    }

    // Close the statement
    $stmt->close();
}

$updateSuccess = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set in $_POST
    if (
        isset($_POST["officer_number"]) &&
        isset($_POST["rank"]) &&
        isset($_POST["name"]) &&
        isset($_POST["unit"]) &&
        isset($_POST["name_in_full"]) &&
        isset($_POST["permanent_address"]) &&
        isset($_POST["temporary_address"]) &&
        isset($_POST["trade"]) &&
        isset($_POST["position"]) &&
        isset($_POST["district"]) &&
        isset($_POST["gs_division"]) &&
        isset($_POST["nearest_police_station"]) &&
        isset($_POST["wing"]) &&
        isset($_POST['email']) &&
        isset($_POST["username"]) &&
        isset($_POST["password"]) &&
        isset($_POST["forcee"]) &&
        isset($_POST["birth"])
    ) {
        // Retrieve form data (sanitize and validate inputs as needed)
        $officerNumber = $conn->real_escape_string($_POST["officer_number"]);
        $rank = $conn->real_escape_string($_POST["rank"]);
        $name = $conn->real_escape_string($_POST["name"]);
        $unit = $conn->real_escape_string($_POST["unit"]);
        $fullName = $conn->real_escape_string($_POST["name_in_full"]);
        $permAddress = $conn->real_escape_string($_POST["permanent_address"]);
        $tempAddress = $conn->real_escape_string($_POST["temporary_address"]);
        $trade = $conn->real_escape_string($_POST["trade"]);
        $position = $conn->real_escape_string($_POST["position"]);
        $district = $conn->real_escape_string($_POST["district"]);
        $gsDivision = $conn->real_escape_string($_POST["gs_division"]);
        $nearestPoliceStation = $conn->real_escape_string($_POST["nearest_police_station"]);
        $wing = $conn->real_escape_string($_POST["wing"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $username = $conn->real_escape_string($_POST["username"]);
        $forcee = $conn->real_escape_string($_POST["forcee"]);
        $birth = $conn->real_escape_string($_POST["birth"]);
        $password = $conn->real_escape_string($_POST["password"]);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Perform database insertion using prepared statements for security
        $sql = "UPDATE officers SET officer_number=?, rank=?, name=?, unit=?, name_in_full=?, permanent_address=?, temporary_address=?, trade=?, position=?, district=?, gs_division=?, nearest_police_station=?, wing=?, email=?, username=?, password=?, forcee=?, birth=? WHERE id=?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssssssssssssssssssi", $officerNumber, $rank, $name, $unit, $fullName, $permAddress, $tempAddress, $trade, $position, $district, $gsDivision, $nearestPoliceStation, $wing, $email, $username, $hashedPassword, $forcee, $birth, $id);
        // Execute the statement
        if ($stmt->execute()) {
            $updateSuccess = true;
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
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <h3>Update Officers</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Officers</li>
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
                                            <label for="first-name-icon">Officer Number</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Officer number" id="first-name-icon" name="officer_number" value="<?php echo htmlspecialchars($officerNumber); ?>" required>
                                                <div class="form-control-icon"></div>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-hash"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Rank</label>
                                            <div class="position-relative">
                                                <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" onchange="updatePlaceholder()" name="rank" required>
                                                    <option value="" disabled>Select Rank</option>
                                                    <?php
                                                    $ranks = ["Lieutenant", "Captain", "Major", "Lieutenant Colonel", "Colonel", "Brigadier", "Major General", "Lieutenant General", "Lieutenant", "Lieutenant Commander", "Commander", "Captain", "Commodore", "Rear Admiral", "Flight Lieutenant", "Squadron Leader", "Wing Commander", "Group Captain", "Air Commodore", "Flying Officer"];
                                                    foreach ($ranks as $r) {
                                                        $selected = ($rank == $r) ? 'selected' : ''; // Check if this option should be selected
                                                        echo '<option value="' . $r . '" ' . $selected . '>' . $r . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Unit</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Unit" id="first-name-icon" name="unit" value="<?php echo htmlspecialchars($unit); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Trade (Role)</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Trade" id="first-name-icon" name="trade" value="<?php echo htmlspecialchars($trade); ?>" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Position</label>
                                            <div class="position-relative">
                                                <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" onchange="updatePlaceholder()" name="position" required>
                                                    <option value="" disabled>Select Position</option>
                                                    <?php
                                                    $positions = ["Senior Non Commissioned Officer","Cheif Clerk", "Research Officer", "Quater Master", "Account Officer", "Wing Head", "Staff Officer 1", "Cheif Controller","Cheif Coordinator", "Deputy Director General", "Director General"];
                                                    foreach ($positions as $p) {
                                                        $selected = ($position == $p) ? 'selected' : ''; // Check if this option should be selected
                                                        echo '<option value="' . $p . '" ' . $selected . '>' . $p . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Force</label>
                                            <div class="position-relative">
                                                <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" onchange="updatePlaceholder()" name="forcee" required>
                                                    <option value="" disabled>Select Force</option>
                                                    <?php
                                                    $positions = ["Army", "Navy", "Air Force"];
                                                    foreach ($positions as $p) {
                                                        $selected = ($position == $p) ? 'selected' : ''; // Check if this option should be selected
                                                        echo '<option value="' . $p . '" ' . $selected . '>' . $p . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                </fieldset>
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
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Name in full</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Name in Full" id="first-name-icon" name="name_in_full" value="<?php echo htmlspecialchars($nameInFull); ?>" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Permanent Address</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Permanent Address" id="first-name-icon" name="permanent_address" value="<?php echo htmlspecialchars($permanentAddress); ?>" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">Temporary Address</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Temporary Address" id="first-name-icon" name="temporary_address" value="<?php echo htmlspecialchars($temporaryAddress); ?>" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6 col-12">
                                                  <div class="form-group has-icon-left">
                                                      <label for="from-date-icon">Birth Of Date</label>
                                                      <div class="position-relative">
                                                          <input type="date" class="form-control" placeholder="Birth Of Date" id="from-date-icon" name="birth" value="<?php echo htmlspecialchars($birth); ?>" required/>
                                                          <div class="form-control-icon">
                                                              <i class="fa fa-calendar"></i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>                              
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">District</label>
                                            <fieldset class="form-group">
                                            <select class="form-select" id="basicSelect" name="district" required>
                                                <option value="" disabled>Select District</option>
                                                <?php
                                                $districts = ["AMPARA", "ANURADHAPURA", "BADULLA", "BATTICALOA", "COLOMBO", "GAMPAHA","GALLE", "HAMBANTOTA", "JAFFNA",
                                                                "KALUTARA", "KANDY", "KEGALLE", "KILINOCHCHI", "KURUNEGALA", "MANNAR", "MATALE", "MATARA",
                                                                "MONARAGALA", "MULLAITIVU", "NUWARA ELIYA", "POLONNARUWA", "PUTTALAM", "RATNAPURA", "TRINCOMALEE", "VAVUNIYA"];
                                                foreach ($districts as $d) {
                                                    echo '<option value="' . $d . '"' . ($district == $d ? ' selected' : '') . '>' . $d . '</option>';
                                                }
                                                ?>
                                            </select>                       
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">GS Division</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="GS Division" id="first-name-icon" name="gs_division" value="<?php echo htmlspecialchars($gsDivision); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-building"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Nearest Police Station</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Nearest Police Station" id="first-name-icon" name="nearest_police_station" value="<?php echo htmlspecialchars($nearestPoliceStation); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-building"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Wing</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" onchange="updatePlaceholder()" name="wing" required>
                                                    <option value="" disabled selected>Select Wing</option>
                                                    <option value="ARMAMENT & BALLISTIC" <?php echo ($wing == 'ARMAMENT & BALLISTIC') ? 'selected' : ''; ?>>ARMAMENT & BALLISTIC</option>
                                                    <option value="IT/GIS" <?php echo ($wing == 'IT/GIS') ? 'selected' : ''; ?>>IT/GIS</option>
                                                    <option value="CYBER" <?php echo ($wing == 'CYBER') ? 'selected' : ''; ?>>CYBER</option>
                                                    <option value="ELECTRICAL AND MECHANICAL" <?php echo ($wing == 'ELECTRICAL AND MECHANICAL') ? 'selected' : ''; ?>>ELECTRICAL AND MECHANICAL</option>
                                                    <option value="RADIO AND ELECTRONICS" <?php echo ($wing == 'RADIO AND ELECTRONICS') ? 'selected' : ''; ?>>RADIO AND ELECTRONICS</option>
                                                    <option value="SATELLITE AND SURVEILLANCE" <?php echo ($wing == 'SATELLITE AND SURVEILLANCE') ? 'selected' : ''; ?>>SATELLITE AND SURVEILLANCE</option>
                                                    <option value="NANO AND MODERN TECHNOLOGY" <?php echo ($wing == 'NANO AND MODERN TECHNOLOGY') ? 'selected' : ''; ?>>NANO AND MODERN TECHNOLOGY</option>
                                                    <option value="COMMERCIAL WING" <?php echo ($wing == 'COMMERCIAL WING') ? 'selected' : ''; ?>>COMMERCIAL WING</option>
                                                    <option value="None" <?php echo ($wing == 'None') ? 'selected' : ''; ?>>None</option>
                                                    </select>
                                                </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Email</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Email" id="first-name-icon" name="email" value="<?php echo htmlspecialchars($email); ?>"required>
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
                                                    <i class="fa fa-user"></i>
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

    <?php if ($updateSuccess): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Updated',
                text: 'Officer updated successfully!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'manage_officers.php';
                }
            });
        </script>
    <?php endif; ?>


    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
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

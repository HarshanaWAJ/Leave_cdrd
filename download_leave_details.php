<?php
include 'db.php';

session_start();
if ($_SESSION['admin_username'] == "") {
  header("Location: login.php");
exit;
}

$fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
$toDate = isset($_POST['toDate']) ? $_POST['toDate'] : '';
$force = isset($_POST['forcee']) ? $_POST['forcee'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre for Defense Research and Development</title>
    <link rel="icon" href="./assets/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        .leave-table {
            border-collapse: collapse;
            width: 100%;
        }

        .leave-table th,
        .leave-table td {
            border: 1px solid #000;
            padding: 15px;
            text-align: left;
        }

        .leave-table th {
            background-color: #80b3ff;
        }

        #downloadPngBtn {
            margin-left: 303px;
        }
        .back{
            margin-left: 150px;
            margin-right: 150px;
        }

    </style>

</head>

<body style="background-color: #80b3ff;">
    <div class="back">

        <nav class="navbar navbar-header navbar-expand navbar-light">
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
                                    <span>Welcome, <?php echo 'admin';?></span>
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
                            <h3>Download Leave Details</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-primary">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Download Leave Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
    
                <!-- Add date pickers for selecting date range -->
                <div class="row mb-3">
                <div class="col-4">
                        <label for="fromDate">From Date:</label>
                        <input type="date" id="fromDate" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-4">
                        <label for="toDate">To Date:</label>
                        <input type="date" id="toDate" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-4">
                        <label for="forcee">Force:</label>
                        <fieldset class="form-group">
                            <select class="form-select" id="basicSelect"  name="forcee" required>
                                <option value="" disabled selected>Select Force</option>
                                <option value="Army">Army</option>
                                <option value="Navy">Navy</option>
                                <option value="Air Force">Air Force</option>
                            </select>
                        </fieldset>
                    </div>
                </div>
                <!-- Add a Search button and Clear button -->
                <div class="row mb-3">
                    <div class="col-12">
                        <button class="btn btn-primary" id="searchBtn">Search</button>
                        <button class="btn btn-secondary" id="clearBtn">Clear</button>
                    </div>
                </div>
                    <section class="section">
                    <div class="card">
                        <div class="card-body">
                        <h3>All Leaves of Officers</h3>
                            
                        <div style = 'overflow-x: auto;'>;
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Rank</th>
                                    <th>Leave Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Number Of Days</th>
                                    <th>Reason</th>
                                    <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="leaveTableBody2">
                                <?php
                                    // Include the database connection file
                                    include 'db.php';

                                    // SQL query to retrieve all leaves from leave_applications table
                                    $sql = "SELECT leave_applications_officers.*, officers.* 
                                    FROM leave_applications_officers 
                                    INNER JOIN officers ON leave_applications_officers.officer_number = officers.officer_number
                                    WHERE from_date BETWEEN '$fromDate' AND '$toDate' AND
                                    ((leave_applications_officers.position = 'Research Officer' AND 
                                        leave_applications_officers.status = 'approve' AND 
                                        leave_applications_officers.status1 = 'approve' AND 
                                        leave_applications_officers.status2 = 'approve' AND 
                                        leave_applications_officers.status3 = 'approve')
                                    OR
                                    (leave_applications_officers.position = 'Quater Master' AND 
                                    leave_applications_officers.status = 'approve' AND
                                    leave_applications_officers.status2 = 'approve' AND
                                        leave_applications_officers.status3 = 'approve')
                                    OR
                                    (leave_applications_officers.position = 'Account Officer' AND 
                                    leave_applications_officers.status2 = 'approve' AND
                                        leave_applications_officers.status3 = 'approve')
                                    OR
                                    (leave_applications_officers.position = 'Wing Head' AND 
                                        leave_applications_officers.status2 = 'approve' AND 
                                        leave_applications_officers.status3 = 'approve')
                                    OR
                                    (leave_applications_officers.position = 'Staff Officer 1' AND
                                    leave_applications_officers.status = 'approve' AND 
                                        leave_applications_officers.status3 = 'approve')
                                    OR
                                    (leave_applications_officers.position = 'Cheif Controller' AND 
                                    leave_applications_officers.status = 'approve' AND
                                        leave_applications_officers.status3 = 'approve')
                                    OR
                                    (leave_applications_officers.position = 'Cheif Coordinator' AND 
                                    leave_applications_officers.status = 'approve' AND
                                        leave_applications_officers.status3 = 'approve')
                                    OR
                                    (leave_applications_officers.position = 'Deputy Director Gene' AND 
                                    leave_applications_officers.status = 'approve' AND
                                        leave_applications_officers.status3 = 'approve'))";
                                    $result = $conn->query($sql);

                                    // Check if there are any rows in the result set
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Output each row as a table row
                                            echo "<tr>";
                                            echo '<td>' . $row['officer_number'] . '</td>';
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['rank'] . '</td>';
                                            echo '<td>' . $row['leave_type'] . '</td>';
                                            echo '<td>' . $row['from_date'] . '</td>';
                                            echo '<td>' . $row['to_date'] . '</td>';
                                            echo '<td>' . $row['number_of_days'] . '</td>';
                                            echo '<td>' . $row['reason'] . '</td>';
                                            echo '<td>' . $row['remarks'] . '</td>';
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if there are no leaves in the table
                                        echo "<tr><td colspan='12'>No leaves found</td></tr>";
                                    }

                                    // Close the database connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                            <button id="downloadOfficerBtn" class="btn btn-secondary" onclick="downloadOfficer()">Download Officer Data</button>
                        </div>
                    </div>
                </section>
                
                <section class="section">
                <div class="row mb-3">
                    <div class="card">
                        <div class="card-body">
                        <h3>All Leaves of Interns</h3>
                            <table class='table' id="table2">
                            <div class="row mb-3">
                            <div class="row mb-3">
                                <thead>
                                    <tr>
                                    <th>Intern ID</th>
                                    <th>Name</th>
                                    <th>Leave Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Number Of Days</th>
                                    <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody id="leaveTableBody">
                                <?php
                                    // Include the database connection file
                                    include 'db.php';

                                    // SQL query to retrieve all leaves from leave_applications table
                                    $sql = "SELECT * FROM leave_applications WHERE from_date BETWEEN '$fromDate' AND '$toDate' AND status3 = 'approve' ";
                                    $result = $conn->query($sql);

                                    // Check if there are any rows in the result set
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Output each row as a table row
                                            echo "<tr>";
                                            echo '<td>' . $row['intern_id'] . '</td>';
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['leave_type'] . '</td>';
                                            echo '<td>' . $row['from_date'] . '</td>';
                                            echo '<td>' . $row['to_date'] . '</td>';
                                            echo '<td>' . $row['number_of_days'] . '</td>';
                                            echo '<td>' . $row['reason'] . '</td>';
                                            echo "</tr>";
                                        }
                                    } else {
                                        // Output a message if there are no leaves in the table
                                        echo "<tr><td colspan='12'>No leaves found</td></tr>";
                                    }

                                    // Close the database connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                            <button id="downloadInternBtn" class="btn btn-secondary" onclick="downloadIntern()">Download Intern Data</button>
                        </div>
                    </div>
                </section>
                <button id="downloadOfficerBtn" class="btn btn-secondary" onclick="downloadPng()">Download Combined as PNG</button>
            </div>
        </div>
        </div>
    </div>




    <script>
        function downloadPng() {
    // Download the officer table as a PNG
    html2canvas(document.getElementById('table1')).then(function(canvasOfficer) {
        var linkOfficer = document.createElement('a');
        linkOfficer.download = 'officer_leaves_summary.png';
        linkOfficer.href = canvasOfficer.toDataURL();
        linkOfficer.click();

        // Once the officer table download is triggered, proceed to download the intern table
        html2canvas(document.getElementById('table2')).then(function(canvasIntern) {
            var linkIntern = document.createElement('a');
            linkIntern.download = 'intern_leaves_summary.png';
            linkIntern.href = canvasIntern.toDataURL();
            linkIntern.click();
        });
    });
}

        //function downloadIntern() {
            //html2canvas(document.getElementById('table2')).then(function(canvas) {
                //var link = document.createElement('a');
                //link.download = 'intern_leaves_summary.png';
                //link.href = canvas.toDataURL();
                //link.click();
            //});
        //}

        //function downloadOfficer() {
            //html2canvas(document.getElementById('table1')).then(function(canvas) {
                //var link = document.createElement('a');
                //link.download = 'officer_leaves_summary.png';
                //link.href = canvas.toDataURL();
                //link.click();
            //});
        //}
    </script>

    <script>
        function downloadOfficer() {
            html2canvas(document.getElementById('table1')).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('officer_leaves_summary.pdf');
            });
        }

        function downloadIntern() {
            html2canvas(document.getElementById('table2')).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('intern_leaves_summary.pdf');
            });
        }
    </script>


    <!-- script tag for handling date pickers, search button, clear button, and all leaves button -->
    <script>
        // Function to fetch and update leave data based on the selected date range
        function updateLeaveData(fromDate, toDate,force) {
            // Make an AJAX request to fetch leave data based on the selected date range for interns
            var xhr1 = new XMLHttpRequest();
            xhr1.open('POST', 'get_pdf.php', true);
            xhr1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr1.onreadystatechange = function () {
                if (xhr1.readyState === 4 && xhr1.status === 200) {
                    // Update the leave table for interns with the retrieved data
                    document.getElementById('leaveTableBody').innerHTML = xhr1.responseText;
                }
            };
            xhr1.send('fromDate=' + fromDate + '&toDate=' + toDate);

            // Make another AJAX request to fetch leave data based on the selected date range for officers
            var xhr2 = new XMLHttpRequest();
            xhr2.open('POST', 'get_pdf_officers.php', true);
            xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr2.onreadystatechange = function () {
                if (xhr2.readyState === 4 && xhr2.status === 200) {
                    // Update the leave table for officers with the retrieved data
                    document.getElementById('leaveTableBody2').innerHTML = xhr2.responseText;
                }
            };
            xhr2.send('fromDate=' + fromDate + '&toDate=' + toDate + '&force=' + force);
        }

        // Initialize date pickers and fetch initial leave data
        document.addEventListener("DOMContentLoaded", function () {
            var fromDateInput = document.getElementById('fromDate');
            var toDateInput = document.getElementById('toDate');
            var forceSelect = document.getElementById('basicSelect');
            var searchBtn = document.getElementById('searchBtn');
            var clearBtn = document.getElementById('clearBtn');

            // Set default values to the current date
            var currentDate = new Date().toISOString().split('T')[0];
            fromDateInput.value = currentDate;
            toDateInput.value = currentDate;

            // Fetch initial leave data for the current date
            updateLeaveData(currentDate, currentDate);

            fromDateInput.addEventListener('change', updateSearchButtonState);
            toDateInput.addEventListener('change', updateSearchButtonState);
            forceSelect.addEventListener('change', updateSearchButtonState);

            // Add click event for the Search button
            searchBtn.addEventListener('click', function () {
                // Get selected date range from date pickers
                var fromDate = fromDateInput.value;
                var toDate = toDateInput.value;
                var force = forceSelect.value;

                // Fetch and update leave data based on the selected date range
                updateLeaveData(fromDate, toDate, force);
            });

            // Add click event for the Clear button
            clearBtn.addEventListener('click', function () {
                // Set date inputs to the current date
                fromDateInput.value = currentDate;
                toDateInput.value = currentDate;
                forceSelect.value = '';

                // Fetch and update leave data for the current date
                updateLeaveData(currentDate, currentDate);
            });

            function updateSearchButtonState() {
                searchBtn.disabled = fromDateInput.value === '' || toDateInput.value === ''|| forceSelect.value === '';;
            }
        });
    </script>
    

</body>

</html>

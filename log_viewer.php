<?php
include 'db.php';

session_start();
if ($_SESSION['admin_username'] == "") {
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
</head>
<body>
    <?php
    $logFile = 'log.txt';

    if (file_exists($logFile)) {
        $logEntries = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (!empty($logEntries)) {
            echo "<html>";
            echo "<head>";
            echo "<style>";
            echo "body { background-color: #80b3ff; font-family: Arial, sans-serif; margin: 20px; color: black; }";  // Change color to black
            echo "table { border-collapse: collapse; width: 100%; margin-top: 20px; }";
            echo "th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }";
            echo "th { background-color: #2980b9; color: white; font-weight: bold; }";
            echo "tr:hover { background-color: #3498db; }";
            echo ".center-title { text-align: center; }";
            echo "</style>";
            echo "</head>";
            echo "<body>";

            echo "<h2 class='center-title'>Log Entries</h2>";
            echo "<table>";
            echo "<tr><th>Date</th><th>Time</th><th>User</th><th>Action</th></tr>";

            foreach ($logEntries as $entry) {
                // Split the log entry using "] " and ": " as delimiters
                list($rawDate, $rest) = explode("] ", $entry, 2);
                list($user, $action) = explode(": ", $rest, 2);

                // Create a DateTime object with the extracted date
                $timestamp = strtotime(substr($rawDate, 1));
                $date = date('Y-m-d', $timestamp);
                $time = date('H:i:s', $timestamp);

                echo "<tr><td>$date</td><td>$time</td><td>$user</td><td>$action</td></tr>";
            }

            echo "</table>";
            echo "</body>";
            echo "</html>";
        } else {
            echo "<p><h3>No log entries found in the system.</h3></p>";
        }
    } else {
        echo "Log file not found.";
    }
    ?>
</body>
</html>
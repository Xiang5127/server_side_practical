<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// SAMPLE ERRORS
echo "Undefined variable test: " . $undefined_variable . "<br>";

echo "Division by zero test: ";
$result = 100 / 0;
echo $result . "<br>";

require('database.php');

$bad_query = "INSERT INTO error_logs (error_code, error_message, error_time)
 VALUES ('E_TEST', 'Testing malformed query', '2025-01-01 00:00:00'";
mysqli_query($con, $bad_query) or die("MySQL Error: " . mysqli_error($con));

mysqli_close($con);
echo "End of script.";
?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('database.php');
$errorLogged = false;
echo "<h3>Division-by-Zero Check</h3>";
$divisor = 0;
$divisionByZeroOccurred = false;
if ($divisor == 0 && !$errorLogged) {
 echo "Error: Division by zero avoided.<br>";
 $divisionByZeroOccurred = true;

 $error_code = "E_DIV_ZERO";
 $error_message = "Division Error: You attempted to divide by zero. Please check your
input values or calculations.";
 $error_time = date("Y-m-d H:i:s");
 $sql = "INSERT INTO error_logs (error_code, error_message, error_time)
 VALUES (?, ?, ?)";
 $stmt = mysqli_prepare($con, $sql);
 if ($stmt) {
 mysqli_stmt_bind_param($stmt, "sss", $error_code, $error_message, $error_time);
 if (mysqli_stmt_execute($stmt)) {
 echo "<p>Logged division-by-zero error to the database successfully.</p>";
 $errorLogged = true;
 } else {
 echo "<p><b>Error Logging Failed:</b> " . mysqli_stmt_error($stmt) . "</p>";
 }
 mysqli_stmt_close($stmt);
 }
} else if (!$divisionByZeroOccurred) {
 $result = 100 / $divisor;
 echo "Result: $result<br>";
}
echo "<h3>Undefined Variable Check</h3>";
if (!isset($some_undefined_variable) && !$errorLogged) {
 echo "Notice: 'some_undefined_variable' is not defined. Make sure all variables are
declared before use.<br>";

 $error_code = "E_UNDEFINED_VAR";
 $error_message = "Undefined Variable Error: A variable was used without being
defined. Please check your code for proper declaration.";
 $error_time = date("Y-m-d H:i:s");

 $sql2 = "INSERT INTO error_logs (error_code, error_message, error_time)
 VALUES (?, ?, ?)";
 $stmt2 = mysqli_prepare($con, $sql2);
 if ($stmt2) {
 mysqli_stmt_bind_param($stmt2, "sss", $error_code, $error_message,
$error_time);
 if (mysqli_stmt_execute($stmt2)) {
 echo "<p>Logged undefined variable notice to the database successfully.</p>";
 $errorLogged = true;
 } else {
 echo "<p><b>Error Logging Failed:</b> " . mysqli_stmt_error($stmt2) . "</p>";
 }
 mysqli_stmt_close($stmt2);
 }
} else if (isset($some_undefined_variable)) {
 echo $some_undefined_variable;
}
mysqli_close($con);
echo "<p>End of script.</p>";
?>
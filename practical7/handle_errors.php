<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
function logErrorToDB($error_code, $error_message) {
 require('database.php');
 $error_time = date("Y-m-d H:i:s");
 $sql = "INSERT INTO error_logs (error_code, error_message, error_time) VALUES
(?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);
 if ($stmt) {
 mysqli_stmt_bind_param($stmt, "sss", $error_code, $error_message, $error_time);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_close($stmt);
 }
 mysqli_close($con);
}

require('database.php');
echo "<h3>Division-by-Zero Check</h3>";
$divisor = 0;
$divisionByZeroOccurred = false;
if ($divisor == 0) {
 echo "Error: Division by zero avoided.<br>";
 $divisionByZeroOccurred = true;
} else {
 $result = 100 / $divisor;
 echo "Result: $result<br>";
}
if ($divisionByZeroOccurred) {
 $error_code = "E_DIV_ZERO";
 $error_message = "You attempted to divide by zero. Please check your calculation or
input values.";
 logErrorToDB($error_code, $error_message);
 echo "<p>Logged division-by-zero error to the database successfully.</p>";
}
echo "<h3>Undefined Variable Check</h3>";
if (isset($some_undefined_variable)) {
 echo $some_undefined_variable;
} else {
 echo "Notice: 'some_undefined_variable' is not defined. Make sure all variables are
declared before use.<br>";
 $error_code = "E_UNDEFINED_VAR";
 $error_message = "Detected an undefined variable in the code.";
 logErrorToDB($error_code, $error_message);
 echo "<p>Logged undefined variable notice to the database successfully.</p>";
}
mysqli_close($con);
echo "<p>End of script.</p>";
?>

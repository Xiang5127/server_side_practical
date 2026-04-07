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
function customErrorHandler($errno, $errstr, $errfile, $errline) {
 $errorMessage = "[$errno] $errstr in $errfile on line $errline";
 echo "<b>Error:</b> $errorMessage<br>";
 error_log("[" . date("Y-m-d H:i:s") . "] $errorMessage\n", 3, "error_log.txt");
$error_code = "E_" . $errno;
 logErrorToDB($error_code, $errorMessage);

 return true;
}
set_error_handler("customErrorHandler");
function customExceptionHandler($exception) {
 $exceptionMessage = "Exception: " . $exception->getMessage();
 echo "<b>Exception:</b> $exceptionMessage<br>";
 error_log("[" . date("Y-m-d H:i:s") . "] $exceptionMessage\n", 3, "error_log.txt");

 logErrorToDB("EXCEPTION", $exceptionMessage);
}
set_exception_handler("customExceptionHandler");
?>

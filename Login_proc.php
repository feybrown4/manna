<?php //Login_proc.php
include 'Employee.php';
session_start();


//took these from the bitter sprint 
if (isset($_POST["username"])) {
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];
    Employee::login($username, $password);
}
?>


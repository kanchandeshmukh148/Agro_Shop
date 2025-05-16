<?php
include 'message.php' ;
session_start();

// Unset all of the session variables
$_SESSION = array();

$_SESSION["Message"] = "Logout successfully !!!";

// Redirect to the login page
// header("Location: login.php");
header("Location: ../index.php");
exit();

<?php 
// session_start();
if (!empty($_SESSION["Message"])) {
    echo "<script>alert('" . $_SESSION["Message"] . "');</script>";
    unset($_SESSION["Message"]);
}

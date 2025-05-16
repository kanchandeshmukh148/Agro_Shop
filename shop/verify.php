<?php
session_start();
// if (!empty($_SESSION["Message"])) {
//     echo "<script>alert('" . $_SESSION["Message"] . "');</script>";
//     $_SESSION["Message"] = "";
// }

if (!empty($_SESSION["ShopID"]) && !empty($_SESSION["ShopEmail"])) {
   echo "<script>window.location.href = index.php;</script>" ;
} else {
    echo "<script>alert('Please Log-In to Website');</script>";

    header("Location: login.php");
    exit();

}



// if (isset($_SESSION["Message"]) && !empty($_SESSION["Message"])) {
//     echo "<script>alert('" . $_SESSION["Message"] . "');</script>";
//     $_SESSION["Message"] = "";
// }

// if (is_null($_SESSION["AdminID"]) || empty($_SESSION["AdminEmail"])) {
//     echo "<script>alert('Please Log-In to Website');</script>";
//     header("Location: login.php");
//     exit();
// }

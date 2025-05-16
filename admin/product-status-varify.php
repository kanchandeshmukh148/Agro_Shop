<?php
include 'comfig.php';

session_start(); // Make sure to start the session

// Assuming $connect is your database connection, make sure it's established before using it

if(isset($_GET['id'])) {
    handleUpdate('varify', 'id', $_GET['id'], "blocked-product.php", 'Approved');
} elseif(isset($_GET['id2'])) {
    handleUpdate('blocked', 'id2', $_GET['id2'] , "varifyed-product.php", 'Disapproved');
} elseif (isset($_GET['id3'])) {
    handleUpdate('varify', 'id3', $_GET['id3'], "varifyed-product.php", 'Approved');
} elseif (isset($_GET['id4'])) {
    handleUpdate('blocked', 'id4', $_GET['id4'], "blocked-product.php", 'Disapproved');
} else {

    $_SESSION['Message'] = "Invalid request. Missing 'id' or 'id' parameter.";
    header("Location: view-product.php");
    exit();
}

function handleUpdate($status, $paramName, $paramValue , $link, $message) {
    global $connect;

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($connect, $paramValue);

    $query = "UPDATE product SET Productstateus = '$status' WHERE ProductID  = '$id';";

    $result = mysqli_query($connect, $query);

    if($result) {
        $_SESSION['Message'] = $message . " successful!";
    } else {
        $_SESSION['Message'] = "Update failed: ".mysqli_error($connect);
    }

    mysqli_close($connect);
    header("Location: " . $link);
    exit();
}
?>
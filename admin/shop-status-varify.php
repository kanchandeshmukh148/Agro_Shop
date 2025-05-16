<?php
include 'comfig.php';

session_start(); // Make sure to start the session

// Assuming $connect is your database connection, make sure it's established before using it

if(isset($_GET['id'])) {
    handleUpdate('varify', 'id', $_GET['id'] ,  "blocked-shop.php" , 'Approved');
} elseif(isset($_GET['id3'])) {
    handleUpdate('blocked', 'id3', $_GET['id3'] , "varify-shop.php" , 'Disapproved');
} elseif(isset($_GET['id5'])) {
    handleUpdate('varify', 'id5', $_GET['id5'] ,  "varify-shop.php" , 'Approved');
} elseif(isset($_GET['id7'])) {
    handleUpdate('blocked', 'id7', $_GET['id7'] , "blocked-shop.php" , 'Disapproved');
} else {
    $_SESSION['Message'] = "Invalid request. Missing parameter.";
    header("Location: index.php");
    exit();
}

function handleUpdate($status, $paramName, $paramValue , $link , $message) {
    global $connect;

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($connect, $paramValue);

    $query = "UPDATE shop SET Shopstatus = '$status' WHERE ShopID = '$id';";

    $result = mysqli_query($connect, $query);

    if($result) {
        $_SESSION['Message'] = $message." successful!";
        header("Location: ". $link);
        exit();
    } else {
        $_SESSION['Message'] = "Update failed: ".mysqli_error($connect);
        header("Location: ".$link);
        exit();
    }

}
?>
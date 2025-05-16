<?php
session_start();
include 'comfig.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Delete from orderdetails table
    $deleteOrderDetails = mysqli_query($connect, "DELETE FROM orderdetails WHERE OrderID = $orderId");

    // Delete from ordertable table
    $deleteOrderTable = mysqli_query($connect, "DELETE FROM ordertable WHERE OrderID = $orderId");

    // Check if deletion was successful
    if ($deleteOrderDetails && $deleteOrderTable) {
        $_SESSION["Message"] =  "Order and related details deleted successfully.";
    } else {
        $_SESSION["Message"] =  "Something went wrong with the server while processing your order. Please note that your order may have been placed by default.";
    }

    // Close the connection
    mysqli_close($connect);
}

// Redirect to the view-all-product.php page
header("Location: my-order.php");
exit();
?>

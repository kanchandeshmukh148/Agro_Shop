<?php
include 'comfig.php';
session_start();
if (isset($_GET['id'])) {
    // $id = $_GET['id'];

    $id = mysqli_real_escape_string($connect, $_GET['id']);
    // Delete the element with the specified ID from the database
    // You need to add the DELETE SQL query here based on your table structure
    $deleteQuery = "DELETE FROM `category` WHERE `CategoryID` = ".$id;
    // header('Location: view-area.php');
    if (mysqli_query($connect, $deleteQuery)) {
        // Redirect to a success page or do something else
        $_SESSION['Message'] = "Category Deleted Successfully";
        header('Location: view-category.php');
        exit();
    } else {
        $_SESSION['Message'] = "Something want working can't able to delete Category !!!!!";
        header('Location: view-category.php');
        exit();
    }
}

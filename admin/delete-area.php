<?php
include 'comfig.php';
session_start();
if (isset($_GET['id'])) {
    // $id = $_GET['id'];

    $id = mysqli_real_escape_string($connect, $_GET['id']);

    if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `area` WHERE `area-id` = '$id'")) === 0) {
        $_SESSION['Message'] = "Something went wrong, Area not found!";
        header("Location: view-area.php");
        exit();
    }

    // // mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `city` WHERE `city-id` = '".$id."'"))
    // if (!empty(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `area` WHERE `area-id` = '" . $id . "'")))) {
    //     $_SESSION['Message'] = `Something want working , Area is not Found !!!!!`;
    //     header('Location: view-area.php');
    //     exit();
    // }
    // Delete the element with the specified ID from the database
    // You need to add the DELETE SQL query here based on your table structure
    $deleteQuery = "DELETE FROM `area` WHERE `area-id` = $id";
    // header('Location: view-area.php');
    if (mysqli_query($connect, $deleteQuery)) {
        // Redirect to a success page or do something else
        $_SESSION['Message'] = "Area Deleted Successfully";
        header('Location: view-area.php');
        exit();
    } else {
        $_SESSION['Message'] = "Something want working can't able to delete Area !!!!!";
        header('Location: view-area.php');
        exit();
    }
}

<?php
include 'comfig.php';
session_start();
if (isset($_GET['id'])) {
    // $id = $_GET['id'];
    $id = mysqli_real_escape_string($connect, $_GET['id']);
    // mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `city` WHERE `city-id` = '".$id."'"))
    if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `state` WHERE `state-id` = '$id'")) === 0) {
        $_SESSION['Message'] = `Something want working , State is not Found !!!!!`;
        header('Location: view.php');
        exit();
    }

    // Delete the element with the specified ID from the database
    // You need to add the DELETE SQL queries here based on your table structure
    $deleteStateQuery = "DELETE FROM `state` WHERE `state-id` = $id";
    $deleteCityQuery = "DELETE FROM `city` WHERE `state-id` = $id";
    $deleteAreaQuery = "DELETE FROM `area` WHERE `state-id` = $id";

    // Execute the delete queries
    $ds = mysqli_query($connect, $deleteStateQuery);


    if (mysqli_query($connect, $deleteStateQuery)) {
        mysqli_query($connect, $deleteCityQuery);
        mysqli_query($connect, $deleteAreaQuery);
        
        // Redirect to a success page or do something else
        $_SESSION['Message'] = 'State Deleted Successfully';
        header('Location: view-state.php');
        exit();
    } else {
        $_SESSION['Message'] = `Something want working can't able to delete State !!!!!`;
        header('Location: view-state.php');
        exit();
    }
}
?>

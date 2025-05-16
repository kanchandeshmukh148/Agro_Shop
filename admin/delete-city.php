<?php
include 'comfig.php';
session_start();
if (isset($_GET['id'])) {
    // $id = $_GET['id'];
    $id = mysqli_real_escape_string($connect, $_GET['id']);
    // mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `city` WHERE `city-id` = '".$id."'"))
    if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `city` WHERE `city-id` = " .$id)) === 0) {
        $_SESSION['Message'] = `Something want working , City is not Found !!!!!`;
        header('Location: view.php');
        exit();
    }
    // Delete the element with the specified ID from the database
    // You need to add the DELETE SQL queries here based on your table structure
    $deleteCityQuery = "DELETE FROM `city` WHERE `city-id` =". $id;
    $deleteAreaQuery = "DELETE FROM `area` WHERE `city-id` = ".$id;


    if (mysqli_query($connect, $deleteCityQuery)) {
        mysqli_query($connect, $deleteAreaQuery);
        $_SESSION['Message'] = 'City Deleted Successfully';
        header('Location: view-city.php');
        exit();

    }

} else {
    $_SESSION['Message'] = "Something want working can't able to delete city !!!!!";
    header('Location: view-city.php');
    exit();
}
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     // Delete the element with the specified ID from the database
//     // You need to add the DELETE SQL query here based on your table structure
//     $deleteQuery = "DELETE FROM `area` WHERE `area-id` = $id";
//     mysqli_query($connect, $deleteQuery);
//     header('Location: view-area.php');
// }
<?php
session_start();
include 'comfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stateId = $_POST["stateId"];
    $cityName = $_POST["cityName"];

    // Check if the city already exists
    $checkQuery = "SELECT * FROM city WHERE `city-name` = '$cityName' AND `state-id` = $stateId";
    $result = $connect->query($checkQuery);

    if ($result->num_rows > 0) {
        $_SESSION['Message'] =  "City already exists in the selected state!";
        echo "<script>"; // Start JavaScript block
        echo 'window.location.href="view-city.php";'; // Use JavaScript to change the page
        echo "</script>";
    } else {
        // Add the city to the table
        $insertQuery = "INSERT INTO city (`city-name`,`state-id`) VALUES ('$cityName', $stateId)";

        if ($connect->query($insertQuery) === TRUE) {
            $_SESSION['Message'] = "City Added successful.";
            echo "<script>"; // Start JavaScript block
            echo 'window.location.href="view-city.php";'; // Use JavaScript to change the page
            echo "</script>";
            // header("Location: add-location.php");
            // exit();
        } else {
            // Data insertion failed
            // echo "<script>alert('Data insertion failed. Please try again.');</script>";
            $_SESSION['Message'] = "failed To Add City. Please try again.";
            echo "<script>"; // Start JavaScript block
            echo 'window.location.href="view-city.php";'; // Use JavaScript to change the page
            echo "</script>";
            // header("Location: add-location.php");
            // exit();
        }
    }

    $connect->close();
}
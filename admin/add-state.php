<?php
session_start();
include 'comfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stateName = $_POST["stateName"];

    // Check if the state already exists
    $checkQuery = "SELECT * FROM state WHERE `state-name` = '$stateName'";
    $result = $connect->query($checkQuery);

    if ($result->num_rows > 0) {
        $_SESSION['Message'] = "State already exists!";
        echo "<script>"; // Start JavaScript block
        echo 'window.location.href="view-state.php";'; // Use JavaScript to change the page
        echo "</script>";
    } else {
        // Add the state to the table
        $insertQuery = "INSERT INTO state (`state-name`) VALUES ('$stateName')";

        if ($connect->query($insertQuery) === TRUE) {
            $_SESSION['Message'] = "State Added successful.";
            echo "<script>"; // Start JavaScript block
            echo 'window.location.href="view-state.php";'; // Use JavaScript to change the page
            echo "</script>";
            // header("Location: add-location.php");
            // exit();
        } else {
            // Data insertion failed
            // echo "<script>alert('Data insertion failed. Please try again.');</script>";
            $_SESSION['Message'] = "failed To Add State. Please try again.";
            echo "<script>"; // Start JavaScript block
            echo 'window.location.href="view-state.php";'; // Use JavaScript to change the page
            echo "</script>";
            // header("Location: add-location.php");
            // exit();
        }
    }

    $connect->close();
}
?>
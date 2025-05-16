<?php
include 'comfig.php'; // Include your database configuration
session_start();

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    if (isset($_POST['area']) && isset($_POST['cityId']) && isset($_POST['stateId'])) {
        // Retrieve the edited values from the form
        $editedAreaName = mysqli_real_escape_string($connect, $_POST['area']);
        $editedAreaAddress = mysqli_real_escape_string($connect, $_POST['areaAddress']);
        $editedCityId = (int) $_POST['cityId'];
        $editedStateId = (int) $_POST['stateId'];

        // Check if the area with the updated values already exists
        $checkQuery = "SELECT * FROM area WHERE `area-name` = '$editedAreaName' AND `state-id` = $editedStateId AND `city-id` = $editedCityId AND `area-address` = '$editedAreaAddress'";
        $result = $connect->query($checkQuery);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            if ($id == $row['area-id']) {
                // $_SESSION['Message'] = "You did not Chang Anything!";
                header('Location: view-area.php');
                exit();
            } else {
                // Note: It seems you have the same code block for both if and else.
                // You might want to adjust this based on your specific requirements.

                $_SESSION['Message'] = 'Area with the same details already exists!';
                header('Location: view-area.php');
                exit();
            }
            // Handle the case when the form is not submitted with valid data
            
        } else {
            // Perform an SQL UPDATE to update the area information in the database
            $updateQuery = "UPDATE area SET 
                `area-name` = '$editedAreaName',
                `area-address` = '$editedAreaAddress',
                `city-id` = $editedCityId,
                `state-id` = $editedStateId
                WHERE `area-id` = $id";

            mysqli_query($connect, $updateQuery);

            // Redirect back to the page that displays the data
            $_SESSION['Message'] = 'Area Updated successfully.';
            header('Location: view-area.php');
            exit();
        }
    } else {
        // Handle the case when the form is not submitted with valid data
        $_SESSION['Message'] = 'All fields are required.';
        header('Location: view-area.php');
        exit();
    }
} else {
    // Handle the case when no 'id' is provided in the URL
    $_SESSION['Message'] = 'Area ID is missing.';
    header('Location: view-area.php');
    exit();
}
?>
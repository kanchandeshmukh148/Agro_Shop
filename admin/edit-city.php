<?php
include 'comfig.php'; // Include your database configuration
session_start();
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    if (isset($_POST['cityName'])) {
        // Retrieve the edited city name from the form
        $editedCityName = mysqli_real_escape_string($connect, $_POST['cityName']);
        $stateId = mysqli_real_escape_string($connect, $_POST['stateId']);

        // Check if the city already exists
        $checkQuery = "SELECT * FROM city WHERE `city-name` = '$editedCityName' AND `state-id` = $stateId";
        $result = $connect->query($checkQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($id == $row['city-id']) {
                // $_SESSION['Message'] = "You did not Chang Anything!";
                header('Location: view-city.php');
                exit();
            } else {
                // Note: It seems you have the same code block for both if and else.
                // You might want to adjust this based on your specific requirements.

                $_SESSION['Message'] = "City already exists in the selected state!";
                header('Location: view-city.php');
                exit();
            }
            
        } else {
            // Perform an SQL UPDATE to update the city name in the database
            $updateQuery = "UPDATE `city` SET `city-name` = '$editedCityName', `state-id` = '$stateId' WHERE `city-id` = $id";
            mysqli_query($connect, $updateQuery);

            // Redirect back to the page that displays the data
            $_SESSION['Message'] = 'City Updated successfully.';
            header('Location: view-city.php');
            exit();
        }
    } else {
        // Handle the case when the form is not submitted with a valid city name
        $_SESSION['Message'] = 'City name is required.';
        header('Location: view-city.php');
        exit();
    }
} else {
    // Handle the case when no 'id' is provided in the URL
    $_SESSION['Message'] = 'City ID is missing.';
    header('Location: view-city.php');
    exit();
}
?>
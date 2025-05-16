<?php
include 'comfig.php'; // Include your database configuration
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['stateName'])) {
        // Retrieve the edited state name from the form
        $editedStateName = $_POST['stateName'];

        $stateName = $_POST['stateName'];

        // Check if the city already exists

        $checkQuery = "SELECT * FROM state WHERE `state-name` = '$stateName'";
        $result = $connect->query($checkQuery);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                
            if ($id = $row['state-id']) {
                // $_SESSION['Message'] = "You did not Chang Anything!";
                echo "<script>"; // Start JavaScript block
                echo 'window.location.href="view-state.php";'; // Use JavaScript to change the page
                echo "</script>";
            } else {
                // Note: It seems you have the same code block for both if and else.
                // You might want to adjust this based on your specific requirements.

                $_SESSION['Message'] = "State already exists!";
                echo "<script>"; // Start JavaScript block
                echo 'window.location.href="view-state.php";'; // Use JavaScript to change the page
                echo "</script>";
            }
        } else {

            // Perform an SQL UPDATE to update the state name in the database
            $updateQuery = "UPDATE `state` SET `state-name` = '$editedStateName' WHERE `state-id` = $id";
            mysqli_query($connect, $updateQuery);

            // Redirect back to the page that displays the data
            $_SESSION['Message'] = 'State Updated Successfully.';
            header('Location: view-state.php');
            exit();
        }
    }

} else {
    // Handle the case when no 'id' is provided in the URL
    $_SESSION['Message'] = 'State ID is missing.';
    header('Location: view-state.php');
    exit();
}

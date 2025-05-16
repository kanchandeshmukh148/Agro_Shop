<?php
include 'comfig.php'; // Include your database configuration
session_start();

if (isset($_POST['submit'])) {
    // Retrieve the edited category name and description from the form
    $editedCategoryName = mysqli_real_escape_string($connect, $_POST['category']);
    $editedDescription = mysqli_real_escape_string($connect, $_POST['description']);

    // Check if the category name already exists
    $checkQuery = "SELECT * FROM Category WHERE CategoryName = '$editedCategoryName'";
    $result = $connect->query($checkQuery);

    if ($result->num_rows > 0) {
        // Handle the case when the category name already exists
        $_SESSION['Message'] = 'Category already exists!';
        header('Location: view-category.php');
        exit();
    } else {
        // Perform an SQL INSERT to add the new category to the database
        $insertQuery = "INSERT INTO Category (CategoryName, Description) VALUES ('$editedCategoryName', '$editedDescription')";
        $cat = mysqli_query($connect, $insertQuery);

        if ($cat) {
            // Redirect back to the page that displays the data
            $_SESSION['Message'] = 'Category Added Successfully.';
            header('Location: view-category.php');
            exit();
        } else {
            // Handle the case when the insertion fails
            $_SESSION['Message'] = 'Failed To Add Category!!!';
            header('Location: view-category.php');
            exit();
        }
    }
} else {
    // Handle the case when the form is not submitted
    $_SESSION['Message'] = 'Form not submitted.';
    header('Location: view-category.php');
    exit();
}
?>
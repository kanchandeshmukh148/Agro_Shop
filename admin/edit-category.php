<?php
include 'comfig.php'; // Include your database configuration
session_start();

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    if (isset($_POST['submit'])) {
        $editedCategoryName = mysqli_real_escape_string($connect, $_POST['category']);
        $editedDescription = mysqli_real_escape_string($connect, $_POST['description']);

        // Check if the new category name and description already exist in the database
        $checkQuery = "SELECT * FROM Category WHERE CategoryName = '$editedCategoryName' AND Description = '$editedDescription' AND CategoryID = '$id'";
        $result = $connect->query($checkQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // if (($id == $row['CategoryID']) && ($editedDescription = $row['Description'])) {
            // $_SESSION['Message'] = "You did not change anything!";
            header('Location: view-category.php');
            exit();
            // } 

        } else {

            
            // Check if the new category name already exists in the database
            $checkQuery2 = "SELECT * FROM Category WHERE CategoryName = '$editedCategoryName'";
            $result2 = $connect->query($checkQuery2);
            $row = $result2->fetch_assoc();

            if (($id == $row['CategoryID']) && (!($editedDescription == $row['Description']))) {

                // Perform an SQL UPDATE to update the category information in the database
                $updateQuery = "UPDATE Category SET CategoryName = '$editedCategoryName', Description = '$editedDescription' WHERE CategoryID = $id";

                $cat = mysqli_query($connect, $updateQuery);

                if ($cat) {
                    $_SESSION['Message'] = 'Category Updated successfully.';
                    header('Location: view-category.php');
                    exit();
                } else {
                    $_SESSION['Message'] = 'Something went wrong while updating the category.';
                    header('Location: view-category.php');
                    exit();
                }
            }
            if ($result2->num_rows > 0) {

                $_SESSION['Message'] = "Category already exists with the selected name!";
                header('Location: view-category.php');
                exit();
            }

            // Perform an SQL UPDATE to update the category information in the database
            $updateQuery = "UPDATE Category SET CategoryName = '$editedCategoryName', Description = '$editedDescription' WHERE CategoryID = $id";

            $cat = mysqli_query($connect, $updateQuery);

            if ($cat) {
                $_SESSION['Message'] = 'Category Updated successfully.';
                header('Location: view-category.php');
                exit();
            } else {
                $_SESSION['Message'] = 'Something went wrong while updating the category.';
                header('Location: view-category.php');
                exit();
            }
        }
    } else {
        $_SESSION['Message'] = 'Form not submitted.';
        header('Location: view-category.php');
        exit();
    }
} else {
    $_SESSION['Message'] = 'Category ID is missing.';
    header('Location: view-category.php');
    exit();
}
?>
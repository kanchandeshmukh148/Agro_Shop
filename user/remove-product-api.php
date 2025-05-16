<?php
include('comfig.php');
if (isset($_POST["cartId"])) {

    $cartIDToDelete = $_POST['cartId'];


    // Prevent SQL injection
    // $cartIDToDelete = mysqli_real_escape_string($connect, $cartIDToDelete);

    // SQL query to delete the row
    $deleteQuery = "DELETE FROM cart WHERE CartID = $cartIDToDelete";

    // Execute the query
    $deleteResult = mysqli_query($connect, $deleteQuery);

    if ($deleteResult) {
        echo "Product REMOVED Successfully";
    } else {
        echo "Error : Product Not Able to REMOVE";
    }
}
?>
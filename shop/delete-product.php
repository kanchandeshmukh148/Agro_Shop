<?php
session_start();
include 'comfig.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $productId = $_GET['id'];

   

    // Fetch the product data to get the image URLs
    $result = $connect->query("SELECT * FROM product WHERE ProductID = $productId");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Decode the JSON string into a PHP array
        $imageArray = json_decode($row['ImageURL']);

        // Delete the product from the database
        $deleteResult = $connect->query("DELETE FROM product WHERE ProductID = $productId");

        if ($deleteResult) {
            // Delete the product images from the server
            foreach ($imageArray as $imageName) {
                $imagePath = '../upload/' . $imageName;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $_SESSION["Message"] = "Product deleted successfully.";
        } else {
            $_SESSION["Message"] = "Failed to delete the product. Please try again !!";
        }
    } else {
        $_SESSION["Message"] = "Product not found !!!";
    }

    // Close the connection
    $connect->close();
}

// Redirect to the view-all-product.php page
header("Location: view-product.php");
exit();
?>
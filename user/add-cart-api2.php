<?php
include('comfig.php'); // Include your database configuration file
session_start();
if (isset($_POST["productId"])) {
    // $productAId = $_POST['productAId'];
    $productId = $_POST['productId'];

    // Assuming you have a function to get the UserID based on the user's session
    $userId = $_SESSION['User-ID']; // Replace with your actual function

    // Check if the given product is the first product to add to the cart
    $cartCheckQuery = "SELECT COUNT(*) AS count FROM cart WHERE UserID = '$userId'";
    $cartCheckResult = mysqli_query($connect, $cartCheckQuery);

    if ($cartCheckResult) {
        $cartCheckRow = mysqli_fetch_assoc($cartCheckResult);
        $isFirstProduct = ($cartCheckRow['count'] == 0);
  
        $product = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM product WHERE ProductID = " . $productId ." LIMIT 1;"));

        if ($isFirstProduct) {
            // Add the given product to the cart
            $insertQuery = "INSERT INTO cart (UserID, ProductID , Price ) VALUES ('$userId', '$productId' , '".$product['Price']."')";
            $insertResult = mysqli_query($connect, $insertQuery);

            if ($insertResult) {
                echo "Product added to the cart successfully.";
            } else {
                echo "Error adding product to the cart.";
            }
        } else {
            // Verify if the existing product in the cart has the same shop as the given product
            $cartproduct = mysqli_fetch_assoc(mysqli_query($connect, "SELECT ProductID FROM cart ORDER BY CreatedAt ASC LIMIT 1;"));
            $shopAQuery = "SELECT ShopID FROM product WHERE ProductID = " . $cartproduct['ProductID'] . ";";
            $shopBQuery = "SELECT ShopID FROM product WHERE ProductID = '$productId'";

            $shopAResult = mysqli_query($connect, $shopAQuery);
            $shopBResult = mysqli_query($connect, $shopBQuery);

            if ($shopAResult && $shopBResult) {
                $shopA = mysqli_fetch_assoc($shopAResult);
                $shopB = mysqli_fetch_assoc($shopBResult);

                // Check if products are from the same shop
                if ($shopA['ShopID'] == $shopB['ShopID']) {
                    // Add the given product to the cart
                    $productEx = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM cart WHERE ProductID = " . $productId . " AND UserID = '" . $userId . "';"));

                    if ($productEx) {

                        // $updateQuery = "UPDATE cart SET Quantity = Quantity + 1 WHERE ProductID = '$productId' AND UserID = '$userId'";
                        // $updateResult = mysqli_query($connect, $updateQuery);

                        // if ($updateResult) {
                        //     echo "Quantity updated successfully.";
                        // } else {
                        //     echo "Error updating quantity.";
                        // }
                        echo "Product Has Already Exists in cart . ";
                    } else {
                        // Result is empty, do something else

                        $insertQuery = "INSERT INTO cart (UserID, ProductID , Price) VALUES ('$userId', '$productId', '".$product['Price']."')";
                        $insertResult = mysqli_query($connect, $insertQuery);

                        if ($insertResult) {
                            echo "Product added to the cart successfully.";
                        } else {
                            echo "Error adding product to the cart.";
                        }
                    }


                } else {
                    echo "You can only select products from the same shop.";
                }
            } else {
                echo "Error fetching shop information.";
            }
        }
    } else {
        echo "Error checking the cart.";
    }
} else {
    echo "Invalid parameters.";
}
?>
<?php
session_start();
include('comfig.php');

if (isset($_POST["products"])) {
    $productsJson = $_POST['products'];

    // Decode the JSON string into a PHP array
    $products = json_decode($productsJson, true);


    $checkDuplicateResult = mysqli_query($connect, "SELECT OrderID FROM ordertable WHERE UserID = " . $_SESSION['User-ID'] . " AND ShopID = " . $products[0]['ShopID']);

    if (false) {
        // Close the database connection
        // mysqli_num_rows($checkDuplicateResult) > 0
        // foreach ($products as $product) {
        //     // SQL query to delete the row
        //     $deleteQuery = "DELETE FROM cart WHERE CartID = " . $product['CartID'];
        //     // Execute the query
        //     $deleteResult = mysqli_query($connect, $deleteQuery);
        // }
        // Return an error message
        // echo "Order already exists With Same Shop !!";
        // mysqli_close($connect);
    } else {
        // Define the SQL query
        $sql = "INSERT INTO ordertable (UserID, ShopID) VALUES ( '" . $_SESSION['User-ID'] . "' ,'" . $products[0]['ShopID'] . "')";

        // Execute the query
        if (mysqli_query($connect, $sql)) {
            // Get the last inserted OrderID
            $OrderID = mysqli_insert_id($connect);


            // Loop through each product
            foreach ($products as $product) {
                $sql = "INSERT INTO orderdetails (OrderID , ProductID , Quantity , ProductPAT) VALUES ( '" . $OrderID . "' ,'" . $product['ProductID'] . "' ,'" . $product['Quantity'] . "' ,'" . $product['PriceAT'] . "')";

                // Execute the query
                if (mysqli_query($connect, $sql)) {
                    // SQL query to delete the row
                    $deleteQuery = "DELETE FROM cart WHERE CartID = " . $product['CartID'];

                    // Execute the query
                    $deleteResult = mysqli_query($connect, $deleteQuery);

                    $updateQuery = "UPDATE product SET StockQuantity = StockQuantity - ".$product['Quantity']." WHERE ProductID = ".$product['ProductID'].";";
                    $updateResult = mysqli_query($connect, $updateQuery);

                    if (($deleteResult)&& ($updateResult)) {
                        // echo 'Product added to order';
                    } else {

                        $D1 = mysqli_query($connect, "DELETE FROM orderdetails WHERE OrderID = " . $OrderID);
                        $D2 = mysqli_query($connect, "DELETE FROM ordertable WHERE OrderID = " . $OrderID);
                        if (($D1) && ($D2)) {
                            echo "Something want working with server";
                        } else {
                            echo "Something went wrong with the server while processing your order. Please note that your order may have been placed by default";
                        }

                    }

                }

            }
            echo "Order Place successfuly .";
        } else {
            // Close the database connection
            mysqli_close($connect);

            // Return an error message
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }

} else {
    // 'products' parameter not found in the POST request
    echo "No products data received";
}
?>
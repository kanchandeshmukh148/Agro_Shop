<?php
session_start();
include 'comfig.php';
function uploadImage($image, $destinationPath, $allowedTypes = ['jpg', 'jpeg', 'png'], $maxSize = 1000000, $redirectUrl = 'index.php?uploadsuccess')
{

    $fileName = $image['name'];
    $fileTmpName = $image['tmp_name'];
    $fileSize = $image['size'];
    $fileError = $image['error'];
    $fileType = $image['type'];

    if ($fileName != "") {
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowedTypes)) {
            if ($fileError === 0) {
                if ($fileSize < $maxSize) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = $destinationPath . '/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    // header("location: $redirectUrl");
                    return $fileNameNew;
                } else {
                    $_SESSION["Message"] = "Something want woring";
                    header("Location:$redirectUrl");
                    exit();
                }

                // Optionally, you can uncomment the following line to move the original file without cropping
                // move_uploaded_file($fileTmpName, $fileDestination);


            } else {
                $_SESSION["Message"] = "Cannot upload file. File size is too big!";
                header("Location:$redirectUrl");
                exit();
            }
        } else {
            $_SESSION["Message"] = "Invalid file type. Allowed types are " . implode(', ', $allowedTypes);
            header("Location: $redirectUrl");
            exit();
        }
    } else {
        $_SESSION["Message"] = "Something want woring";
        header("Location: $redirectUrl");
        exit();
    }
}







if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $imageURL= uploadImage($_FILES['image1'], '../upload', ['jpg', 'jpeg', 'png'], 1000000, 'add-product.php');
   

    // print_r($imageURL);
    // echo $imageURL;
    // Retrieve other form data
    $productName = $_POST["productName"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stockQuantity = $_POST["stockQuantity"];
    // $batchNumber = $_POST["batchNumber"];
    // $manufacturingDate = $_POST["manufacturingDate"];
    // $expiryDate = $_POST["expiryDate"];
    $categoryID = $_POST["category"];



    
        // $checkQuery = "SELECT * FROM product WHERE ProductName = '$productName'";
        // $result = $connect->query($checkQuery);
        // if ($result->num_rows > 0) {
        //     $_SESSION['Message'] = "Product Name Has Taken already exists!";
        //     echo "<script>"; // Start JavaScript block
        //     echo 'window.location.href="add-product.php";'; // Use JavaScript to change the page
        //     echo "</script>";
        // } else {

    // Insert into the database
    $sql = "INSERT INTO product (ProductName, Description, Price, StockQuantity, ImageURL, CategoryID , ShopID) 
            VALUES ('$productName', '$description', '$price', '$stockQuantity', '$imageURL', '$categoryID' ,'" . $_SESSION['ShopID'] . "')";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        // print_r($imageURL);
        // echo "Cannot upload file.";
        $_SESSION["Message"] = "Product added successfully!";
        header("Location: view-product.php");
    } else {
        // echo "Cannot upload file.";
        $_SESSION["Message"] = "Error: Failed to add the product. Please try again.";
        header("Location: view-product.php");
    }

    // Close the database connection
    // $categoriesQuery = mysqli_query($connect, "SELECT ImageURL FROM product");
    // while ($row = mysqli_fetch_assoc($categoriesQuery)) {
    //     print_r($row);
    //     echo "<br>";
    // }
    mysqli_close($connect);
}
?>
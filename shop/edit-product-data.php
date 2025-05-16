<?php
session_start();
include 'comfig.php';

function uploadImage($image, $destinationPath, $allowedTypes = ['jpg', 'jpeg', 'png'], $maxSize = 1000000, $redirectUrl = 'index.php?uploadsuccess', $oldImagePaths)
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
                    // Generate a unique filename
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = $destinationPath . '/' . $fileNameNew;

                    // Move the uploaded file to the destination
                    move_uploaded_file($fileTmpName, $fileDestination);

                    // Delete old images
                    foreach ($oldImagePaths as $oldImagePath) {
                        $fullOldImagePath = $destinationPath . '/' . $oldImagePath;
                        if (file_exists($fullOldImagePath)) {
                            unlink($fullOldImagePath);
                        }
                    }



                    $fullOldImagePath = $destinationPath . '/' . $oldImagePaths;
                    if (file_exists($fullOldImagePath)) {
                        unlink($fullOldImagePath);
                    }

                    return $fileNameNew;
                } else {
                    $_SESSION["Message"] = "Cannot upload file. File size is too big!";
                }
            } else {
                $_SESSION["Message"] = "Cannot upload file.";
            }
        } else {
            $_SESSION["Message"] = "Invalid file type. Allowed types are " . implode(', ', $allowedTypes);
        }
    } else {
        // $_SESSION["Message"] = "File is not selected.";
        return $oldImagePaths;
    }

    // If any errors occurred, redirect
    header("Location:$redirectUrl");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product ID from the session
    $productId = $_SESSION['productId'];


    $row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT ImageURL FROM product where ProductID = '$productId'"));
    print_r($row);
    echo json_decode($row['ImageURL']);

    $imageURL = uploadImage($_FILES['image'], '../upload', ['jpg', 'jpeg', 'png'], 1000000, 'edit-product.php?id=' . $productId, $_POST['hedden']);
    // Retrieve other form data
    $productName = $_POST["productName"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stockQuantity = $_POST["stockQuantity"];
    $batchNumber = $_POST["batchNumber"];
    $manufacturingDate = $_POST["manufacturingDate"];
    $expiryDate = $_POST["expiryDate"];
    $categoryID = $_POST["category"];


    // Update the product in the database
    $sql = "UPDATE product SET 
            ProductName = '$productName',
            Description = '$description',
            Price = '$price',
            StockQuantity = '$stockQuantity',
            ImageURL = '$imageURL',
            CategoryID = '$categoryID'
            WHERE ProductID = '$productId'";

    // $sql = "UPDATE product SET 
    //         ProductName = '$productName',
    //         Description = '$description',
    //         Price = '$price',
    //         StockQuantity = '$stockQuantity',
    //         ImageURL = '$imageURL',
    //         CategoryID = '$categoryID',
    //         Productstateus = 'novarify'
    //         WHERE ProductID = '$productId'";


    $result = mysqli_query($connect, $sql);

    if ($result) {
        $_SESSION["Message"] = "Product updated successfully!";
        header("Location: view-product.php");
    } else {
        $_SESSION["Message"] = "Failed to update the product. Please try again !!!";
        header("Location: edit-product.php?id=" . $productId);
    }

    // Close the database connection
    mysqli_close($connect);
}
?>
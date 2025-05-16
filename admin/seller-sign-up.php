<?php
session_start();
include 'comfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    // extract($_POST);
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $aadhaar = $_POST["aadhaar"];
    $addres = $_POST["addres"];
    $password = $_POST["password"];
    $gst = $_POST["gst"];
    $owner = $_POST["owner"];

    echo $name, $email, $number, $aadhaar, $addres, $password;
    // Hash the password (for security)
    $hashedPassword = $password;
    // Check if email already exists 

    $count1 = mysqli_fetch_row(mysqli_query($connect, "SELECT COUNT(*) FROM shop WHERE ShopEmail = '$email' "));

    $count2 = mysqli_fetch_row(mysqli_query($connect, "SELECT COUNT(*) FROM shop WHERE AadhaarCardNumber = '$aadhaar' "));

    $count3 = mysqli_fetch_row(mysqli_query($connect, "SELECT COUNT(*) FROM shop WHERE ShopGSTNumber  = '$gst' "));

    if ($count1[0] > 0) {
        // Email already exists, handle the error
        $_SESSION["Message"] = "Error: Email is already registered.";
        header("Location: sign-up.php");
        exit();
    } elseif ($count2[0] > 0) {
        $_SESSION["Message"] = "Error: Aadhaar-Card-Number is already registered.";
        header("Location: sign-up.php");
        exit();
    } elseif ($count3[0] > 0) {
        $_SESSION["Message"] = "Error: GST-Number is already registered.";
        header("Location: sign-up.php");
        exit();
    } else {

        // Insert into the database
        $sql = "INSERT INTO shop (ShopName, ShopEmail, ShopPhone , AadhaarCardNumber , ShopAddress , Shoppassword , ShopGSTNumber , ShopOwnerName ) VALUES ('" . $name . "', '$email', '$number' , '$aadhaar' , '$addres' , '$hashedPassword' , '$gst' , '$owner' )";
        $con = mysqli_query($connect, $sql);
        exit();
        // echo $con ;
        if ($con) {
            $_SESSION["Message"] = "Account created successful!";
            header("Location: login.php");
            mysqli_close($connect);

            exit();

        } else {
            $_SESSION["Message"] = "Error: Account has not created something went wrong, try again";
            header("Location: sign-up.php");
            mysqli_close($connect);

            exit();
        }

        // Close the database connection
        // mysqli_close($connect);
    }
}
?>
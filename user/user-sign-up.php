<?php
session_start();
include 'comfig.php'; // Assuming 'config.php' contains your database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $addres = $_POST["addres"];
    $password = $_POST["password"];
    // $owner = $_POST["owner"];

    // Hash the password (for security)
    $hashedPassword = $password;

    // Check if email already exists
    $count1 = mysqli_fetch_row(mysqli_query($connect, "SELECT COUNT(*) FROM userdata WHERE EmailID = '$email' "));

    if ($count1[0] > 0) {
        // Email already exists, handle the error
        $_SESSION["Message"] = "Email is already in use.";
        header("Location: sign-up.php");
        exit();
    } else {
        // Insert into the database
        $sql = "INSERT INTO userdata (FullName, EmailID, PhoneNumber, Address, Password) 
                VALUES ('$name', '$email', '$number', '$addres', '$hashedPassword')";

        $result = mysqli_query($connect, $sql);

        if ($result) {

            $row = mysqli_fetch_row(mysqli_query($connect, "SELECT * FROM userdata WHERE EmailID = '$email' "));
            $_SESSION["User-Name"] = $row['FullName'];
            $_SESSION["User-Email"] = $row['EmailID'];
            $_SESSION["User-ID"] = $row['UserID'];
            $_SESSION["Message"] = "Account created successfully!";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION["Message"] = "Error: Account was not created. Please try again.";
            header("Location: sign-up.php");
            exit();
        }
    }
}
?>
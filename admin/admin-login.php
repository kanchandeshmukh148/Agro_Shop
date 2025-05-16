<?php
include 'comfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve login data
    // $email = $_POST["email"];
    // $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM admins WHERE email = '" . $_POST["email"] . "'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        // $hashedPassword = $row["Password"];

        if ($row["password"] == $_POST["password"]) {
            // Password is correct, log in the user
           
            $_SESSION["AdminID"] = $row["id"];
            $_SESSION["AdminEmail"] = $row["email"];
            $_SESSION["AdminName"] = $row["username"];
            $_SESSION["Message"] = "Login successful! Welcome, " . $row["username"];
            header("Location: index.php");
            exit();
        } else {
            
            $_SESSION["Message"] = "Incorrect password";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION["Message"] = "User not found. Please check your email address.";
        header("Location: login.php");
        exit();
    }

    $connect->close();
}

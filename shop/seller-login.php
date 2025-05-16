<?php
include 'comfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve login data
    // $email = $_POST["email"];
    // $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM shop WHERE ShopEmail = '" . $_POST["email"] . "'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        // $hashedPassword = $row["Password"];
// echo $row["sellerpassword"] , $_POST["password"] ;
        if (($row["Shoppassword"] == $_POST["password"])) {
            // Password is correct, log in the user

            if ($row["Shopstatus"] == 'varify') {
                $_SESSION["ShopID"] = $row["ShopID"];
                $_SESSION["Owner"] = $row["ShopOwnerName"];
                $_SESSION["ShopEmail"] = $row["ShopEmail"];
                $_SESSION["Message"] = "Login successful! Welcome, " . $row["username"];
                header("Location: index.php");
                $connect->close();
                exit();
            } else {
                $_SESSION["Message"] = "Your Not Approved By Admin Yet";
                header("Location: login.php");
                $connect->close();
                exit();
            }
        } else {

            $_SESSION["Message"] = "Incorrect password";
            header("Location: login.php");
            $connect->close();
            exit();
        }
    } else {
        $_SESSION["Message"] = "User not found. Please check your email address.";
        header("Location: login.php");
        $connect->close();
        exit();
    }


}

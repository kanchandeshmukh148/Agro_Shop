<?php
include 'comfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve user data from the database
    $sql = "SELECT * FROM userdata WHERE EmailID = '" . $_POST["email"] . "'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();

        if (($row["Password"] == $_POST["password"])) {
            // Password is correct, log in the user


            $_SESSION["User-Name"] = $row['FullName'];
            $_SESSION["User-Email"] = $row['EmailID'];
            $_SESSION["User-ID"] = $row['UserID'];
            $_SESSION["Message"] = "Login successful! Welcome, " . $row["username"];
            header("Location: index.php");
            $connect->close();
            exit();


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

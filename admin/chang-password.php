<?php
session_start();

include 'comfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $_SESSION['Message'] = 'All fields are required.';
    } else {
        $databasepassword = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `admins` WHERE 1"));
        // echo $databasepassword;
        if ($databasepassword['password'] == $oldPassword) {
            if ($newPassword !== $confirmPassword) {
                $_SESSION['Message'] = 'New password and confirm password should be same.';
            } else {


                // In this example, assuming Password is the column where you store the plaintext passwords (not recommended)
                $updateQuery = "UPDATE `admins` SET `password` = '$newPassword' WHERE `id` = 1";

                if (mysqli_query($connect, $updateQuery)) {
                    $_SESSION['Message'] = 'Password Change successfully.';
                    header('Location: login.php');
                    exit();
                } else {
                    $_SESSION['Message'] = 'Error updating password.';
                }
            }

            header('Location: index.php');
            exit();
        } else {

            $_SESSION['Message'] = 'Current Password is Wrong.';
            // $_SESSION['Message'] = $databasepassword['Shoppassword'];

            header('Location: index.php');
            exit();
        }
    }
}
// $_SESSION['Message'] = 'hello wold';
header('Location: index.php');
exit();
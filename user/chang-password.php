<?php
session_start();

include 'comfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $userId = $_SESSION['User-ID'];

    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $_SESSION['Message'] = 'All fields are required.';
    } else {
        $databasepassword = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM userdata WHERE `UserID` = $userId"));
        // echo $databasepassword;
        if ($databasepassword['Password'] == $oldPassword) {
            if ($newPassword !== $confirmPassword) {
                $_SESSION['Message'] = 'New password and confirm password should be same.';
            } else {


                // In this example, assuming Password is the column where you store the plaintext passwords (not recommended)
                $updateQuery = "UPDATE `userdata` SET `Password` = '$newPassword' WHERE `UserID` = $userId";

                if (mysqli_query($connect, $updateQuery)) {
                    $_SESSION = array();
                    $_SESSION['Message'] = 'Password Change  successfully.';
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
            // $_SESSION['Message'] = $databasepassword['Password'];

            header('Location: index.php');
            exit();
        }
    }
}

header('Location: index.php');
exit();
?>
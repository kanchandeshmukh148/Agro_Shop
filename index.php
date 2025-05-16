<?php
session_start();
include 'message.php'
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Centered Buttons</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .btn-group {
            text-align: center;
        }

        .warpper div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .warpper div a {
            margin-top: 50px;

        }

        .warpper div div {
            bottom: -80px;
        }
    </style>
</head>

<body class=" container ">
    <div class="container">
        <div class=" d-flex justify-content-around gap-5 warpper">
            <div class="col-3 ">
                <img src="man.png" width="100%" alt="">
                <a href="./admin/index.php" class="btn btn-primary">Admin</a>
                <div class=" position-absolute ">
                    <p>
                        ID: admin@gmail.com <br>
                        Pass: admin
                    </p>
                </div>
            </div>
            <div class="col-3 ">
                <img src="woman.png" width="100%" alt="">
                <a href="./shop/index.php" class="btn btn-secondary">Shop</a>

            </div>
            <div class="col-3 ">
                <img src="avatar.png" width="100%" alt="">
                <div class=" d-flex flex-row w-100 justify-content-around ">
                    <a href="./user/index.php" class="btn btn-success">View</a>
                    <a href="./user/login.php" class="btn btn-success">Login</a>

                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"
        integrity="sha384-R9XgRDT7i6aC4kf2eeTpjNLra65Tl0Uk0hAN2egqFq4jH4rVoMkoj10BB6h5eA0F"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
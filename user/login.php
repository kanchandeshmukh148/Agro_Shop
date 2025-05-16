<?php
session_start();
include 'message.php';
// include 'verify.php';
?>
<!doctype html>
<html class="no-js" lang="en">

<head>

    <?php include 'header.php' ?>

</head>

<body>

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Sign in</h1>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                            </div>

                            <div class="login-register-form">
                                <form action="user-login.php" method="POST">
                                    <div class="row">
                                        <div class="col-12 mb-20"><input class="form-control" type="email"
                                                placeholder=" Email ID" required="" name="email"></div>
                                        <div class="col-12 mb-20"><input class="form-control" type="password"
                                                placeholder="Password" required="Enter Password" name="password"></div>
                                        <!-- <div class="col-12 mb-20"><label for="remember" class="adomx-checkbox-2"><input id="remember" type="checkbox"><i class="icon"></i>Remember.</label></div> -->
                                        <div class="col-12">
                                            <!-- <div class="row justify-content-between">

                                                <div class="col-auto mb-15">Dont have account? <a href="register.html">Create Now.</a></div>
                                            </div> -->
                                        </div>
                                        <div class="col-12 mt-10 d-flex justify-content-between ">
                                            <button class="button button-primary button-outline">Log in
                                                <b>></b></button>
                                            <a href="../index.php" class="btn">Menu</a>
                                            <a href="sign-up.php" class="btn">Sign Up There > > ></a>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12" style="height: auto;">
                        <div class="content">
                            <h1>Sign in</h1>
                            <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'footer.php' ?>
        </div><!-- Content Body End -->

    </div>

    <!-- JS
============================================ -->

    <?php include 'js-links.php' ?>

</body>

</html>
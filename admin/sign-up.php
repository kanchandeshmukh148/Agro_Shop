<?php
session_start();
include 'message.php';
include 'comfig.php';
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
                                <h1>Sign-Up</h1>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                            </div>

                            <div class="login-register-form">
                                <form action="seller-sign-up.php" method="POST">
                                    <div class="row">
                                        <div class="col-12 mb-20"><input class="form-control" type="text"
                                                placeholder="Owner Name" required="" name="owner"></div>
                                        <div class="col-12 mb-20"><input class="form-control" type="text"
                                                placeholder="Shop Name" required="" name="name"></div>
                                        <div class="col-12 mb-20"><input class="form-control" type="email"
                                                placeholder=" Email ID" required="" name="email"></div>
                                        <div class="col-12 mb-20"><input class="form-control" type="text"
                                                placeholder="Phone Number" required="" name="number"></div>
                                        <div class="col-12 mb-20"><input class="form-control" type="number"
                                                placeholder=" Aadhaar Card Number " required="" name="aadhaar"></div>
                                        <div class="col-12 mb-20"><input class="form-control" type="text"
                                                placeholder="Enter Shop GST Number " required="" name="gst"></div>
                                        <div class="col-12 mb-20">
                                            <?php
                                            // Fetch all areas
                                            $areaQuery = "SELECT
                            a.`area-id`,
                            a.`state-id`,
                            a.`city-id`,
                            a.`area-name`,
                            c.`city-name`,
                            s.`state-name`
                        FROM
                            area a
                            JOIN city c ON a.`city-id` = c.`city-id`
                            JOIN state s ON a.`state-id` = s.`state-id`;";
                                            $areaResult = mysqli_query($connect, $areaQuery);
                                            $Query3 = mysqli_query($connect, $areaQuery);
                                            ?>
                                            <select class="form-control" id="location" name="location">
                                                <option value="0">None</option>
                                                <?php
                                                while($row = mysqli_fetch_assoc($Query3)) {
                                                    ?>
                                                    <option value="<?php echo $row['area-id'] ?>">
                                                        <?php echo $row['state-name'].' '.$row['city-name'].''.$row['area-name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-20"><input class="form-control" type="password"
                                                placeholder="Password" required="Enter Password" name="password"></div>
                                        <div class="col-12">

                                        </div>
                                        <div class="col-12 mt-10 d-flex justify-content-between">
                                            <button class="button button-primary button-outline">Sign Up
                                                <b>></b></button>
                                            <a href="login.php">Log in There > > ></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12" style="height: auto;">
                        <div class="content">
                            <h1>Sign in</h1>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!--  -->
            <?php include 'footer.php' ?>
        </div><!-- Content Body End -->

    </div>

    <!-- JS
============================================ -->

    <?php include 'js-links.php' ?>

</body>

</html>
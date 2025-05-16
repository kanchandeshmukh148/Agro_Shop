<?php include 'verify.php' ?>
<?php include 'message.php' ?>
<?php 
// session_start();
include 'comfig.php'?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'header.php' ?>

</head>

<body>

    <div class="main-wrapper" style="background-color: #fff;">


        <!-- Header Section Start -->
        <?php include 'navbar.php' ?>
        <!-- Header Section End -->
        <!-- Side Header Start -->
        <?php include 'sidebar.php' ?>
        <!-- Side Header End -->

        <!-- Content Body Start -->
        <div class="content-body">

            <!-- Page Headings Start -->
            <div class="row justify-content-between align-items-center mb-10">

                <!-- Page Heading Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3 class="title"> Dashboard</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->
            <div class="row mbn-30">
                <div class="w-100 m-3 ">
                    <h3>Product</h3>
                </div>

                <?php
                $query = "SELECT COUNT(*) AS productCount FROM product where ShopID = " . $_SESSION["ShopID"] . "   ;";
                $result = $connect->query($query);
                $row = $result->fetch_assoc();
                ?>
                <!-- Top Report Start -->
                <div class="col-xlg-3 col-md-6 col-12 mb-30">
                    <div class="top-report">
                        <a href="view-product.php" class="">
                            <!-- Head -->
                            <div class="head">
                                <h4>Product </h4>
                                <a href="view-product.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                            </div>

                            <!-- Content -->
                            <div class="content">
                                <!-- <h5>Product</h5> -->
                                <h2>
                                    <?php echo !empty($row['productCount']) ? $row['productCount'] : 0 ?>
                                </h2>
                            </div>
                        </a>
                    </div>
                </div>


                <?php
                $query = "SELECT COUNT(*) AS productCount FROM product where ShopID = " . $_SESSION["ShopID"] . " AND  Productstateus = 'varify'  ;";
                $result = $connect->query($query);
                $row = $result->fetch_assoc();
                ?>
                <!-- Top Report Start -->
                <div class="col-xlg-3 col-md-6 col-12 mb-30">
                    <div class="top-report">
                        <a href="varifyed-product.php" class="">
                            <!-- Head -->
                            <div class="head">
                                <h4>Approved </h4>
                                <a href="varifyed-product.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                            </div>

                            <!-- Content -->
                            <div class="content">
                                <!-- <h5>Product</h5> -->
                                <h2>
                                    <?php echo !empty($row['productCount']) ? $row['productCount'] : 0 ?>
                                </h2>
                            </div>
                        </a>
                    </div>
                </div>


                <?php
                $query = "SELECT COUNT(*) AS productCount FROM product where ShopID = " . $_SESSION["ShopID"] . " AND Productstateus = 'blocked' ";
                $result = $connect->query($query);
                $row = $result->fetch_assoc();
                ?>
                <!-- Top Report Start -->
                <div class="col-xlg-3 col-md-6 col-12 mb-30">
                    <div class="top-report">
                        <a href="blocked-product.php" class="">
                            <!-- Head -->
                            <div class="head">
                                <h4>Disapproved</h4>
                                <a href="blocked-product.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                            </div>

                            <!-- Content -->
                            <div class="content">
                                <!-- <h5>Product</h5> -->
                                <h2>
                                    <?php echo !empty($row['productCount']) ? $row['productCount'] : 0 ?>
                                </h2>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
        </div>


    </div><!-- Content Body End -->

    <!-- Footer Section Start -->
    <?php include 'footer.php' ?>
    <!-- Footer Section End -->

    </div>

    <!-- JS
============================================ -->

    <?php include 'js-links.php' ?>

</body>

</html>
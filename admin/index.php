<?php include 'verify.php' ?>
<?php include 'message.php' ?>
<?php include 'comfig.php' ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'header.php' ?>

</head>

<body>

    <div class="main-wrapper">


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
                        <h3 class="title">Dashboard</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div>
                <div class="row mbn-30 m-3 ">

                    <div class="w-100 m-3 ">
                        <h3>Shop</h3>
                    </div>
                    <?php
                    $query = "SELECT COUNT(*) AS shopCount FROM shop WHERE Shopstatus = 'novarify' ;";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <!-- Top Report Start -->
                    <div class="col-xlg-3 col-md-6 col-12 mb-30">
                        <div class="top-report">
                            <a href="shop-varify.php" class="">
                                <!-- Head -->
                                <div class="head">
                                    <h4>Registered </h4>
                                    <a href="shop-varify.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                                </div>

                                <!-- Content -->
                                <div class="content">
                                    <!-- <h5>Shop</h5> -->
                                    <h2>
                                        <?= $row['shopCount'] ?>
                                    </h2>
                                </div>
                            </a>


                        </div>
                    </div><!-- Top Report End -->

                    <?php
                    $query = "SELECT COUNT(*) AS shopCount FROM shop WHERE Shopstatus = 'varify' ;";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <!-- Top Report Start -->
                    <div class="col-xlg-3 col-md-6 col-12 mb-30">
                        <div class="top-report">
                            <a href="varify-shop.php" class="">
                                <!-- Head -->
                                <div class="head">
                                    <h4>Approved </h4>
                                    <a href="varify-shop.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                                </div>

                                <!-- Content -->
                                <div class="content">
                                    <!-- <h5>Shop</h5> -->
                                    <h2>
                                        <?= $row['shopCount'] ?>
                                    </h2>
                                </div>
                            </a>


                        </div>
                    </div><!-- Top Report End -->


                    <?php
                    $query = "SELECT COUNT(*) AS shopCount FROM shop WHERE Shopstatus = 'blocked' ;";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <!-- Top Report Start -->
                    <div class="col-xlg-3 col-md-6 col-12 mb-30">
                        <div class="top-report">
                            <a href="blocked-shop.php" class="">
                                <!-- Head -->
                                <div class="head">
                                    <h4>Disapproved</h4>
                                    <a href="blocked-shop.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                                </div>

                                <!-- Content -->
                                <div class="content">
                                    <!-- <h5>Shop</h5> -->
                                    <h2>
                                        <?= $row['shopCount'] ?>
                                    </h2>
                                </div>
                            </a>


                        </div>
                    </div><!-- Top Report End -->

                </div>
                <div class="row mbn-30 m-4">
                    <div class="w-100 m-3 ">
                        <h3>Product</h3>
                    </div>
                    <?php
                    $query = "SELECT COUNT(*) AS productCount FROM product WHERE Productstateus = 'novarify'";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <!-- Top Report Start -->
                    <div class="col-xlg-3 col-md-6 col-12 mb-30">
                        <div class="top-report">
                            <a href="varify-product.php" class="">
                                <!-- Head -->
                                <div class="head">
                                    <h4>Registered </h4>
                                    <a href="varify-product.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                                </div>

                                <!-- Content -->
                                <div class="content">
                                    <!-- <h5>Product</h5> -->
                                    <h2>
                                        <?= $row['productCount'] ?>
                                    </h2>
                                </div>
                            </a>


                        </div>
                    </div><!-- Top Report End -->

                    <?php
                    $query = "SELECT COUNT(*) AS productCount FROM product WHERE Productstateus = 'varify'";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <!-- Top Report Start -->
                    <div class="col-xlg-3 col-md-6 col-12 mb-30">
                        <div class="top-report">
                            <a href="varifyed-product.php" class="">
                                <!-- Head -->
                                <div class="head">
                                    <h4>Approved</h4>
                                    <a href="varifyed-product.php" class="view"><i class="zmdi zmdi-eye"></i></a>
                                </div>

                                <!-- Content -->
                                <div class="content">
                                    <!-- <h5>Product</h5> -->
                                    <h2>
                                        <?= $row['productCount'] ?>
                                    </h2>
                                </div>
                            </a>


                        </div>
                    </div><!-- Top Report End -->


                    <?php
                    $query = "SELECT COUNT(*) AS productCount FROM product  WHERE Productstateus = 'blocked'";
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
                                        <?= $row['productCount'] ?>
                                    </h2>
                                </div>
                            </a>


                        </div>
                    </div><!-- Top Report End -->


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
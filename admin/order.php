<?php include 'verify.php' ?>
<?php include 'message.php' ?>
<?php include 'comfig.php' ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'header.php' ?>
    <style>
        tr td {
            text-align: center;
        }
    </style>
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
                        <h3 class="title">Order </h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->
            <form id="filterForm" method="POST" action="">
                <!-- Add method and action attributes to the form for it to work properly -->
                <div class="row">


                    <!-- Shop Filter -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shop">Shop:</label>
                            <?php
                            $Query2 = mysqli_query($connect, "SELECT ShopID , ShopName FROM `shop` WHERE Shopstatus = 'varify'");
                            ?>
                            <select class="form-control" id="shop" name="shop">
                                <option value="0">None</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($Query2)) {
                                    ?>

                                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
                                        <option value="<?php echo $row['ShopID'] ?>" <?php echo ($row['ShopID'] == $_POST['shop']) ? "selected" : ""; ?>>
                                            <?php echo $row['ShopName'] ?>
                                        </option>

                                    <?php } else { ?>
                                        <option value="<?php echo $row['ShopID'] ?>">
                                            <?php echo $row['ShopName'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label for="location">Location:</label>
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

                            while ($row = mysqli_fetch_assoc($Query3)) {
                                ?>

                                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
                                    <option value="<?php echo $row['area-id'] ?>" <?php echo ($row['area-id'] == $_POST['location']) ? "selected" : ""; ?>>
                                        <?php echo $row['state-name'] . ' , ' . $row['city-name'] . ' , ' . $row['area-name'] ?>
                                    </option>

                                <?php } else { ?>
                                    <option value="<?php echo $row['area-id'] ?>">
                                        <?php echo $row['state-name'] . ' , ' . $row['city-name'] . ' , ' . $row['area-name'] ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div> -->
                </div>

                <!-- Filter Button -->
                <div class="form-group m-3 ">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
                <table class="table table-vertical-middle">
                    <thead>
                        <tr>
                            <th class=" text-center ">Sr No</th>
                            <th class=" text-center ">Order ID</th>
                            <th class=" text-center ">Shop Name</th>
                            <th class=" text-center ">User Name</th>
                            <th class=" text-center ">Order Date</th>
                            <th class=" text-center ">Totle Price &#8377;</th>
                            <th class=" text-center ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get the selected values from the form
                        $selectedShop = $_POST['shop'];

                        // SQL query to fetch products based on selected filters
                        $query = "SELECT ot.OrderID , ud.FullName , s.ShopName , ot.OrderDate   FROM ordertable ot JOIN userdata ud ON ot.UserID = ud.UserID JOIN shop s ON ot.ShopID = s.ShopID ";


                        if ($selectedShop != '0') {
                            $query .= "WHERE ot.ShopID = $selectedShop";
                        }

                        $result = $connect->query($query);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo ++$count ?>
                                    </td>
                                    <td>
                                        <?php echo $count . rand(100, 999) . $row['OrderID']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ShopName']; ?>
                                    </td>

                                    <td>
                                        <?php echo $row['FullName']; ?>
                                    </td>

                                    <td>
                                        <?php $dateTime = new DateTime($row['OrderDate']); ?>
                                        <?php echo $dateTime->format('Y-m-d'); ?>
                                    </td>
                                    <?php
                                    $totle = mysqli_fetch_assoc(mysqli_query($connect, "SELECT SUM(Quantity * ProductPAT) AS TotalPrice  FROM OrderDetails  WHERE OrderID = " . $row['OrderID'] . ";"));
                                    ?>
                                    <td>
                                        <?php echo $totle['TotalPrice']; ?>
                                    </td>

                                    <td class="" style="  ">
                                        <a href="view-order-details.php?id=<?php echo $row['OrderID']; ?>" type="button"
                                            class="btn btn-primary">View Details</a>
                                    </td>

                                </tr>
                                <?php
                            }
                        } else {
                            // echo "0 results";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
            <div>

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
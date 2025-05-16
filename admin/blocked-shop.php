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
                        <h3 class="title">Disapproved Shop</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-vertical-middle">
                        <thead>
                            <tr>
                                <th>SR NO</th>
                                <th>Name</th>
                                <th>Owner Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <!-- <th>Stateus</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming you have a connection to the database
                            

                            // Fetch products from the database
                            $result = $connect->query("SELECT * FROM shop WHERE Shopstatus = 'blocked'");
                            $count = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <form>
                                        <tr>
                                            <td>
                                                <?php echo ++$count; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ShopName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ShopOwnerName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ShopEmail']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ShopPhone']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                include 'comfig.php'; // Include your database configuration
                                        
                                                // Assuming `ShopAddress` contains the `area-id`
                                                $areaId = $row['ShopAddress'];

                                                // Fetch additional information about the shop's address
                                                $areaQuery = "SELECT
        a.`area-id`,
        a.`state-id`,
        a.`city-id`,
        a.`area-name`,
        a.`area-address`,
        c.`city-name`,
        s.`state-name`
    FROM
        area a
    JOIN
        city c ON a.`city-id` = c.`city-id`
    JOIN
        state s ON a.`state-id` = s.`state-id`
    WHERE a.`area-id` = $areaId";

                                                $areaResult = mysqli_query($connect, $areaQuery);

                                                // Check if the query was successful
                                                if ($areaResult) {
                                                    $areaRow = mysqli_fetch_assoc($areaResult);

                                                    // Check if $areaRow is not null before accessing its elements
                                                    if ($areaRow) {
                                                        echo $areaRow['area-name'] . ', '  . $areaRow['city-name'] . ', ' . $areaRow['state-name'];
                                                    } else {
                                                        echo 'NAN';
                                                    }
                                                } else {
                                                    echo 'NAN';
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <div>
                                                    <a class="btn btn-primary "
                                                        href="shop-status-varify.php?id=<?php echo $row['ShopID'] ?>">Approve</a>
                                                </div>
                                            </td>

                                        </tr>
                                        <form>
                                            <?php
                                }
                            } else {
                                // echo "0 results";
                            }

                            // Close the connection
                            $connect->close();
                            ?>
                        </tbody>
                    </table>
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
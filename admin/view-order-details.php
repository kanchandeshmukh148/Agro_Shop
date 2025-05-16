<?php include 'verify.php' ?>
<?php include 'message.php' ?>
<?php include 'comfig.php' ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'header.php' ?>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        table {
            background-color: #fff;
        }

        th,
        td {
            text-align: center;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }

        .quantity-input {
            width: 70px;
        }

        .checkout-button {
            background-color: #007bff;
            color: #fff;
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
                        <h3 class="title">Order <span></span></h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->
            <?php if (isset($_GET['id'])) { ?>
                <div>
                    <div class="container">
                        <div class=" d-flex justify-content-between">
                            <h1>Order Details</h1>
                            <?php $data = mysqli_fetch_assoc(mysqli_query($connect, "SELECT s.ShopName, u.FullName FROM ordertable o JOIN shop s ON o.ShopID = s.ShopID JOIN userdata u ON o.UserID = u.UserID WHERE o.OrderID = " . $_GET['id'])) ?>
                            <div>
                                <h4>Shop :
                                    <?php echo $data['ShopName'] ?>
                                </h4>
                                <h4>User :
                                    <?php echo $data['FullName'] ?>
                                </h4>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Sr NO</th>
                                    <th class="text-center">image</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Product Price</th>
                                    <th class="text-center">Product Quantity</th>
                                    <th class="text-center">Product Total</th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch order details from the database
                                $orderId = isset($_GET['id']) ? $_GET['id'] : 0;
                                $query = "SELECT p.ProductName, p.ImageURL , p.ProductID, od.Quantity, od.ProductPAT FROM orderdetails od JOIN product p ON od.ProductID = p.ProductID WHERE od.OrderID = $orderId;";

                                // Execute the query
                                $result = mysqli_query($connect, $query);

                                // Check if there are results
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $count = 1;
                                    $sum = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $sum = $sum + ($row['Quantity'] * $row['ProductPAT']);
                                        ?>
                                        <tr class="align-content-center">
                                            <td class="align-middle">
                                                <?php echo $count++; ?>
                                            </td>
                                            <td><img src="../upload/<?php echo $row['ImageURL']; ?>" alt="Product Image"></td>
                                            <td class="align-middle">
                                                <?php echo $row['ProductName']; ?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $row['ProductPAT']; ?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $row['Quantity']; ?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo $row['Quantity'] * $row['ProductPAT']; ?>
                                            </td>
                                            <!-- Add action button if needed -->
                                            <!-- <td class="align-middle">
                                <button type="button" class="btn btn-primary"
                                    onclick="remove(<?php echo $row['OrderID']; ?>)">View Order</button>
                            </td> -->
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    // Handle case when there are no order details
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Order details are empty.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <p>Subtotal: <span id="subtotal">
                                    <?php echo $sum ?>
                                </span></p>

                        </div>
                    </div>

                </div>
            <?php } ?>

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
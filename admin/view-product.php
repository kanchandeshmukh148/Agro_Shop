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
                        <h3 class="title">All Products</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-vertical-middle">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Photo</th>
                                <th>Product Name</th>
                                <th>Price</th>

                                <th>In Stock</th>
                                <th>Date</th>
                                <th>ON /OFF</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming you have a connection to the database
                            

                            // Fetch products from the database
                            $result = $connect->query("SELECT * FROM product ;");
                            $count = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$count; ?>
                                        </td>
                                        <td><img src="../upload/<?php echo $row['ImageURL']; ?>"
                                                style="object-fit: cover; height: 50px; width: 50px;" alt="Product Image"
                                                class="product-image rounded-circle"></td>
                                        <td><a href="#">
                                                <?php echo $row['ProductName']; ?>
                                            </a></td>
                                        <td>
                                            <?php echo '$' . $row['Price']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['StockQuantity']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CreatedAt']; ?>
                                        </td>

                                        <td>
                                            <?php $Row1 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM category WHERE CategoryID = '" . $row['CategoryID'] . "' ;")) ?>
                                            <?php $Row1['CategoryName'] ?>
                                        </td>
                                        <!-- <td><span class="badge badge-danger">Out of stock</span></td> -->

                                        <td>

                                            <?php
                                            // echo $row['Shopstatus'] ;
                                            if ($row['Productstateus'] == "novarify") {
                                                ?>
                                                <div>
                                                    <a class="btn btn-danger " href="varify-product.php">
                                                        <?php echo $row['Productstateus'] ?>
                                                    </a>
                                                </div>
                                                <?php
                                            } elseif ($row['Productstateus'] == "varify") {
                                                ?>
                                                <div>
                                                    <a class="btn btn-primary " href="varifyed-product.php">
                                                        <?php echo $row['Productstateus'] ?>
                                                    </a>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div>
                                                    <a class="btn btn-danger " href="blocked-product.php">
                                                        <?php echo $row['Productstateus'] ?>
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                            ?>


                                        </td>

                                    </tr>
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

    <script>
        $('#exampleModal5').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
</body>

</html>
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
                        <h3 class="title">Approved Products</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-vertical-middle">
                        <thead>
                            <tr>
                                                            <th>SR NO</th>

                                <th>Category</th>
                                <th>Shop / Owner</th>
                                <th>Photo</th>
                                <th>Product Name</th>
                                <th>Price &#8377;</th>
                                <th>In Stock</th>


                                <th>Date</th>
                                <!-- <th>Status</th> -->
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming you have a connection to the database
                            

                            // Fetch products from the database
                            $result = $connect->query("SELECT * FROM product WHERE Productstateus = 'varify' ;");
                            $count = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                 <tr>
                                        <td>
                                        <?php echo ++$count; ?>
                                            </td>
                                
                                            <td>
                                                <?php $Row1 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM category WHERE CategoryID = '" . $row['CategoryID'] . "' ;")) ?>
                                                <?php echo $Row1['CategoryName'] ?>
                                            </td>
                                            <td>
                                                <?php $Row2 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM shop WHERE ShopID = '" . $row['ShopID'] . "' ;")) ?>
                                                <?php echo $Row2['ShopName'] . " / " . $Row2['ShopOwnerName'] ?>
                                            </td>
                                
                                            <td><img src="../upload/<?php echo $row['ImageURL']; ?>" style="object-fit: cover; height: 50px; width: 50px;"
                                                    alt="Product Image" class="product-image rounded-circle"></td>
                                            <td>
                                
                                                <?php echo $row['ProductName']; ?>
                                
                                            </td>
                                            <td>
                                                <?php echo $row['Price']; ?>
                                            </td>
                                
                                            <td>
                                                <?php echo $row['StockQuantity']; ?>
                                            </td>
                                
                                            <td>
                                                <?php echo $row['CreatedAt']; ?>
                                            </td>
                                            <!-- <td><span class="badge badge-danger">Out of stock</span></td> -->
                                
                                            <td class="  ">
                                                <!-- <div class=" d-inline ">
                                                    <a class="btn btn-primary " href="product-status-varify.php?id3=<?php echo $row['ProductID'] ?>">Approve</a>
                                                </div> -->
                                
                                
                                                <div class=" d-inline ">
                                                    <a class="btn btn-danger "
                                                        href="product-status-varify.php?id2=<?php echo $row['ProductID'] ?>">disapprove</a>
                                                </div>
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
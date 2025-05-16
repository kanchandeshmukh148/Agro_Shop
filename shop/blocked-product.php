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
                        <h3 class="title">Disapproved Products</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-vertical-middle">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Category</th>

                                <th>Photo</th>
                                <th>Name</th>
                                <th>Price &#8377;</th>
                                <th>In Stock</th>

                                <th>Date</th>
                                <!-- <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming you have a connection to the database
                            

                            // Fetch products from the database
                            $result = $connect->query("SELECT * FROM product WHERE ShopID = " . $_SESSION['ShopID'] . " AND Productstateus = 'blocked'");

                            if ($result->num_rows > 0) {
                                $count = 0;
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
                                        <td><img src="../upload/<?php echo $row['ImageURL']; ?>"
                                                style="object-fit: cover; height: 50px; width: 50px;" alt="Product Image"
                                                class="product-image rounded-circle"></td>
                                        <td><a href="#">
                                                <?php echo $row['ProductName']; ?>
                                            </a></td>
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
                                        <td>
                                            <div class="table-action-buttons d-flex gap2">

                                                <a class="edit button button-box button-xs button-info"
                                                    href="edit-product.php?id=<?php echo $row['ProductID'] ?>"><i
                                                        class="zmdi zmdi-edit"></i></a>
                                                <!-- <a class="delete button button-box button-xs button-danger" href="#"><i
                                                        class="zmdi zmdi-delete"></i></a> -->
                                                <div class="box-body">
                                                    <button class="delete button button-box button-xs button-danger"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal3"><i
                                                            class="zmdi zmdi-delete"></i></button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal3">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">DELETE</h5>
                                                                    <button class="close" data-bs-dismiss="modal"><span
                                                                            aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="p-2 modal-header">
                                                                    <div class="modal-body">
                                                                        Are you sure you want to Delete This Product?
                                                                    </div>
                                                                </div>
                                                                <div class="p-3 text-end ">
                                                                    <a class="btn" data-bs-dismiss="modal">Close</a>
                                                                    <a class="btn btn-danger "
                                                                        href="delete-product.php?id=<?php echo $row['ProductID'] ?>">DELETE</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
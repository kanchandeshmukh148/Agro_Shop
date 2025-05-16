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
                        <h3 class="title"> Add Product</h3>
                    </div>
                </div><!-- Page Heading End -->

            </div><!-- Page Headings End -->

            <div>
                <div class="add-edit-product-form">
                    <form action="upload-product.php" method="POST" enctype="multipart/form-data">

                        <!-- <h4 class="title">Add Product</h4> -->

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title"> Name / Title*</h4>
                                <input class="form-control" type="text" placeholder=" Name / Title"
                                    name="productName"  pattern="[A-Za-z\s]+"  title="(only letters and spaces)"  required>
                                    
                            </div>
                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title"> Price* : &#8377;</h4>
                                <input class="form-control" type="number" placeholder=" &#8377;"
                                    name="price" min="1" required>
                            </div>
                            <div class="col-12 mb-30">
                                <h4 class="title"> Description*</h4>
                                <textarea class="form-control" placeholder=" Description" name="description"
                                    required></textarea>
                            </div>

                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title">Category*</h4>
                                <?php
                                $categoriesQuery = mysqli_query($connect, "SELECT * FROM category");
                                ?>
                                <select class="form-control select2 " name="category" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($categoriesQuery)) {
                                        ?>
                                        <option value="<?php echo $row['CategoryID'] ?>">
                                            <?php echo $row['CategoryName'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title">Product Image*</h4>


                                <div>
                                    <div>

                                        <input class="form-control" type="file" name="image1" id="image" required>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <h4 class="title">Additional Information</h4> -->

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-30">
                                <h5 class=" mt-15 mb-1 ">Stock Quantity*</h5><input class="form-control" type="number"
                                    placeholder="Stock Quantity" min="1" name="stockQuantity" required>
                            </div>
                        </div>

                        <!-- Button Group Start -->
                        <div class="row">
                            <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                <a href="view-product.php" class="button button-outline  mb-10 ml-10 mr-0"
                                    style="color : #000000e9 ;">Cancel</a>
                                <button class="button button-outline button-primary mb-10 ml-10 mr-0">Submit</button>
                            </div>
                        </div><!-- Button Group End -->

                    </form>

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
    <script src="assets/js/plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/nice-select/niceSelect.active.js"></script>
    <script src="assets/js/plugins/filepond/filepond.min.js"></script>
    <script src="assets/js/plugins/filepond/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="assets/js/plugins/filepond/filepond-plugin-image-preview.min.js"></script>
    <script src="assets/js/plugins/filepond/filepond.active.js"></script>
</body>

</html>
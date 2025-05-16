<?php
session_start();
include 'comfig.php';

// Check if the product ID is set in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $_SESSION['productId'] = $productId;

    // Fetch product details from the database based on the product ID
    $productQuery = mysqli_query($connect, "SELECT * FROM product WHERE ProductID = $productId");

    // Check if the product exists
    if ($productQuery && mysqli_num_rows($productQuery) > 0) {
        $productData = mysqli_fetch_assoc($productQuery);
    } else {
        // Redirect or handle the case where the product doesn't exist
        $_SESSION["Message"] = "Product not found.";
        header("Location: add-product.php");
        exit();
    }
} else {
    // Redirect or handle the case where the product ID is not set in the URL
    $_SESSION["Message"] = "Product ID is missing.";
    header("Location: add-product.php");
    exit();
}
?>


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
            <div class="row justify-content-between align-items-center mb-10">
                <!-- Page Heading Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3 class="title">Edit Product</h3>
                    </div>
                </div>
            </div>

            <div>
                <div class="add-edit-product-form">
                    <form action="edit-product-data.php" method="POST" enctype="multipart/form-data">
                        <!-- Add a hidden input field to store the product ID -->

                        <!-- Your existing form fields with values from the database -->
                        <!-- <h4 class="title">About Product</h4> -->
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title">Product Name / Title*</h4>
                                <input class="form-control" type="text" placeholder="Product Name / Title*"
                                    name="productName" pattern="[A-Za-z\s]+"  title="(only letters and spaces)" 
                                    value="<?php echo $productData['ProductName']; ?>" required>

                            </div>
                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title">Product Price* : &#8377;</h4>
                                <input class="form-control" type="number" placeholder="Product Price*" name="price"
                                    value="<?php echo $productData['Price']; ?>" required>
                            </div>
                            <div class="col-12 mb-30">
                                <h4 class="title">Product Description*</h4>
                                <textarea class="form-control" placeholder="Product Description*" name="description"
                                    required><?php echo $productData['Description']; ?></textarea>
                            </div>
                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title">Category*</h4>
                                <?php
                                $categoriesQuery = mysqli_query($connect, "SELECT * FROM category");
                                ?>
                                <select class="form-control select2" name="category" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($categoriesQuery)) {
                                        $selected = ($row['CategoryID'] == $productData['CategoryID']) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $row['CategoryID'] ?>" <?php echo $selected; ?>>
                                            <?php echo $row['CategoryName'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div class=" mb-30">
                                    <h5 class=" mt-15 mb-1 ">Stock Quantity*</h5>
                                    <input class="form-control" type="number" placeholder="Stock Quantity"
                                        name="stockQuantity" value="<?php echo $productData['StockQuantity']; ?>"
                                        required>
                                </div>

                            </div>
                            <div class="col-lg-6 col-12 mb-30">
                                <h4 class="title">Product Image*</h4>

                                <div>
                                    <div>
                                        <img src="../upload/<?php echo $productData['ImageURL']; ?>" alt="Product Image"
                                            style="width :auto; height: 100px; margin: 10px;">
                                        <!-- <h5 class=" mt-15 mb-1 ">IMAGE 1</h5> -->
                                        <input class="form-control" type="file" name="image" id="image"
                                            accept="image/*">
                                        <input type="hidden" name="hedden"
                                            value="<?php echo $productData['ImageURL'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <h4 class="title">Additional Information</h4> -->
                        <!-- <div class="row">
                            <div class="col-lg-6 col-12 mb-30">
                                <input class="form-control" type="number" placeholder="Stock Quantity"
                                    name="stockQuantity" value="<?php echo $productData['StockQuantity']; ?>" required>
                            </div>

                        </div> -->

                        <!-- Button Group Start -->
                        <div class="row">
                            <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                <a href="view-product.php" class="button button-outline  mb-10 ml-10 mr-0"
                                    style="color : #000000d0 ;"> Cancel</a>
                                <button class="button button-outline button-primary mb-10 ml-10 mr-0">Update</button>
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
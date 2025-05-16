<?php include 'comfig.php';
session_start(); ?>

<?php include 'message.php' ?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        p {
            color: black !important;

        }
    </style>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php include 'header.php' ?>
</head>

<?php
// SQL query to select data from your table
$sql = "SELECT * FROM product";
$result = $connect->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch associative array
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $products = []; // No results, initialize an empty array
}
?>

<body>

    <div class="container mt-5">
        <h2>Products</h2>

        <!-- Filter Form -->
        <form id="filterForm" method="POST" action="">
            <!-- Add method and action attributes to the form for it to work properly -->
            <div class="row">
                <!-- Category Filter -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <?php
                        $Query1 = mysqli_query($connect, "SELECT * FROM category");
                        ?>
                        <select class="form-control" id="category" name="category">
                            <option value="0">None</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($Query1)) {
                                ?>

                                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
                                    <option value="<?php echo $row['CategoryID'] ?>" <?php echo ($row['CategoryID'] == $_POST['category']) ? "selected" : ""; ?>>
                                        <?php echo $row['CategoryName'] ?>
                                    </option>

                                <?php } else { ?>
                                    <option value="<?php echo $row['CategoryID'] ?>">
                                        <?php echo $row['CategoryName'] ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Location Filter -->
                <div class="col-md-4">
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
                </div>

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

        <?php //if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <table class="table table-vertical-middle">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Photo</th>
                    <th>Product Name</th>
                    <th>Shop Name</th>
                    <th>Category</th>
                    <th>In Stock</th>
                    <th>Price &#8377;</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get the selected values from the form
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $selectedCategory = $_POST['category'];
                    $selectedShop = $_POST['shop'];
                    $selectedLocation = $_POST['location'];
                } else {
                    $selectedCategory = 0;
                    $selectedShop = 0;
                    $selectedLocation = 0;
                }
                // SQL query to fetch products based on selected filters
                $query = "SELECT
    p.ProductID,
    p.ProductName,
    p.Description,
    p.Price,
    p.StockQuantity,
    p.ImageURL,
    p.CategoryID,
    p.CreatedAt,
    p.UpdatedAt,
    p.ShopID,
    p.Productstateus,
    c.CategoryName,
    s.ShopName,
    a.`area-id`

FROM product p
LEFT JOIN category c ON p.CategoryID = c.CategoryID
LEFT JOIN shop s ON p.ShopID = s.ShopID
LEFT JOIN area a ON s.ShopAddress = a.`area-id`
WHERE Productstateus = 'varify' AND p.StockQuantity > 0 ";

                // Add conditions based on selected filters
                if ($selectedCategory != '0') {
                    $query .= " AND p.CategoryID = $selectedCategory";
                }

                if ($selectedShop != '0') {
                    $query .= " AND p.ShopID = $selectedShop";
                }

                if ($selectedLocation != '0') {
                    $query .= " AND a.`area-id` = $selectedLocation";
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

                            <td><img src="../upload/<?php echo $row['ImageURL'] ?>"
                                    style="object-fit: cover; height: 50px; width: 50px;" alt="Product Image"
                                    class="product-image rounded-circle"></td>
                            <td>
                                <div class="text-black">

                                    <a data-bs-toggle="modal" class="  btn  d-flex"
                                        data-bs-target="#exampleModal<?php echo $count ?>">
                                        <div class=" d-flex gap-3 justify-content-around w-100">
                                            <div style=" padding-right:10px; color:black; font-size: 1.2rem; "
                                                class=" fw-bolder ">
                                                <?php echo $row['ProductName']; ?>
                                            </div>

                                            <div class="  ">
                                                <img src="eye.png" alt="" width="20px">
                                            </div>
                                        </div>

                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade align-items-center " id="exampleModal<?php echo $count ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" style="max-width: 900px;">
                                            <div class="modal-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Product Image -->
                                                        <div class=" d-flex row gap-2 justify-content-between ">

                                                            <img src="../upload/<?php echo $row['ImageURL']; ?>" width="100%"
                                                                style="height :300px  width: 100%;  height: 300px; margin: 10px; padding-right:0; margin-right: 0;  object-fit: cover;"
                                                                class="d-block col-12 product-img" alt="Product Image">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!-- Product Details -->
                                                        <div class="col-md-12 pt-5">
                                                            <!-- Product Details -->
                                                            <div class="card">
                                                                <div class="card-body  ">
                                                                    <h2 class="card-title">
                                                                        <?= $row['ProductName'] ?>
                                                                    </h2>

                                                                    <p class="card-text"><strong>Description:</strong>
                                                                        <?= $row['Description'] ?>
                                                                    </p>
                                                                    <p class="card-text"><strong>Category:</strong>
                                                                        <?= $row['CategoryName'] ?>
                                                                    </p>
                                                                    <p class="card-text"><strong>Shop:</strong>
                                                                        <?= $row['ShopName'] ?>
                                                                    </p>
                                                                    <h4 class="card-text text-primary  ">Price: &#8377;
                                                                        <?= $row['Price'] ?>
                                                                    </h4>

                                                                    <!-- Additional product details can be added here -->

                                                                    <!-- You can also add a form for adding the product to the cart if needed -->

                                                                    <!-- <div class="mt-4">
                                                                                    <button class="btn btn-primary">Add to Cart</button>
                                                                                </div> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <div class="text-black">

                                    <a data-bs-toggle="modal" class=" d-flex" data-bs-target="#shopModal<?php echo $count ?>">
                                        <div class=" d-flex gap-3 justify-content-around w-100">
                                            <div style=" padding-right:10px; color:black; font-size: 1.2rem; "
                                                class=" fw-bolder ">
                                                <?php echo $row['ShopName']; ?>
                                            </div>

                                            <div class="">
                                                <img src="eye.png" alt="" width="20px">
                                            </div>
                                        </div>

                                    </a>

                                    <?php
                                    // SQL query to fetch products based on selected filters
                                    $shopQuery = "SELECT s.*,  a.`area-name` AS AreaName , c2.`city-name` AS CityName, s2.`state-name` AS StateName FROM  shop s LEFT JOIN area a ON s.ShopAddress = a.`area-id` LEFT JOIN  city c2 ON a.`city-id` = c2.`city-id` LEFT JOIN state s2 ON a.`state-id` = s2.`state-id` WHERE s.ShopID = " . $row['ShopID'];

                                    // Execute the query
                                    $shopResult = mysqli_query($connect, $shopQuery);

                                    if ($shopResult) {
                                        // Fetch the shop data
                                        $shop = mysqli_fetch_assoc($shopResult);
                                        ?>
                                        <!-- Modal -->
                                        <div class="modal fade align-items-center " id="shopModal<?php echo $count ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 500px;">
                                                <div class="modal-content">

                                                    <!-- Product Details -->
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h2 class="card-title">
                                                                <?= $shop['ShopName'] ?>
                                                            </h2>

                                                            <p class="card-text"><strong>Shop Email:</strong>
                                                                <?= $shop['ShopEmail'] ?>
                                                            </p>
                                                            <p class="card-text"><strong>Phone No :</strong>
                                                                <?= $shop['ShopPhone'] ?>
                                                            </p>
                                                            <p class="card-text"><strong>Address :</strong>
                                                                <?php echo ($shop['AreaName'] . " , " . $shop['CityName'] . " , " . $shop['StateName']) ?>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                            </td>

                            <td>
                                <?php echo $row['CategoryName']; ?>
                            </td>
                            <td>
                                <?php echo $row['StockQuantity']; ?>
                            </td>


                            <td class="" style="  font-size: 1.3rem; color:#444; font-weight: 700;">
                                <?php echo $row['Price']; ?>
                            </td>
                            <td class="" style="  ">
                                <?php
                                if (isset($_SESSION['User-Email'])) {
                                    ?>
                                    <a href="#" class="btn btn-primary fw-bolder fs-6  "
                                        onclick="addToCart(<?php echo $row['ProductID']; ?>)" style="border-radius: 10px;">Add To
                                        Cart <i class="fa-solid fa-cart-shopping fa-bounce"></i></a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="login.php" class="btn btn-primary fw-bolder fs-6  " style="border-radius: 10px;">Add To
                                        Cart <i class="fa-solid fa-cart-shopping fa-bounce"></i></a>
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
                ?>
            </tbody>
        </table>
        <?php //} ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

    <?php include 'js-links.php' ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("select#location").change(function () {
                var aid = $("#location option:selected").val();
                console.log(aid);

                // Clear previous data or show loading indicator if necessary
                $("#shop").html("<p>Loading...</p>");

                $.ajax({
                    type: "POST",
                    url: "shop-api.php",
                    data: { areaid: aid },
                    success: function (data) {
                        // Check if the response is valid (you can customize this based on your response format)
                        if (data.trim() !== "") {
                            $("#shop").html(data);
                            console.log(data);
                        } else {
                            // Handle empty or invalid response
                            $("#shop").html("<p>No shops found.</p>");
                            console.error("Invalid response from server.");
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX errors
                        $("#shop").html("<p>Error loading shops.</p>");
                        console.error("AJAX Error:", status, error);
                    }
                });
            });
        });
    </script>


    <script type="text/javascript">
        // $(document).ready(function () {
        // Function to load shops based on the selected location
        function addToCart(pid) {
            // Clear previous data or show loading indicator if necessary
            // $("#shop").html("<p>Loading...</p>");

            $.ajax({
                type: "POST",
                url: "add-cart-api2.php",
                data: { productId: pid },
                success: function (data) {
                    // Check if the response is valid (you can customize this based on your response format)
                    if (data.trim() !== "") {
                        //     $("#shop").html(data);
                        alert(data);
                    } else {
                        // // Handle empty or invalid response
                        // $("#shop").html("<p>No shops found.</p>");
                        alert("Invalid response from server.");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle AJAX errors
                    // $("#shop").html("<p>Error loading shops.</p>");
                    console.error("AJAX Error:", status, error);
                }
            });
        }

        // Event handler for button click
        // $("#yourButtonId").click(function () {
        //     // Get the value or parameter you want to pass (replace "yourParameterValue" with the actual value)
        //     var yourParameterValue = "yourParameterValue";

        //     // Call the function with the parameter
        //     loadShops(yourParameterValue);
        // });
        // });
    </script>



    <!-- <script type="text/javascript">
        $(document).ready(function () {
            // Function to load shops based on the selected location
            function addToCart(pid) {
                // Clear previous data or show loading indicator if necessary
                // $("#shop").html("<p>Loading...</p>");

                $.ajax({
                    type: "POST",
                    url: "add-cart-api.php",
                    data: { pid: pid },
                    success: function (data) {
                        // Check if the response is valid (you can customize this based on your response format)
                        if (data.trim() !== "") {
                            //     $("#shop").html(data);
                            console.log(data);
                        } else {
                            // // Handle empty or invalid response
                            // $("#shop").html("<p>No shops found.</p>");
                            console.error("Invalid response from server.");
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX errors
                        // $("#shop").html("<p>Error loading shops.</p>");
                        console.error("AJAX Error:", status, error);
                    }
                });
            }

            // Event handler for button click
            // $("#yourButtonId").click(function () {
            //     // Get the value or parameter you want to pass (replace "yourParameterValue" with the actual value)
            //     var yourParameterValue = "yourParameterValue";

            //     // Call the function with the parameter
            //     loadShops(yourParameterValue);
            // });
        });
    </script> -->
</body>

</html>
<?php
include('comfig.php');
include('verify.php');
include('navbar.php');
?>
<?php include 'message.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="container">
        <h1>Your Order Details</h1>
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
            <p>Subtotal: <span id="subtotal"><?php echo $sum ?></span></p>
            <!-- <button type="button" class="btn btn-primary checkout-button" onclick="checkout()"><?php echo $sum ?></button> -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rqRO3RiALxvvYOdDuiBh6HYLtA7BTcvvfuAfwZd+stObbHxihE9z9s+wyG5L25J"
        crossorigin="anonymous"></script>
    <?php include 'js-links.php'; ?>
    <!-- Your custom JavaScript code -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add your JavaScript code here
        });
    </script>
</body>

</html>
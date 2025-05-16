<?php include 'comfig.php'; ?>
<?php include 'verify.php'; ?>

<?php include 'message.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order's</title>
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
    <?php include 'header.php' ?>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Your Order's</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class=" text-center ">Sr NO</th>
                    <th class=" text-center ">Order ID</th>
                    <th class=" text-center ">From Shop</th>
                    <th class=" text-center ">Price Total</th>
                    <th class=" text-center ">Order Date</th>
                    <th class=" text-center ">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch cart items from the database
                // $query = "SELECT p.ImageURL, s.ShopName, p.ProductName, p.ProductID, p.ShopID, p.StockQuantity, c.Price, c.CartID FROM cart c JOIN product p ON c.ProductID = p.ProductID JOIN shop s ON p.ShopID = s.ShopID WHERE c.UserID = " . $_SESSION['User-ID'] . "; ";
                $query = "SELECT ot.OrderID , ud.FullName , s.ShopName , ot.OrderDate  FROM ordertable ot JOIN userdata ud ON ot.UserID = ud.UserID JOIN shop s ON ot.ShopID = s.ShopID WHERE ot.UserID = " . $_SESSION['User-ID'] . " ; ";

                // Execute the query
                $result = mysqli_query($connect, $query);

                // Check if there are results
                if ($result && mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr class="align-content-center">



                            <td class="align-middle">
                                <?php echo $count++; ?>
                            </td>
                            <!-- <td><img src="../upload/<?php echo $row['ImageURL']; ?>" alt="Product Image"></td> -->
                            <td class="align-middle">
                                <?php echo $count . rand(100, 999) . $row['OrderID']; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $row['ShopName']; ?>
                            </td>

                            <?php
                            $totle = mysqli_fetch_assoc(mysqli_query($connect, "SELECT SUM(Quantity * ProductPAT) AS TotalPrice  FROM OrderDetails  WHERE OrderID = " . $row['OrderID'] . ";"));
                            ?>
                            <td class="align-middle">
                                <?php echo $totle['TotalPrice']; ?>
                            </td>
                            <td class="align-middle">
                                <?php $dateTime = new DateTime($row['OrderDate']); ?>
                                <?php echo $dateTime->format('Y-m-d'); ?>
                            </td>
                            <td class="align-middle">
                                <a href="view-order.php?id=<?php echo $row['OrderID']; ?>" type="button"
                                    class="btn btn-primary">View Order</a>
                                <a href="delete-order.php?id=<?php echo $row['OrderID']; ?>" type="button"
                                    class="btn btn-danger">Delete Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Handle case when there are no items in the cart
                    ?>
                    <tr>
                        <td colspan="9" class="text-center">Oreder list is empty.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
        <!-- <div class="d-flex justify-content-between">
            <p>Subtotal: <span id="subtotal"></span></p>
            <button type="button" class="btn btn-primary checkout-button" onclick="checkout()">Checkout</button>
        </div> -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rqRO3RiALxvvYOdDuiBh6HYLtA7BTcvvfuAfwZd+stObbHxihE9z9s+wyG5L25J"
        crossorigin="anonymous"></script>
    <?php include 'js-links.php' ?>
    <!-- Your custom JavaScript code -->
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const productPrices = document.querySelectorAll('.product-price');
            const totalEls = document.querySelectorAll('.total');
            const stockEls = document.querySelectorAll('.stock');
            const stockInputs = document.querySelectorAll('.stockinput');
            const removeButtons = document.querySelectorAll('.remove-button');
            const subtotalEl = document.getElementById('subtotal');

            quantityInputs.forEach((quantityInput, index) => {
                quantityInput.addEventListener('change', function () {
                    const price = parseInt(productPrices[index].textContent);
                    const stock = parseInt(stockEls[index].textContent);
                    const stockinputvalue = parseInt(stockInputs[index].value);
                    const quantity = parseInt(this.value, 10);

                    // Increment and decrement total on change of quantity
                    updateTotal(price, quantity, stock, stockinputvalue, totalEls[index], index);

                    // Update subtotal when quantity changes
                    updateSubtotal();
                });
            });

            // Call updateSubtotal() when the page is loaded
            updateSubtotal();

            function updateTotal(price, quantity, stock, stockinputvalue, totalEl, index) {
                const newTotal = parseInt(price * quantity);
                const newStock = Math.max(stockinputvalue - quantity, 0);
                totalEl.textContent = newTotal;
                stockEls[index].textContent = newStock;
            }

            function updateSubtotal() {
                const totalElements = document.querySelectorAll('.total');
                let subtotal = 0;
                totalElements.forEach(element => {
                    subtotal += parseInt(element.textContent);
                });
                subtotalEl.textContent = subtotal;
            }
        });

        function checkout() {
            const products = [];
            const productRows = document.querySelectorAll('tbody tr');
            var Qvarify = true;
            productRows.forEach(row => {
                const productId = row.querySelector('.product-id').value;
                const cartId = row.querySelector('.cart-id').value;
                const shopId = row.querySelector('.shop-id').value;
                const quantity = row.querySelector('.quantity-input').value;
                const stockproduct = row.querySelector('.stockinput').value;
                const PriceAT = row.querySelector('.Price-AT').value;

                if ((quantity <= stockproduct) && (quantity > 0)) {
                    products.push({
                        ProductID: productId,
                        CartID: cartId,
                        ShopID: shopId,
                        Quantity: quantity,
                        PriceAT: PriceAT
                    });
                }
                else {
                    Qvarify = false;
                    alert("Quantity Is More Then Stock Available.");
                    location.reload();
                }
            });

            console.log(products);

            // Now 'products' array contains the required information

            if (Qvarify) {
                // Perform AJAX request to send the JSON object to the server
                $.ajax({
                    type: 'POST',
                    url: 'checkout-api.php', // Replace with your actual API endpoint
                    data: { products: JSON.stringify(products) },
                    success: function (data) {
                        // Handle success response from the server
                        alert(data);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX errors
                        console.error('AJAX Error:', status, error);
                    }
                });
            }
        }

        function remove(cid) {
            $.ajax({
                type: "POST",
                url: "remove-product-api.php",
                data: { cartId: cid },
                success: function (data) {
                    if (data.trim() !== "") {
                        alert(data);
                        location.reload();
                    } else {
                        alert("Invalid response from server.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        }
    </script> -->
</body>

</html>
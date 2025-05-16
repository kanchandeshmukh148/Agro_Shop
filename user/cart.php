<?php include 'comfig.php'; ?>
<?php include 'verify.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'message.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
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
    <div class="container">
        <h1>Your Shopping Cart</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class=" text-center">Sr NO</th>
                    <th class=" text-center">image</th>
                    <th class=" text-center">Product</th>
                    <th class=" text-center">Shop</th>
                    <th class=" text-center">Stock</th>
                    <th class=" text-center">Price</th>
                    <th class=" text-center">Quantity</th>
                    <th class=" text-center">Total</th>
                    <th class=" text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch cart items from the database
                $query = "SELECT p.ImageURL, s.ShopName, p.ProductName, p.ProductID, p.ShopID, p.StockQuantity, c.Price, c.CartID FROM cart c JOIN product p ON c.ProductID = p.ProductID JOIN shop s ON p.ShopID = s.ShopID WHERE c.UserID = " . $_SESSION['User-ID'] . "; ";

                // Execute the query
                $result = mysqli_query($connect, $query);

                // Check if there are results
                if ($result && mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr class="align-content-center" data-productId="<?php echo $row['ProductID']; ?>"
                            data-cartId="<?php echo $row['CartID']; ?>" data-shopId="<?php echo $row['ShopID']; ?>">

                            <input type="hidden" class="product-id" value="<?php echo $row['ProductID']; ?>">
                            <input type="hidden" class="cart-id" value="<?php echo $row['CartID']; ?>">
                            <input type="hidden" class="shop-id" value="<?php echo $row['ShopID']; ?>">
                            <input type="hidden" class="Price-AT" value="<?php echo $row['Price']; ?>">


                            <td class="align-middle">
                                <?php echo $count++; ?>
                            </td>
                            <td><img src="../upload/<?php echo $row['ImageURL']; ?>" alt="Product Image"></td>
                            <td class="align-middle">
                                <?php echo $row['ProductName']; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $row['ShopName']; ?>
                            </td>
                            <td class="align-middle">
                                <input type="hidden" name="stick" class="stockinput"
                                    value="<?php echo $row['StockQuantity']; ?>" name="Stock">
                                <p class="stock">
                                    <?php echo $row['StockQuantity'] - 1; ?>
                                </p>
                            </td>
                            <td class="align-middle product-price">
                                <?php echo $row['Price']; ?>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="number" min="1" max="<?php echo $row['StockQuantity']; ?>" value="1"
                                        class="form-control quantity-input w-50">
                                </div>
                            </td>
                            <td class="align-middle total">
                                <?php echo $row['Price']; ?>
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-danger remove-button"
                                    onclick="remove(<?php echo $row['CartID']; ?>)">Remove</button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // Handle case when there are no items in the cart
                    ?>
                    <tr>
                        <td colspan="9" class="text-center">Your cart is empty.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
        <div class="d-flex justify-content-between">
            <p>Subtotal: <span id="subtotal"></span></p>
            <button type="button" class="btn btn-primary checkout-button" onclick="checkout()">Place Order</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rqRO3RiALxvvYOdDuiBh6HYLtA7BTcvvfuAfwZd+stObbHxihE9z9s+wyG5L25J"
        crossorigin="anonymous"></script>
    <?php include 'js-links.php' ?>
    <!-- Your custom JavaScript code -->
    <script>
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
                const sub = stockproduct - quantity ;
                if (sub > -1 && sub < stockproduct ) {
                    products.push({
                        ProductID: productId,
                        CartID: cartId,
                        ShopID: shopId,
                        Quantity: quantity,
                        PriceAT: PriceAT
                    });
                    console.log(1111);
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
    </script>
</body>

</html>
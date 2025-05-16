<!-- Add this script to your HTML file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var selectedProductA = null; // Variable to store the selected Product A

        // Function to handle when a user views a product
        function viewProduct(productId) {
            // Assuming you have a function to load product details based on productId
            // You can replace the alert with your logic to display the product details
            alert('User views product: ' + productId);
        }

        // Function to handle when a user clicks on a product
        function clickProduct(productId) {
            if (selectedProductA === null) {
                // If Product A is not selected, add it to the cart
                addToCart(productId);
                selectedProductA = productId; // Set selectedProductA
            } else {
                // If Product A is already selected, check if both products are from the same shop
                verifyShopAndAddToCart(selectedProductA, productId);
            }
        }

        // Function to add a product to the cart
        function addToCart(productId) {
            $.ajax({
                type: "POST",
                url: "add-cart-api.php",
                data: { pid: productId },
                success: function (data) {
                    if (data.trim() !== "") {
                        console.log(data);
                    } else {
                        console.error("Invalid response from server.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        }

        // Function to verify if two products are from the same shop and add to cart
        function verifyShopAndAddToCart(productAId, productBId) {
            $.ajax({
                type: "POST",
                url: "verify-shop-api.php",
                data: { productAId: productAId, productBId: productBId },
                success: function (data) {
                    if (data.trim() === "true") {
                        // If products are from the same shop, add Product B to the cart
                        addToCart(productBId);
                    } else {
                        // If products are from different shops, show an alert
                        alert("You can only select products from the same shop.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        }
    });
</script>

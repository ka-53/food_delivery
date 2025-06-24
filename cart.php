<?php
$pageTitle = "Basket | FoodExpress";
ob_start();
?>
<h1 class="text-2xl font-bold mb-6">Your Cart</h1>
<div id="cart-items"></div>
<p>Total: <span id="cart-total">0</span> $</p>
<form action="checkout.php" method="POST" onsubmit="return submitCart()">
    <input type="hidden" name="cart_data" id="cart_data">
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg mt-4">Place an order</button>
</form>
<a href="menu.php" class="text-indigo-600 hover:underline mt-4 block">← Continue the selection</a>
<script src="assets/js/cart.js"></script>
<script>
    showCart();
    function submitCart() {
        const cart = localStorage.getItem('cart');
        if (!cart || JSON.parse(cart).length === 0) {
            alert("The basket is empty!");
            return false;
        }
        document.getElementById('cart_data').value = cart;
        return true;
    }
</script>
<?php
$content = ob_get_clean();
include 'template.php';
?>

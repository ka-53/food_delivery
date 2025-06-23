<?php
$pageTitle = "Корзина | FoodExpress";
ob_start();
?>
<h1 class="text-2xl font-bold mb-6">Ваша корзина</h1>
<div id="cart-items"></div>
<p>Итого: <span id="cart-total">0</span> ₽</p>
<form action="checkout.php" method="POST" onsubmit="return submitCart()">
    <input type="hidden" name="cart_data" id="cart_data">
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg mt-4">Оформить заказ</button>
</form>
<a href="menu.php" class="text-indigo-600 hover:underline mt-4 block">← Продолжить выбор</a>
<script src="assets/js/cart.js"></script>
<script>
    showCart();
    function submitCart() {
        const cart = localStorage.getItem('cart');
        if (!cart || JSON.parse(cart).length === 0) {
            alert("Корзина пуста!");
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

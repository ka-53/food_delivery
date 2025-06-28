<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pageTitle = "Корзина | FoodExpress";
ob_start();
?>

<h1 class="text-2xl font-bold mb-6">Ваша корзина</h1>

<div id="cart-items" class="mb-6"></div>

<div class="flex justify-between items-center border-t pt-4 mb-6">
    <span class="font-bold">Итого:</span>
    <span id="cart-total" class="font-bold text-xl">0.00</span> €
</div>

<form action="checkout.php" method="POST" onsubmit="return submitCart()">
    <input type="hidden" name="cart_data" id="cart_data">

    <label class="block mb-2 font-semibold" for="address">Адрес доставки</label>
    <input type="text" id="address" name="address" required class="w-full mb-4 px-3 py-2 border rounded">

    <label class="block mb-2 font-semibold" for="phone">Телефон</label>
    <input type="tel" id="phone" name="phone" required class="w-full mb-4 px-3 py-2 border rounded">

    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-lg">
        Оформить заказ
    </button>
</form>

<a href="menu.php" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">
    ← Вернуться к меню
</a>

<script src="assets/js/cart.js"></script>
<script>
    // Отобразить корзину при загрузке страницы
    showCart();

    // Перед отправкой формы передать данные корзины в скрытое поле
    function submitCart() {
        const cart = localStorage.getItem('cart');
        if (!cart || JSON.parse(cart).length === 0) {
            alert("Корзина пуста!");
            return false; // Отменяем отправку формы
        }
        document.getElementById('cart_data').value = cart;
        return true; // Разрешаем отправку формы
    }
</script>

<?php
$content = ob_get_clean();
include 'template.php';

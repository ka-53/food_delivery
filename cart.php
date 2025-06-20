<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
    <script src="assets/js/cart.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <h1>Ваша корзина</h1>
    <div id="cart-items"></div>
    <p>Итого: $<span id="cart-total">0.00</span></p>

    <form action="checkout.php" method="POST" onsubmit="return submitCart()">
        <input type="hidden" name="cart_data" id="cart_data">
        <button type="submit">Оформить заказ</button>
    </form>

    <a href="index.php">← Вернуться к ресторанам</a>

    <script>
        // Показываем содержимое корзины при загрузке страницы
        showCart();

        // Перед отправкой формы передаем данные корзины в скрытое поле
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
</body>
</html>

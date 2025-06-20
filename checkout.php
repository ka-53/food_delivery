<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_data = $_POST['cart_data'] ?? '';
    $cart = json_decode($cart_data, true);

    if (!$cart || count($cart) === 0) {
        echo "Корзина пуста.";
        exit;
    }

    // Считаем итоговую сумму
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'];
    }

    // Вставляем заказ в таблицу orders
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $total, 'Новый']);

    $order_id = $pdo->lastInsertId();

    // Можно добавить таблицу order_items для хранения блюд заказа (опционально)

    // Очистка корзины на клиенте — сделаем через редирект с JS
    echo "<script>
        alert('Заказ успешно оформлен! Номер заказа: $order_id');
        localStorage.removeItem('cart');
        window.location.href = 'profile.php';
    </script>";
    exit;
}
?>

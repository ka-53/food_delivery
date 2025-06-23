<?php
require 'includes/db.php';
session_start();
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
    $total = 0;
    foreach ($cart as $item) $total += $item['price'] * $item['quantity'];
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $total, 'Новый']);
    $order_id = $pdo->lastInsertId();
    // Здесь можно добавить запись в order_items
    echo "<script>
        alert('Заказ успешно оформлен! Номер заказа: $order_id');
        localStorage.removeItem('cart');
        window.location.href = 'orders.php';
    </script>";
    exit;
}

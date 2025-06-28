<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_data = $_POST['cart_data'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if (!$address || !$phone) {
        die("Please fill in the address and phone number.");
    }

    $cart = json_decode($cart_data, true);
    if (!$cart || count($cart) === 0) {
        die("The basket is empty.");
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Добавляем поля address и phone в таблицу orders
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status, address, phone) VALUES (?, ?, 'New', ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $total, $address, $phone]);
    $order_id = $pdo->lastInsertId();

    echo "<script>
        alert('Order №$order_id successfully issued! It will be delivered within 10-15 minutes.');
        localStorage.removeItem('cart');
        window.location.href = 'order_success.php';
    </script>";
    exit;
}

header("Location: cart.php");

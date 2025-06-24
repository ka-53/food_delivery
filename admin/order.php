<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Получаем все заказы
$stmt = $pdo->query("SELECT o.*, u.name AS user_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC");
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin Orders</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Orders</h1>
    <a href="products.php">Dish Management</a> | <a href="../index.php">На сайт</a>
    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Sum</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['user_name']) ?></td>
            <td>$<?= number_format($order['total'], 2) ?></td>
            <td><?= htmlspecialchars($order['status']) ?></td>
            <td><?= $order['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

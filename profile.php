<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <h1>Добро пожаловать, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    <a href="logout.php">Выйти</a>

    <h2>Ваши заказы</h2>
    <?php if (count($orders) === 0): ?>
        <p>Пока нет заказов.</p>
    <?php else: ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>Номер заказа</th>
                <th>Дата</th>
                <th>Сумма</th>
                <th>Статус</th>
            </tr>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['created_at'] ?></td>
                <td>$<?= number_format($order['total'], 2) ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="index.php">Вернуться к ресторанам</a>
</body>
</html>

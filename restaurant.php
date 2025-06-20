<?php
require 'includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = (int)$_GET['id'];

// Получаем информацию о ресторане
$stmt = $pdo->prepare("SELECT * FROM restaurants WHERE id = ?");
$stmt->execute([$restaurant_id]);
$restaurant = $stmt->fetch();

if (!$restaurant) {
    echo "Ресторан не найден";
    exit;
}

// Получаем блюда ресторана
$stmt = $pdo->prepare("SELECT * FROM dishes WHERE restaurant_id = ?");
$stmt->execute([$restaurant_id]);
$dishes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($restaurant['name']) ?> — Меню</title>
    <script src="assets/js/cart.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <h1><?= htmlspecialchars($restaurant['name']) ?></h1>
    <a href="index.php">← Назад к ресторанам</a>
    <div id="dishes">
        <?php foreach ($dishes as $dish): ?>
            <div class="dish">
                <h3><?= htmlspecialchars($dish['name']) ?></h3>
                <p>Цена: $<?= number_format($dish['price'], 2) ?></p>
                <button onclick="addToCart(<?= $dish['id'] ?>, '<?= addslashes($dish['name']) ?>', <?= $dish['price'] ?>)">Добавить в корзину</button>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="cart.php">Перейти в корзину</a>
</body>
</html>

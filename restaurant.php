<?php
require '../includes/db.php';

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
    echo "The restaurant was not found.";
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
    <title><?= htmlspecialchars($restaurant['name']) ?> — Menu</title>
    <script src="assets/js/cart.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <h1><?= htmlspecialchars($restaurant['name']) ?></h1>
    <a href="index.php">← Back to the restaurants</a>
    <div id="dishes">
        <?php foreach ($dishes as $dish): ?>
            <div class="dish">
                <h3><?= htmlspecialchars($dish['name']) ?></h3>
                <p>Price: €<?= number_format($dish['price'], 2) ?></p>
                <button onclick="addToCart(<?= $dish['id'] ?>, '<?= addslashes($dish['name']) ?>', <?= $dish['price'] ?>)">Add to Cart</button>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="cart.php">Go to the shopping cart</a>
</body>
</html>

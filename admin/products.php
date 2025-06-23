<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Удаление блюда
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM dishes WHERE id = ?")->execute([$id]);
    header("Location: products.php");
    exit;
}

// Добавление блюда
if (isset($_POST['add_dish'])) {
    $stmt = $pdo->prepare("INSERT INTO dishes (restaurant_id, name, price) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['restaurant_id'], $_POST['name'], $_POST['price']]);
    header("Location: products.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ — Блюда</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Управление блюдами</h1>
    <a href="order.php">Смотреть заказы</a> | <a href="../index.php">На сайт</a>
    <h2>Добавить новое блюдо</h2>
    <form method="POST">
        <select name="restaurant_id" required>
            <?php foreach ($pdo->query("SELECT * FROM restaurants") as $r): ?>
                <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="name" placeholder="Название блюда" required>
        <input type="number" step="0.01" name="price" placeholder="Цена" required>
        <button type="submit" name="add_dish">Добавить блюдо</button>
    </form>
    <h2>Список блюд</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Блюдо</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($pdo->query("SELECT * FROM dishes") as $dish): ?>
        <tr>
            <td><?= $dish['id'] ?></td>
            <td><?= htmlspecialchars($dish['name']) ?></td>
            <td>$<?= number_format($dish['price'], 2) ?></td>
            <td>
                <a href="?delete=<?= $dish['id'] ?>" onclick="return confirm('Удалить блюдо?')">Удалить</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

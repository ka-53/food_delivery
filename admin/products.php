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
    <title>Admin Dishes</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Dish Management</h1>
    <a href="order.php">View orders</a> | <a href="../index.php">To the website</a>
    <h2>Add a new dish</h2>
    <form method="POST">
        <select name="restaurant_id" required>
            <?php foreach ($pdo->query("SELECT * FROM restaurants") as $r): ?>
                <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="name" placeholder="Name of the dish" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <button type="submit" name="add_dish">Add a new dish</button>
    </form>
    <h2>List of dishes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Dish</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($pdo->query("SELECT * FROM dishes") as $dish): ?>
        <tr>
            <td><?= $dish['id'] ?></td>
            <td><?= htmlspecialchars($dish['name']) ?></td>
            <td>$<?= number_format($dish['price'], 2) ?></td>
            <td>
                <a href="?delete=<?= $dish['id'] ?>" onclick="return confirm('Remove the dish?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Правильный путь к db.php
require __DIR__ . '/../db.php';

// ... остальной код
;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    // Удаляем изображение
    $stmt = $pdo->prepare("SELECT image FROM dishes WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();
    if ($image && file_exists('../assets/images/dishes/' . $image)) {
        unlink('../assets/images/dishes/' . $image);
    }
    $pdo->prepare("DELETE FROM dishes WHERE id = ?")->execute([$id]);
    header("Location: products.php");
    exit;
}

if (isset($_POST['add_dish'])) {
    $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid() . '.' . $ext;
        $uploadDir = '../assets/images/dishes/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }
    $stmt = $pdo->prepare("INSERT INTO dishes (restaurant_id, name, price, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['restaurant_id'],
        $_POST['name'],
        $_POST['price'],
        $_POST['description'],
        $imageName
    ]);
    header("Location: products.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление блюдами</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Управление блюдами</h1>
    <a href="orders.php">Просмотр заказов</a> | <a href="../index.php">На сайт</a>
    <h2>Добавить новое блюдо</h2>
    <form method="POST" enctype="multipart/form-data">
        <select name="restaurant_id" required>
            <?php foreach ($pdo->query("SELECT * FROM restaurants") as $r): ?>
                <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="name" placeholder="Название блюда" required>
        <input type="number" step="0.01" name="price" placeholder="Цена" required>
        <textarea name="description" placeholder="Описание"></textarea>
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="add_dish">Добавить блюдо</button>
    </form>

    <h2>Список блюд</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Фото</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($pdo->query("SELECT * FROM dishes") as $dish): ?>
        <tr>
            <td><?= $dish['id'] ?></td>
            <td>
                <?php if ($dish['image'] && file_exists('../assets/images/dishes/' . $dish['image'])): ?>
                    <img src="../assets/images/dishes/<?= htmlspecialchars($dish['image']) ?>" alt="<?= htmlspecialchars($dish['name']) ?>" width="80">
                <?php else: ?>
                    Нет фото
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($dish['name']) ?></td>
            <td><?= htmlspecialchars($dish['description']) ?></td>
            <td><?= number_format($dish['price'], 2) ?> €</td>
            <td><a href="?delete=<?= $dish['id'] ?>" onclick="return confirm('Удалить блюдо?')">Удалить</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

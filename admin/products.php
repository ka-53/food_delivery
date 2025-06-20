<?php
session_start();
if ($_SESSION['role'] !== 'admin') header("Location: ../index.php");

// Add new dish
if (isset($_POST['add_dish'])) {
    $stmt = $pdo->prepare("INSERT INTO dishes (restaurant_id, name, price) VALUES (?,?,?)");
    $stmt->execute([$_POST['restaurant_id'], $_POST['name'], $_POST['price']]);
}
?>
<!-- Admin Dish Management -->
<h2>Add New Dish</h2>
<form method="POST">
    <select name="restaurant_id">
        <?php foreach ($pdo->query("SELECT * FROM restaurants") as $r): ?>
            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="name" placeholder="Dish Name">
    <input type="number" step="0.01" name="price" placeholder="Price">
    <button type="submit" name="add_dish">Add Dish</button>
</form>

<!-- Dish List -->
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
        <td><?= $dish['name'] ?></td>
        <td>$<?= $dish['price'] ?></td>
        <td>
            <a href="?edit=<?= $dish['id'] ?>">Edit</a>
            <a href="?delete=<?= $dish['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

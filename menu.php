<?php
require 'db.php';
$pageTitle = "Меню | FoodExpress";
ob_start();

$dishes = $pdo->query("SELECT d.*, r.name as restaurant_name FROM dishes d JOIN restaurants r ON d.restaurant_id = r.id")->fetchAll();
?>

<h2>Меню</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($dishes as $dish): ?>
    <div class="dish-card">
        <?php if ($dish['image'] && file_exists('assets/images/dishes/' . $dish['image'])): ?>
            <img src="assets/images/dishes/<?= htmlspecialchars($dish['image']) ?>" alt="<?= htmlspecialchars($dish['name']) ?>" style="width:100%; height:200px; object-fit:cover;">
        <?php else: ?>
            <div style="width:100%; height:200px; background:#eee; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-utensils" style="font-size:48px; color:#ccc;"></i>
            </div>
        <?php endif; ?>
        <h3><?= htmlspecialchars($dish['name']) ?></h3>
        <p><?= htmlspecialchars($dish['description']) ?></p>
        <p><strong><?= number_format($dish['price'], 2) ?> €</strong></p>
        <button onclick="addToCart(<?= $dish['id'] ?>, '<?= addslashes($dish['name']) ?>', <?= $dish['price'] ?>)">Добавить в корзину</button>
    </div>
    <?php endforeach; ?>
</div>

<script src="assets/js/cart.js"></script>

<?php
$content = ob_get_clean();
include 'template.php';

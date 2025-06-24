<?php
require 'includes/db.php';
$pageTitle = "Menu | FoodExpress";
ob_start();

$category = $_GET['category'] ?? null;
$query = "SELECT * FROM dishes";
$params = [];
if ($category) {
    $query .= " WHERE category = ?";
    $params[] = $category;
}
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$dishes = $stmt->fetchAll();
?>
<h2 class="text-2xl font-bold mb-8 text-gray-800">Menu</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($dishes as $dish): ?>
    <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition card-hover">
        <div class="h-48 bg-gray-200 flex items-center justify-center">
            <img src="<?= htmlspecialchars($dish['image'] ?? 'assets/images/placeholder.png') ?>" alt="" class="h-40 object-cover">
        </div>
        <div class="p-6">
            <div class="flex justify-between items-start mb-2">
                <h3 class="font-bold text-lg"><?= htmlspecialchars($dish['name']) ?></h3>
                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded"><?= number_format($dish['price'], 0) ?> ₽</span>
            </div>
            <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($dish['description'] ?? '') ?></p>
            <button onclick="addToCart(<?= $dish['id'] ?>, '<?= addslashes($dish['name']) ?>', <?= $dish['price'] ?>)" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Add to Cart
            </button>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<script src="assets/js/cart.js"></script>
<?php
$content = ob_get_clean();
include 'template.php';
?>

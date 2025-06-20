<?php
require 'includes/db.php';
$restaurants = $pdo->query("SELECT * FROM restaurants")->fetchAll();
?>

<div class="restaurants">
    <?php foreach ($restaurants as $r): ?>
    <div class="restaurant-card">
        <img src="assets/images/<?= $r['image'] ?>">
        <h3><?= $r['name'] ?></h3>
        <a href="restaurant.php?id=<?= $r['id'] ?>">View Menu</a>
        <link rel="stylesheet" href="assets/css/style.css">
    </div>
    <?php endforeach; ?>
</div>

<?php
require 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$pageTitle = "Personal account | FoodExpress";
ob_start();
?>
<h1 class="text-2xl font-bold mb-6"> Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
<a href="logout.php" class="text-indigo-600 hover:underline">Log out</a>
<!-- Здесь можно вывести историю заказов -->
<?php
$content = ob_get_clean();
include 'template.php';
?>

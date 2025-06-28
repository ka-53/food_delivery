<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pageTitle = "My orders | FoodExpress";
ob_start();

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll();
?>

<h1 class="text-2xl font-bold mb-6">My orders</h1>

<?php if (empty($orders)): ?>
    <p>You don't have any orders yet.</p>
<?php else: ?>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-indigo-100">
                <th class="border border-gray-300 p-2">Order number</th>
                <th class="border border-gray-300 p-2">Date</th>
                <th class="border border-gray-300 p-2">The amount</th>
                <th class="border border-gray-300 p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td class="border border-gray-300 p-2"><?= $order['id'] ?></td>
                <td class="border border-gray-300 p-2"><?= $order['created_at'] ?></td>
                <td class="border border-gray-300 p-2"><?= number_format($order['total'], 2) ?> €</td>
                <td class="border border-gray-300 p-2"><?= htmlspecialchars($order['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
$content = ob_get_clean();
include 'template.php';

<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pageTitle = "Личный кабинет | FoodExpress";
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center">Добро пожаловать, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Ваши данные</h2>
            <a href="logout.php" class="text-indigo-600 hover:text-indigo-800 font-medium">
                Выйти из аккаунта
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600">Имя:</p>
                <p class="font-medium"><?= htmlspecialchars($_SESSION['user_name']) ?></p>
            </div>
            <div>
                <p class="text-gray-600">Email:</p>
                <p class="font-medium"><?= htmlspecialchars($_SESSION['user_email'] ?? 'Не указан') ?></p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-semibold mb-6">История заказов</h2>
        
        <?php
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$_SESSION['user_id']]);
        $orders = $stmt->fetchAll();
        
        if (empty($orders)): ?>
            <p class="text-gray-500 text-center py-8">У вас пока нет заказов</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 border text-left">№ Заказа</th>
                            <th class="py-3 px-4 border text-left">Дата</th>
                            <th class="py-3 px-4 border text-left">Сумма</th>
                            <th class="py-3 px-4 border text-left">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td class="py-3 px-4 border"><?= $order['id'] ?></td>
                            <td class="py-3 px-4 border"><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></td>
                            <td class="py-3 px-4 border"><?= number_format($order['total'], 2) ?> €</td>
                            <td class="py-3 px-4 border">
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'template.php';

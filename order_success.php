<?php
$pageTitle = "Заказ оформлен | FoodExpress";
ob_start();
?>

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-8 text-center">
    <h1 class="text-3xl font-bold mb-4">Спасибо за заказ!</h1>
    <p class="mb-6">Ваш заказ успешно оформлен и будет доставлен в течение 10-15 минут.</p>
    <a href="index.php" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
        Вернуться на главную
    </a>
</div>

<?php
$content = ob_get_clean();
include 'template.php';

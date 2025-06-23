<?php
$pageTitle = "Доставка еды | FoodExpress";
ob_start();
?>
<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-20 rounded-xl mb-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Доставка вкуснейшей еды</h1>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Более 500 ресторанов в вашем городе. Закажите любимую еду с доставкой за 30 минут!</p>
        <a href="menu.php" class="inline-block bg-white text-indigo-600 font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">
            Заказать сейчас
        </a>
    </div>
</section>
<!-- Категории и популярные блюда (пример как у тебя) -->
<?php
$content = ob_get_clean();
include 'template.php';
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Food Delivery'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #f59e0b;
        }
        .page-enter-active {
            animation: fadeIn 0.3s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-2">
                <i class="fas fa-utensils text-2xl text-indigo-600"></i>
                <span class="text-xl font-bold text-gray-800">FoodExpress</span>
            </a>
            
            <nav class="hidden md:flex space-x-8">
                <a href="index.php" class="text-gray-600 hover:text-indigo-600 transition">Главная</a>
                <a href="menu.php" class="text-gray-600 hover:text-indigo-600 transition">Меню</a>
                <a href="orders.php" class="text-gray-600 hover:text-indigo-600 transition">Мои заказы</a>
                <a href="cart.php" class="text-gray-600 hover:text-indigo-600 transition">Корзина</a>
            </nav>
            
            <div class="flex items-center space-x-4">
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="profile.php" class="flex items-center space-x-2">
                        <img src="<?php echo $_SESSION['user']['avatar'] ?? 'https://ui-avatars.com/api/?name='.urlencode($_SESSION['user']['name']); ?>" 
                             class="w-8 h-8 rounded-full">
                        <span class="hidden md:inline"><?php echo $_SESSION['user']['name']; ?></span>
                    </a>
                    <a href="logout.php" class="text-gray-600 hover:text-indigo-600 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="text-gray-600 hover:text-indigo-600 px-3 py-1 rounded transition">Войти</a>
                    <a href="register.php" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition shadow">
                        Регистрация
                    </a>
                <?php endif; ?>
                <button class="md:hidden text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="md:hidden bg-white shadow-lg hidden" id="mobileMenu">
        <div class="container mx-auto px-4 py-2 flex flex-col space-y-3">
            <a href="index.php" class="py-2 text-gray-600 hover:text-indigo-600 transition border-b">Главная</a>
            <a href="menu.php" class="py-2 text-gray-600 hover:text-indigo-600 transition border-b">Меню</a>
            <a href="orders.php" class="py-2 text-gray-600 hover:text-indigo-600 transition border-b">Мои заказы</a>
            <a href="cart.php" class="py-2 text-gray-600 hover:text-indigo-600 transition border-b">Корзина</a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 page-enter-active">
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">FoodExpress</h3>
                    <p class="text-gray-400">Доставка вкусной еды в любое время дня и ночи.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Контакты</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-phone-alt mr-2"></i> +7 (123) 456-7890</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@foodexpress.ru</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> г. Москва, ул. Примерная, 123</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Часы работы</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Пн-Пт: 9:00 - 23:00</li>
                        <li>Сб-Вс: 10:00 - 00:00</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Мы в соцсетях</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-vk text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-telegram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> FoodExpress. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('button[class*="md:hidden"]').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });

        // Simple page transitions
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('main').classList.add('page-enter-active');
        });
    </script>
</body>
</html>
<?php
$pageTitle = "Регистрация | FoodExpress";
ob_start();
?>

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Создание аккаунта</h2>
        <p class="text-gray-600">Заполните форму для регистрации</p>
    </div>
    
    <form action="register_handler.php" method="POST" class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ваше имя</label>
            <input type="text" id="name" name="name" required 
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" required 
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
            <input type="password" id="password" name="password" required 
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        
        <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition shadow-md hover:shadow-lg">
            Зарегистрироваться
        </button>
    </form>
    
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Уже есть аккаунт? 
            <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">Войти</a>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'template.php';

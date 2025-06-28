<?php
session_start();
if (isset($_SESSION['login_error'])) {
    echo '<div class="max-w-md mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">'
         . htmlspecialchars($_SESSION['login_error']) 
         . '</div>';
    unset($_SESSION['login_error']);
}

$pageTitle = "Вход | FoodExpress";
ob_start();
?>

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Вход в аккаунт</h2>
        <p class="text-gray-600">Введите свои данные для входа</p>
    </div>
    
    <form action="auth.php" method="POST" class="space-y-6">
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
            Войти
        </button>
    </form>
    
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Нет аккаунта? 
            <a href="register.php" class="font-medium text-indigo-600 hover:text-indigo-500">Зарегистрируйтесь</a>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'template.php';

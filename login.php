<?php
$pageTitle = "Log in | FoodExpress";
ob_start();
?>
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Log in to your account</h2>
        <p class="text-gray-600">Enter your login details</p>
    </div>
    <form action="auth.php" method="POST" class="space-y-6">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" required 
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" required 
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>
        <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition shadow-md hover:shadow-lg">
            Log in
        </button>
    </form>
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Don't have an account? 
            <a href="register.php" class="font-medium text-indigo-600 hover:text-indigo-500">Register</a>
        </p>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'template.php';
?>

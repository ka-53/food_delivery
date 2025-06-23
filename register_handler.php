<?php
require 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Простая валидация
    if (!$name || !$email || !$password) {
        $_SESSION['reg_error'] = "Заполните все поля!";
        header("Location: register.php");
        exit;
    }

    // Проверка на существование email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['reg_error'] = "Пользователь с таким email уже существует.";
        header("Location: register.php");
        exit;
    }

    // Хешируем пароль
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Добавляем пользователя
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $hash, 'user']);

    $_SESSION['user_id'] = $pdo->lastInsertId();
    $_SESSION['user_name'] = $name;
    $_SESSION['role'] = 'user';

    header("Location: index.php");
    exit;
} else {
    header("Location: register.php");
    exit;
}

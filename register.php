<?php
require_once 'db.php'; // 📥 اتصال به دیتابیس
$pdo = getDBConnection(); // اتصال با PDO

// دریافت داده‌های فرم
$username = trim($_POST['username']);  // نام کاربری
$email = trim($_POST['email']);        // ایمیل
$password = $_POST['password'];        // رمز عبور

// بررسی خالی نبودن فیلدها
if (empty($username) || empty($email) || empty($password)) {
    die("⚠️ لطفاً همه فیلدها را پر کنید.");
}

// بررسی اینکه کاربر تکراری نباشد (نام کاربری یا ایمیل)
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
$stmt->execute(['username' => $username, 'email' => $email]);
if ($stmt->fetch()) {
    die("⚠️ نام کاربری یا ایمیل قبلاً ثبت شده است.");
}

// رمزنگاری رمز عبور
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// درج اطلاعات در جدول
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
$stmt->execute([
    'username' => $username,
    'email' => $email,
    'password' => $hashedPassword
]);

// هدایت به صفحه ورود
header("Location: login.html");
exit();
?>

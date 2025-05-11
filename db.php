<?php
// تنظیمات اتصال به پایگاه‌داده در WAMP
$host = 'localhost';       // آدرس سرور
$dbname = 'clothing_db';   // نام پایگاه‌داده
$user = 'root';            // نام کاربری پیش‌فرض
$pass = '';                // رمز عبور در WAMP معمولاً خالیه

try {
    // اتصال به پایگاه‌داده با PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // نمایش خطاها
} catch (PDOException $e) {
    die("خطا در اتصال: " . $e->getMessage()); // نمایش پیام خطا در صورت مشکل
}
?>

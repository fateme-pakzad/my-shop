<?php
session_start();
require_once 'db.php'; // 📥 فراخوانی تابع اتصال

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        $db = getDBConnection(); // اتصال با PDO

        // کوئری امن با prepared statement
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // سشن‌ها
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = ($user['admin'] == 1);

            // هدایت بر اساس نقش
            if ($_SESSION['admin']) {
                header("Location: products.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<script>alert('ایمیل یا رمز عبور اشتباه است'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        echo "خطا در پایگاه‌داده: " . $e->getMessage();
    }
}
?>

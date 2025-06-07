<?php
session_start();

// بررسی لاگین و ادمین بودن
if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: index.php");
    exit();
}

require_once 'db.php'; // 📥 فراخوانی تابع اتصال
$pdo = getDBConnection(); // اتصال PDO

// حذف محصول
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: products.php");
    exit();
}

// افزودن یا ویرایش محصول
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = $_POST['name'];
    $price = (float)$_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    if ($id > 0) {
        // ویرایش محصول
        $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, description = :description, image = :image WHERE id = :id");
        $stmt->execute([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $image,
            'id' => $id
        ]);
    } else {
        // افزودن محصول جدید
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image) VALUES (:name, :price, :description, :image)");
        $stmt->execute([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $image
        ]);
    }

    header("Location: products.php");
    exit();
}
?>

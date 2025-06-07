<?php
session_start();

// بررسی لاگین و ادمین بودن
if (!isset($_SESSION['username'])) {
    // اگر لاگین نکرده یا مدیر نیست، به صفحه ورود هدایت شود
    header("Location: login.html");
    exit();
}

// اگر دکمه خروج زده شد
if (isset($_POST['logout'])) {
  // نابود کردن تمام سشن‌ها
  session_unset();
  session_destroy();

  // هدایت به صفحه ورود
  header("Location: index.php");
  exit();
}


 require_once 'db.php';
 $pdo=getDBConnection();
 $stmt = $pdo->query("SELECT * FROM products");
 $products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>گالری محصولات</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f8ff;
      font-family: "IRANSans", sans-serif;
    }
    .gallery-title {
      color: #0d6efd;
      text-shadow: 1px 1px 2px #ccc;
    }
    .card-img-top {
      transition: transform 0.3s ease;
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }
    .card-img-top:hover {
      transform: scale(1.05);
    }
    .card {
      border: none;
      border-radius: 0.5rem;
      transition: box-shadow 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .product-title {
      font-size: 1.2rem;
      font-weight: bold;
      color: #0d6efd;
    }
    .product-price {
      color: #198754;
      font-weight: bold;
    }
    .product-desc {
      font-size: 0.9rem;
      color: #555;
    }
    .btn-buy {
      background-color: #0d6efd;
      color: white;
      font-weight: bold;
    }
    .btn-buy:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>
<!-- فرم دکمه خروج -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
      <form method="post" class="logout-btn">
        <button type="submit" name="logout" class="btn btn-danger">خروج</button>
      </form>
  </div>
 </nav>

  <div class="container py-5">
    <h2 class="text-center mb-5 gallery-title">گالری محصولات</h2>
    <div class="row g-4">

      <!-- نمونه محصول ۱ از ۱۰ -->
      <?php foreach ($products as $product): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100">
          <img src="assets/<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="product-title"><?= $product['name'] ?></h5>
            <p class="product-desc"><?= $product['description'] ?></p>
            <p class="product-price"><?= number_format($product['price']) ?> تومان</p>
            <button class="btn btn-buy mt-auto w-100">افزودن به سبد خرید</button>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

      <!-- همین قالب را کپی کن برای ۹ محصول دیگر و فقط تصویر، نام، توضیح و قیمت را تغییر بده -->

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

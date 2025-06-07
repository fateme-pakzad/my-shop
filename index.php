<?php
require_once 'db.php';
// صدا زدن تابع و گرفتن اتصال
$pdo = getDBConnection();
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>فروشگاه لباس من</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- استایل بوت‌استرپ -->
  <link href="styles/bootstrap.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; direction: rtl; }
    .card-title { color: #212529; font-weight: bold; }
    .footer { background: #212529; color: white; padding: 20px 0; text-align: center; }
    .navbar-brand { font-weight: bold; font-size: 22px; }
    .card {
  height: 100%;
  display: flex;
  flex-direction: column;
}

.card-img-top {
  height: 250px;
  object-fit: cover;
}

.card-body {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

  </style>
</head>
<body>

<!-- نوار بالای سایت -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">🧥 فروشگاه لباس مدرن</a>
    <div>
      <a class="btn btn-outline-light ms-2" href="register.html">ثبت‌نام</a>
      <a class="btn btn-outline-light" href="login.html">ورود</a>
      <a class="btn btn-outline-light" href="galary.php">گالری</a>
    </div>
  </div>
</nav>

<!-- اسلایدر -->
<div class="container-fluid px-0">
  <video class="w-100" autoplay muted loop playsinline>
    <source src="assets/ا.mp4" type="video/mp4">
    مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
  </video>
</div>


<!-- محصولات -->
<div class="container mt-5">
  <h2 class="text-center mb-4">محصولات ما</h2>
  <div class="row">

    <?php foreach ($products as $product): ?>
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <img src="assets/<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $product['name'] ?></h5>
            <p class="card-text"><?= $product['description'] ?></p>
            <p class="card-text text-success fw-bold">قیمت: <?= number_format($product['price']) ?> تومان</p>
            <a href="#" class="btn btn-primary">افزودن به سبد خرید</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<!-- فوتر -->
<?php include 'footer.html'; ?>

<!-- اسکریپت بوت‌استرپ -->
<script src="js/bootstrap.js"></script>

</body>
</html>

<?php
require_once 'db.php';
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
  </style>
</head>
<body>

<!-- نوار بالای سایت -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">🧥 فروشگاه لباس</a>
    <div>
      <a class="btn btn-outline-light ms-2" href="register.php">ثبت‌نام</a>
      <a class="btn btn-outline-light" href="login.php">ورود</a>
    </div>
  </div>
</nav>

<!-- اسلایدر -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/banner1.jpg" class="d-block w-100" alt="مد روز">
    </div>
    <div class="carousel-item">
      <img src="assets/banner2.jpg" class="d-block w-100" alt="لباس مردانه">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
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

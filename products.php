<?php
session_start();

// بررسی لاگین و ادمین بودن
if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    // اگر لاگین نکرده یا مدیر نیست، به صفحه ورود هدایت شود
    header("Location: index.php");
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

$conn = new mysqli("localhost", "root", "", "clothing_db");
$result = $conn->query("SELECT * FROM products");

$edit_data = null;
if (isset($_GET['edit'])) {
  $edit_id = (int)$_GET['edit']; // امن‌تر کردن ورودی
  $edit_res = $conn->query("SELECT * FROM products WHERE id = $edit_id");
  $edit_data = $edit_res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>پنل مدیریت محصولات</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #2196f3, #0d47a1);
      min-height: 100vh;
      padding: 30px 0;
      direction: rtl;
      font-family: 'Vazir', sans-serif;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      overflow: hidden;
    }

    h3 {
      color: #0d47a1;
      font-weight: bold;
    }

    .btn-custom {
      background-color: #2196f3;
      color: white;
      transition: 0.3s;
    }

    .btn-custom:hover {
      background-color: #0d47a1;
    }

    .form-control {
      border-radius: 10px;
    }

    .table th {
      background-color: #2196f3;
      color: white;
    }

    .product-img {
      border-radius: 10px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    /* استایل دکمه خروج */
    .logout-btn {
      position: fixed;
      top: 20px;
      left: 20px;
    }
  </style>
</head>
<body>

<!-- نوار بالا (navbar) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 mb-4">
  <div class="container-fluid">
    <span class="navbar-brand">پنل مدیریت</span>
    <div class="d-flex ms-auto">
      <a href="galary.php" class="btn btn-outline-light me-2">گالری</a>
      <form method="post" class="d-inline">
        <button type="submit" name="logout" class="btn btn-danger">خروج</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
  <div class="card p-4 bg-white">
    <h3 class="text-center mb-4">پنل مدیریت محصولات</h3>

    <!-- فرم محصول -->
    <form action="save_product.php" method="POST">
      <input type="hidden" name="id" value="<?= htmlspecialchars($edit_data['id'] ?? '') ?>">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">نام محصول</label>
          <input type="text" class="form-control" name="name" required value="<?= htmlspecialchars($edit_data['name'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label class="form-label">قیمت (تومان)</label>
          <input type="number" class="form-control" name="price" required value="<?= htmlspecialchars($edit_data['price'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label class="form-label">توضیحات</label>
          <input type="text" class="form-control" name="description" value="<?= htmlspecialchars($edit_data['description'] ?? '') ?>">
        </div>
        <div class="col-md-6">
          <label class="form-label">نام فایل تصویر (مثلاً product.jpg)</label>
          <input type="text" class="form-control" name="image" value="<?= htmlspecialchars($edit_data['image'] ?? '') ?>">
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-custom w-100"><?= isset($edit_data) ? 'ویرایش محصول' : 'افزودن محصول' ?></button>
        </div>
      </div>
    </form>

    <!-- جدول -->
    <hr class="my-4">
    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle bg-light">
        <thead>
          <tr>
            <th>شناسه</th>
            <th>نام</th>
            <th>قیمت</th>
            <th>توضیحات</th>
            <th>تصویر</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= number_format($row['price']) ?></td>
              <td><?= htmlspecialchars($row['description']) ?></td>
              <td><img src="assets/<?= htmlspecialchars($row['image']) ?>" width="60" class="product-img" alt="تصویر محصول"></td>
              <td>
                <a href="products.php?edit=<?= htmlspecialchars($row['id']) ?>" class="btn btn-sm btn-warning">ویرایش</a>
                <a href="save_product.php?delete=<?= htmlspecialchars($row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>

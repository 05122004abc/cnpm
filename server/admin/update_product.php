<?php

include '../configs/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit;
}

if (isset($_POST['update'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $stock = $_POST['stock'];
   $stock = filter_var($stock, FILTER_SANITIZE_STRING);
   $detail = $_POST['detail'];
   $detail = filter_var($detail, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, category_name = ?, price = ?, stock = ?, detail = ? WHERE id = ?");
   $update_product->execute([$name, $category, $price, $stock, $detail, $pid]);

   $message[] = 'Đã cập nhật sản phẩm!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../templates/uploaded_img/products_img/' . $image;

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $message[] = 'Hình ảnh quá lớn!';
      } else {
         $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if (file_exists('../templates/uploaded_img/products_img/' . $old_image)) {
            unlink('../templates/uploaded_img/products_img/' . $old_image);
         }
         $message[] = 'Đã cập nhật hình ảnh!';
      }
   }

   for ($i = 2; $i <= 5; $i++) {
      $image_key = 'image' . $i;
      if (!empty($_FILES[$image_key]['name'])) {
         $image_name = $_FILES[$image_key]['name'];
         $image_name = filter_var($image_name, FILTER_SANITIZE_STRING);
         $image_size = $_FILES[$image_key]['size'];
         $image_tmp_name = $_FILES[$image_key]['tmp_name'];
         $image_folder = '../templates/uploaded_img/products_img/' . $image_name;

         if ($image_size <= 2000000) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $update_images = $conn->prepare("UPDATE `product_images` SET image_url_$i = ? WHERE product_id = ?");
            $update_images->execute([$image_name, $pid]);
         } else {
            $message[] = "Hình ảnh $i quá lớn!";
         }
      }
   }
}

// Query to select all rows from the category table
$sql = "SELECT category_name FROM category";

try {
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   echo "Query failed: " . $e->getMessage();
   exit;
}

if (!isset($_GET['update']) || empty($_GET['update'])) {
   echo "Không tìm thấy sản phẩm để cập nhật!";
   exit;
}

$update_id = $_GET['update'];
$show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
$show_products->execute([$update_id]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="../templates/uploaded_img/admin_img/user.png">
   <title>Cập nhật sản phẩm</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../templates/css/admin_style.css">
</head>
<?php include '../configs/admin_header.php'; ?>

<body>

   <?php include '../configs/slider.php'; ?>

   <section class="update-product">
      <h1 class="heading">Cập nhật sản phẩm</h1>

      <?php
      if ($show_products->rowCount() > 0) {
         while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
               <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
               <img src="../templates/uploaded_img/products_img/<?= $fetch_products['image']; ?>" alt="Sản phẩm">
               <span>Tên</span>
               <input type="text" required placeholder="Nhập tên sản phẩm" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
               <span>Giá</span>
               <input type="number" min="0" required placeholder="Nhập giá" name="price" class="box" value="<?= $fetch_products['price']; ?>">
               <span>Số lượng</span>
               <input type="number" min="0" required placeholder="Nhập số lượng" name="stock" class="box" value="<?= $fetch_products['stock']; ?>">
               <span>Danh mục</span>
               <select name="category" class="box" required>
                  <option value="" disabled>Loại sản phẩm --</option>
                  <?php foreach ($categories as $category) { ?>
                     <option value="<?= $category['category_name']; ?>" <?= $category['category_name'] == $fetch_products['category_name'] ? 'selected' : ''; ?>>
                        <?= $category['category_name']; ?>
                     </option>
                  <?php } ?>
               </select>
               <span>Hình ảnh</span>
               <input type="file" name="image" class="box" accept="image/*">
               <input type="file" name="image2" class="box" accept="image/*">
               <input type="file" name="image3" class="box" accept="image/*">
               <input type="file" name="image4" class="box" accept="image/*">
               <input type="file" name="image5" class="box" accept="image/*">
               <textarea required placeholder="Miêu tả sản phẩm" name="detail" class="box"><?= $fetch_products['detail']; ?></textarea>
               <div class="flex-btn">
                  <input type="submit" value="Cập nhật" class="btn" name="update">
                  <a href="products.php" class="option-btn">Trở lại</a>
               </div>
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">Không tìm thấy sản phẩm!</p>';
      }
      ?>

   </section>

   <script src="../templates/js/admin_script.js"></script>
</body>

</html>

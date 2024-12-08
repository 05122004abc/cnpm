<?php
if (isset($_POST['add_to_cart'])) {
   if ($user_id == '') {
      header('location:login.php');
   } else {
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
      // Kiểm tra xem $_SESSION['cart'] đã được tạo hay chưa
      if (!isset($_SESSION['cart'])) {
         $_SESSION['cart'] = array(); // Nếu chưa, thì tạo một mảng rỗng
      }
      $product_already_in_cart = false;
      foreach ($_SESSION['cart'] as $key => $cart_item) {
         if ($cart_item['pid'] == $pid) {
            // Nếu sản phẩm đã tồn tại, kiểm tra số lượng tồn kho
            $new_qty = $cart_item['qty'] + $qty;
            if ($new_qty > getStockQuantity($pid)) {
               // Số lượng trong giỏ lớn hơn số lượng tồn kho
               $message[] = 'Không thể thêm sản phẩm vào giỏ hàng do số lượng tồn kho không đủ.';
            } else {
               // Số lượng trong giỏ không vượt quá số lượng tồn kho, tăng số lượng sản phẩm trong giỏ
               $_SESSION['cart'][$key]['qty'] = $new_qty;
               $message[] = 'Số lượng sản phẩm trong giỏ hàng đã được cập nhật.';
            }
            $product_already_in_cart = true;
            break;
         }
      }

      // Nếu sản phẩm chưa tồn tại trong giỏ hàng và số lượng tồn kho đủ, thêm sản phẩm mới vào giỏ hàng
      if (!$product_already_in_cart) {
         if ($qty > getStockQuantity($pid)) {
            $message[] = 'Không thể thêm sản phẩm vào giỏ hàng do số lượng tồn kho không đủ.';
         } else {
            $_SESSION['cart'][] = [
               'pid' => $pid,
               'name' => $name,
               'price' => $price,
               'image' => $image,
               'qty' => $qty
            ];
            $message[] = 'Đã thêm vào giỏ hàng!';
         }
      }
   }
}

function getStockQuantity($pid)
{
   // Kết nối đến cơ sở dữ liệu
   include 'configs/connect.php';

   // Truy vấn để lấy số lượng tồn kho của sản phẩm dựa trên $pid
   $stmt = $conn->prepare("SELECT stock FROM products WHERE id = :pid");
   $stmt->bindParam(':pid', $pid);
   $stmt->execute();

   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   return $row['stock'];
}

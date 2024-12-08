<?php
include 'connect.php';
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}



// Kiểm tra xem giỏ hàng đã được khởi tạo chưa
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Tính tổng số lượng sản phẩm trong giỏ hàng
$totalQuantity = 0;
foreach ($_SESSION['cart'] as $cartItem) {
    $totalQuantity += $cartItem['qty'];
}

?>



<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">TEABILL</a>

      <nav class="navbar">
         <a href="home.php">Trang chủ</a>
         <a href="about.php">Chúng tôi</a>
         <a href="menu.php">Thực đơn</a>
         <?php if (isset($user_id)) : ?>
            <a href="orders_all.php">Đơn hàng</a>
         <?php endif; ?>
         <a href="contact.php">Phản hồi</a>
      </nav>

      <div class="icons">
        

         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $totalQuantity; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php if (isset($user_id)) : ?>
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE user_id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
               <p class="name"><?= $fetch_profile['name']; ?></p>
               <div class="flex">
                  <a href="profile.php" class="btn">Thông tin tài khoản </a>
                  <a href="configs/user_logout.php" onclick="return confirm('Bạn muốn đăng xuất khỏi trang web?');" class="delete-btn">Đăng xuất</a>
               </div>
               <p class="account">
                  <a href="login.php">Đăng nhập</a> hoặc
                  <a href="register.php">Đăng ký</a>
               </p>
            <?php
            } else {
            ?>
               <p class="name">Đăng nhập lần đầu </p>
               <a href="login.php" class="btn">Đăng nhập</a>
            <?php
            }
            ?>
         <?php else : ?>
            <p class="name">Đăng nhập lần đầu</p>
            <a href="login.php" class="btn">Đăng nhập</a>
         <?php endif; ?>
      </div>
   </section>

</header>
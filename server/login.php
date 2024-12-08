<?php

include 'configs/connect.php'; // Kết nối cơ sở dữ liệu

session_start();

// Kiểm tra nếu session user_id đã tồn tại
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

// Số lần đăng nhập không thành công được phép
$maxLoginAttempts = 5;

$message = []; // Biến lưu thông báo lỗi hoặc thành công

if (isset($_POST['submit'])) {
    // Lấy thông tin từ form
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Lọc email để tránh ký tự không hợp lệ
    $password = $_POST['pass']; // Lấy mật khẩu dạng plain text

    // Kiểm tra dữ liệu nhập vào (debug)
    echo "Email nhập vào: $email<br>";
    echo "Mật khẩu nhập vào: $password<br>";

    // Truy vấn kiểm tra tài khoản
    $stmt = $conn->prepare("SELECT user_id, status, password FROM `users` WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // Lấy thông tin từ cơ sở dữ liệu
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $db_password = $user_data['password']; // Mật khẩu trong DB
        $status = $user_data['status']; // Trạng thái tài khoản
        $user_id = $user_data['user_id']; // ID người dùng

        echo "Mật khẩu trong DB: $db_password<br>";
        echo "Trạng thái tài khoản: $status<br>";

        // Kiểm tra số lần đăng nhập không thành công
        if (!isset($_SESSION['login_attempts'][$user_id])) {
            $_SESSION['login_attempts'][$user_id] = 0; // Khởi tạo số lần đăng nhập thất bại
        }

        if ($_SESSION['login_attempts'][$user_id] >= $maxLoginAttempts) {
            // Nếu vượt quá số lần cho phép, khóa tài khoản
            $message[] = "Tài khoản của bạn đã bị khóa do quá số lần đăng nhập không thành công.";

            // Cập nhật trạng thái tài khoản trong cơ sở dữ liệu
            $updateStatus = $conn->prepare("UPDATE `users` SET status = 'block' WHERE user_id = ?");
            $updateStatus->execute([$user_id]);

            $_SESSION['login_attempts'][$user_id] = 0; // Đặt lại số lần đăng nhập sai
        } elseif ($password === $db_password) {
            if ($status === 'active') {
                // Đăng nhập thành công
                $_SESSION['login_attempts'][$user_id] = 0; // Đặt lại số lần đăng nhập sai
                $_SESSION['user_id'] = $user_id; // Lưu user_id vào session

                // Ngăn chặn tấn công session fixation
                session_regenerate_id(true);

                // Lưu lịch sử đăng nhập
                $ip_address = $_SERVER['REMOTE_ADDR']; // Lấy IP người dùng
                $insertHistory = $conn->prepare("INSERT INTO `user_login_history` (user_id, login_time, ip_address) VALUES (?, NOW(), ?)");
                $insertHistory->execute([$user_id, $ip_address]);

                // Chuyển hướng về trang chủ
                header('location: home.php');
                exit();
            } else {
                $message[] = "Tài khoản của bạn đã bị khóa.";
            }
        } else {
            // Sai mật khẩu
            $_SESSION['login_attempts'][$user_id]++;
            $message[] = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
    } else {
        $message[] = "Không tìm thấy tài khoản!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" href="templates/uploaded_img/system_img/logo.png">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="templates/css/style.css">

</head>

<body>
   <?php include 'configs/user_header.php'; ?>




   <section class="form-container">

      <form action="" method="post">
         <h3>Đăng nhập ngay </h3>
         <input type="email" name="email" required placeholder="Nhập gmail" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" required placeholder="Nhập mật khẩu" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">

         <input type="submit" value="Đăng nhập" name="submit" class="btn">
         <p>Bạn không có tài khoản ? <a href="register.php">Đăng ký ngay </a></p>
         <p><a href="reset_pass.php">Quên mật khẩu </a></p>
      </form>

   </section>











   <?php include 'configs/user_footer.php'; ?>






   <!-- custom js file link  -->
   <script src="templates/js/script.js"></script>

</body>

</html>
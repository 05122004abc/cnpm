<?php
if (isset($conn)) {
    // Lấy giá trị role từ bảng users
    $sql = "SELECT role FROM admin WHERE id = :admin_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();
    $roleData = $stmt->fetch(PDO::FETCH_ASSOC);
    $role = $roleData['role'];

    switch ($role) {
        case "1":
            echo '<nav>
                <div class="main"></div>
                <a href="dashboard.php" class="logo">
                    <i class="fas fa-home"></i> <!-- Home icon -->
                    <span> HOME </span>
                </a>
                <div class="main-link">Tài khoản</div>
                <div class="sub-links">
                    <a class="sub-link" href="create_admin.php">- Tạo tài khoản nhân viên</a>
                    <a class="sub-link" href="admin_accounts.php">- Danh sách tài khoản nhân viên</a>
                    <a class="sub-link" href="users_accounts.php">- Danh sách tài khoản người dùng</a>
                </div>

                <div class="main-link">Lịch sử đăng nhập</div>
                <div class="sub-links">
                    <a class="sub-link" href="admin_login_history.php">- Lịch sử đăng nhập admin</a>
                    <a class="sub-link" href="user_login_history.php">- Lịch sử đăng nhập users</a>
                </div>
            </nav>';
            break;
        case "2":
            echo '<nav>
                    <div class="main"></div>
                    <a href="dashboard.php" class="logo">
                        <i class="fas fa-home"></i> <!-- Home icon -->
                        <span> HOME </span>
                    </a>
                    <div class="main-link">Danh mục</div>
                    <div class="sub-links">
                        <a class="sub-link" href="add_category.php">- Tạo danh mục</a>
                        <a class="sub-link" href="category.php">- Danh sách danh mục</a>
                    </div>
                    <div class="main-link">Sản phẩm</div>
                    <div class="sub-links">
                        <a class="sub-link" href="add_products.php">- Tạo sản phẩm mới</a>
                        <a class="sub-link" href="products.php">- Danh sách sản phẩm</a>
                    </div>
                    <div class="main-link">Slider</div>
                    <div class="sub-links">
                        <a class="sub-link" href="add_slider.php">- Tạo slider mới</a>
                        <a class="sub-link" href="slider.php">- Danh sách slider</a>
                    </div>
                    <div class="main-link">Giảm giá</div>
                    <div class="sub-links">
                        <a class="sub-link" href="add_sale.php">- Tạo ct giảm giá </a>
                        <a class="sub-link" href="sale.php">- Danh sách ct giảm giá</a>
                    </div>       
                </nav>';
            break;
        case "3":
            echo '<nav>
                        <div class="main"></div>
                        <a href="dashboard.php" class="logo">
                            <i class="fas fa-home"></i> <!-- Home icon -->
                            <span> HOME </span>
                        </a>
                        <div class="main-link">Đơn hàng</div>
                        <div class="sub-links">
                            <a class="sub-link" href="orders_wait.php">1-Đơn chờ xác nhận</a>
                            <a class="sub-link" href="orders_completed.php">2-Đơn xác nhận</a>
                            <a class="sub-link" href="orders_sent.php">3-Đơn đã gửi</a>
                            <a class="sub-link" href="orders_finish.php">4-Đơn hoàn thành</a>
                            <a class="sub-link" href="orders_cancel.php">5-Đơn bị hủy</a>
                        </div>           
                        <div class="main-link">Phản hồi khách hàng</div>
                        <div class="sub-links">
                            <a class="sub-link" href="review_product.php">- Đánh giá của khách hàng</a>
                            <a class="sub-link" href="messages.php">- Phản hổi khách hàng</a>
                        </div>
                    </nav>';
            break;
        default:
            // Xử lý trường hợp mặc định ở đây nếu cần
            break;
    }
} else {
    echo "Tài khoản chưa được phân quyền.";
}
?>


<script>
    const mainLinks = document.querySelectorAll('.main-link');
    const subLinks = document.querySelectorAll('.sub-links');
    const linkStatus = new Array(mainLinks.length).fill(false);

    mainLinks.forEach((mainLink, index) => {
        mainLink.addEventListener('click', () => {
            mainLinks.forEach((link, i) => {
                if (i === index) {
                    if (linkStatus[i]) {
                        linkStatus[i] = false;
                        link.classList.remove('active');
                        subLinks[i].classList.remove('show');
                    } else {
                        linkStatus[i] = true;
                        link.classList.add('active');
                        subLinks[i].classList.add('show');
                    }
                } else {
                    linkStatus[i] = false;
                    link.classList.remove('active');
                    subLinks[i].classList.remove('show');
                }
            });
        });
    });
</script>
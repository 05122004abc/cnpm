<?php
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
?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admins accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../templates/css/admin_style.css">
   <style>
      /* CSS cho tiêu đề "Admin Table" */
      .heading {
         text-align: center;
         margin-bottom: 2rem;
         text-transform: capitalize;
         color: var(--black);
         font-size: 3rem;
      }

      /* CSS cho bảng */
      .admin-table {
         max-width: 1200px;
         margin: 0 auto;
         border: var(--border);
         /* Viền bảng */
         border-collapse: collapse;
         /* Loại bỏ khoảng trắng giữa các ô */
         width: 100%;
      }

      /* CSS cho hàng tiêu đề */
      .admin-table th {
         background-color: var(--light-bg);
         color: var(--black);
         border: var(--border);
         /* Viền của ô tiêu đề */
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
         font-weight: bold;
         text-transform: capitalize;
      }

      /* CSS cho các hàng dữ liệu */
      .admin-table td {
         background-color: var(--white);
         color: var(--black);
         border: var(--border);
         /* Viền của ô dữ liệu */
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
      }

      /* CSS cho nút Edit và Delete */
      .admin-table a {
         text-decoration: none;
         color: var(--main-color);
         margin: 0 1rem;
         cursor: pointer;
      }

      .admin-table a:hover {
         color: var(--black);
      }

      /* CSS cho phần tử có class "stock" */
      .stock {
         font-size: 1.8rem;
         /* Kích thước chữ */
         color: var(--main-color);
         /* Màu chữ */
         font-weight: bold;
         /* Độ đậm của chữ */
         text-transform: capitalize;
         /* Chuyển đổi chữ thành chữ hoa */
         margin: 1rem 0;
         /* Khoảng cách trên và dưới */
      }

      /* CSS cho phần tử có class "add-category" */
      .add-category {
         display: flex;
         align-items: center;
         justify-content: center;
         min-height: 100vh;
      }

      /* CSS cho bảng form */
      .add-category form {
         background-color: var(--white);
         border-radius: 0.5rem;
         box-shadow: var(--box-shadow);
         border: var(--border);
         padding: 2rem;
         text-align: center;
         width: 50rem;
      }

      /* CSS cho tiêu đề "add product" */
      .add-category form h3 {
         font-size: 2.5rem;
         color: var(--black);
         text-transform: capitalize;
         margin-bottom: 1rem;
      }

      /* CSS cho các input */
      .add-category form .box {
         width: 100%;
         background-color: var(--light-bg);
         padding: 1.4rem;
         font-size: 1.8rem;
         color: var(--black);
         margin: 1rem 0;
         border: var(--border);
         border-radius: 0.5rem;
      }

      /* CSS cho nút "add category" */
      .add-category form .btn {
         background-color: var(--main-color);
         border: none;
         border-radius: 0.5rem;
         cursor: pointer;
         width: 100%;
         font-size: 1.8rem;
         color: var(--white);
         padding: 1.2rem 3rem;
         text-transform: capitalize;
         text-align: center;
         margin-top: 1rem;
      }

      .add-category form .btn:hover {
         background-color: var(--black);
      }

      /* CSS cho tùy chỉnh file input */
      .add-category form input[type="file"] {
         background-color: var(--light-bg);
         padding: 1.4rem;
         font-size: 1.8rem;
         color: var(--black);
         margin: 1rem 0;
         border: var(--border);
         border-radius: 0.5rem;
      }

      /* CSS cho bảng có class "category" */
      .category {
         max-width: 1200px;
         margin: 0 auto;
         border: var(--border);
         /* Viền bảng */
         border-collapse: collapse;
         /* Loại bỏ khoảng trắng giữa các ô */
         width: 100%;
      }

      /* CSS cho hàng tiêu đề */
      .category th {
         background-color: var(--light-bg);
         color: var(--black);
         border: var(--border);
         /* Viền của ô tiêu đề */
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
         font-weight: bold;
         text-transform: capitalize;
      }

      /* CSS cho các hàng dữ liệu (các ô dữ liệu) */
      .category td {
         background-color: var(--white);
         color: var(--black);
         border: var(--border);
         /* Viền của ô dữ liệu */
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
      }

      /* CSS cho nút Delete */
      .category a {
         text-decoration: none;
         color: var(--main-color);
         cursor: pointer;
         margin: 0 1rem;
      }

      .category a:hover {
         color: var(--black);
      }

      /* CSS cho phần tử .form-container */
      .form-container {
         display: flex;
         align-items: center;
         justify-content: center;
         min-height: 100vh;
      }

      /* CSS cho bảng */
      .form-container form {
         background-color: var(--white);
         border-radius: 0.5rem;
         box-shadow: var(--box-shadow);
         border: var(--border);
         padding: 2rem;
         text-align: center;
         width: 50rem;
      }

      /* CSS cho tiêu đề "update profile" */
      .form-container form h3 {
         font-size: 2.5rem;
         color: var(--black);
         text-transform: capitalize;
         margin-bottom: 1rem;
      }

      /* CSS cho các label */
      .form-container form label {
         font-size: 1.8rem;
         color: var(--black);
         margin-bottom: 0.5rem;
         display: block;
         text-align: left;
      }

      /* CSS cho các dropdown/select */
      .form-container form .drop-down {
         width: 100%;
         background-color: var(--light-bg);
         padding: 1.4rem;
         font-size: 1.8rem;
         color: var(--black);
         margin: 1rem 0;
         border: var(--border);
         border-radius: 0.5rem;
      }

      /* CSS cho các input */
      .form-container form .box {
         width: 100%;
         background-color: var(--light-bg);
         padding: 1.4rem;
         font-size: 1.8rem;
         color: var(--black);
         margin: 1rem 0;
         border: var(--border);
         border-radius: 0.5rem;
      }

      /* CSS cho nút "update now" */
      .form-container form .btn {
         background-color: var(--main-color);
         border: none;
         border-radius: 0.5rem;
         cursor: pointer;
         width: 100%;
         font-size: 1.8rem;
         color: var(--white);
         padding: 1.2rem 3rem;
         text-transform: capitalize;
         text-align: center;
         margin-top: 1rem;
      }

      .form-container form .btn:hover {
         background-color: var(--black);
      }

      /* CSS cho nút "Chỉnh sửa" */
      td a {
         text-decoration: none;
         color: var(--main-color);
         cursor: pointer;
         margin-right: 1rem;
         /* Khoảng cách với nút "Xóa" */
      }

      td a:hover {
         color: var(--black);
      }

      /* CSS cho nút "Xóa" */
      td form {
         display: inline;
         /* Hiển thị các form trên cùng một dòng */
      }

      td input[type="submit"] {
         background-color: var(--red);
         border: none;
         border-radius: 0.5rem;
         cursor: pointer;
         font-size: 1.8rem;
         color: var(--white);
         padding: 0.8rem 1.2rem;
         text-transform: capitalize;
      }

      td input[type="submit"]:hover {
         background-color: var(--black);
      }


      .search-bar {
         display: flex;
         justify-content: flex-end;
         border: 1px solid #ccc;
         border-radius: 15px;
         padding: 0 10px;
         /* Điều chỉnh lề trái và phải */
         height: 50px;
         max-width: 400px;
         /* Giới hạn chiều ngang */
         /* Giới hạn chiều cao */
      }

      .box {
         margin: 0 5px;
         padding: 5px;
         border: none;
         border-radius: 5px;
         height: 100%;
         /* Tự động điều chỉnh chiều cao để phù hợp với .search-bar */
      }

      .btn {
         padding: 5px 10px;
         border: none;
         border-radius: 5px;
         background-color: #007bff;
         color: white;
         cursor: pointer;
         height: 100%;
         /* Tự động điều chỉnh chiều cao để phù hợp với .search-bar */
      }

      .search-bar {
         border: 1px solid black;
         border-radius: 5px;
         margin: 30px 10px 10px 10px;
         /* This margin will add space above the search bar */
         padding: 10px;
         float: right;
      }

      .box {
         border: 1px solid #333;
         /* Thay #your_border_color bằng mã màu viền bạn muốn sử dụng */
         border-radius: 5px;
         /* Tùy chỉnh độ cong của góc phần tử nếu cần */
         padding: 5px;
         /* Điều này giữ kích thước của phần tử không thay đổi */
      }

      #searchButton {
         background-color: #007bff;
         font-size: 18px;
         border: 1px solid #333;
         /* Thay #your_border_color bằng mã màu viền bạn muốn sử dụng */
         padding: 5px 10px;
         border-radius: 5px;
         color: #fff;
      }






      .pagination {
         display: flex;
         list-style: none;
         padding: 0;
         margin: 20px 0;
         justify-content: center;
         /* Căn giữa số thứ tự trang */
      }

      .pagination-link {
         text-decoration: none;
         padding: 5px 10px;
         border: 1px solid #ccc;
         margin: 2px;
         color: #333;
         transition: background-color 0.3s, color 0.3s;
      }

      .pagination-link.current-link {
         background-color: #007bff;
         color: #fff;
      }

      .pagination-link:hover {
         background-color: #007bff;
         color: #fff;
      }

      /* CSS cho tiêu đề "Phản hồi Khách hàng" */
      a {
         text-decoration: none;
         color: var(--main-color);
         /* Màu chữ cho link "Phản hồi Khách hàng" */
         font-size: 2rem;
         /* Kích thước chữ */
         /* Nếu bạn muốn thay đổi kiểu chữ hoặc thêm hiệu ứng hover, bạn có thể tùy chỉnh thêm ở đây */
      }

      a:hover {
         color: var(--black);
         /* Màu chữ khi di chuột qua link */
      }

      /* CSS cho bảng table_slider dựa trên CSS hiện có */

      /* CSS cho bảng */
      .table_slider {
         max-width: 1200px;
         margin: 0 auto;
         border: var(--border);
         border-collapse: collapse;
         width: 100%;
      }

      /* CSS cho hàng tiêu đề */
      .table_slider th {
         background-color: var(--light-bg);
         color: var(--black);
         border: var(--border);
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
         font-weight: bold;
         text-transform: capitalize;
      }

      /* CSS cho các hàng dữ liệu */
      .table_slider td {
         background-color: var(--white);
         color: var(--black);
         border: var(--border);
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
      }

      /* CSS cho nút Edit và Delete */
      .table_slider a {
         text-decoration: none;
         color: var(--main-color);
         margin: 0 1rem;
         cursor: pointer;
      }

      .table_slider a:hover {
         color: var(--black);
      }


      .table_slider img {
         max-width: 100px;
         /* Điều chỉnh kích thước tối đa của hình ảnh */
         height: auto;
         /* Đảm bảo tỷ lệ khung hình bảo toàn */
      }

      /* Tùy chỉnh màu sắc và kiểu hiển thị của nút xóa */
      .fas.fa-trash {
         color: red;
         /* Màu của biểu tượng xóa */
         cursor: pointer;
         /* Hiển thị icon chuột khi di chuột qua nút */
      }

      /* CSS cho bảng table_category dựa trên CSS hiện có */
      .table-category {
         max-width: 1200px;
         margin: 0 auto;
         border: var(--border);
         border-collapse: collapse;
         width: 100%;
      }

      /* CSS cho hàng tiêu đề */
      .table-category th {
         background-color: var(--light-bg);
         color: var(--black);
         border: var(--border);
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
         font-weight: bold;
         text-transform: capitalize;
      }

      /* CSS cho các hàng dữ liệu */
      .table-category td {
         background-color: var(--white);
         color: var(--black);
         border: var(--border);
         text-align: center;
         padding: 1rem;
         font-size: 1.8rem;
      }

      /* CSS cho nút Edit và Delete */
      .table-category a {
         text-decoration: none;
         color: var(--main-color);
         margin: 0 1rem;
         cursor: pointer;
      }

      .table-category a:hover {
         color: var(--black);
      }

      /* CSS cho hình ảnh */
      .table-category img {
         max-width: 100px;
         /* Điều chỉnh kích thước tối đa của hình ảnh */
         height: auto;
         /* Đảm bảo tỷ lệ khung hình bảo toàn */
      }

      /* Tùy chỉnh màu sắc và kiểu hiển thị của nút xóa */
      .table-category .fas.fa-trash {
         color: red;
         /* Màu của biểu tượng xóa */
         cursor: pointer;
         /* Hiển thị icon chuột khi di chuột qua nút */
      }

      /* CSS cho tiêu đề "Danh mục" */
      /* CSS cho tiêu đề "Danh mục" để căn giữa theo chiều ngang và dọc */
      h3 {
         font-size: 2.5rem;
         color: var(--black);
         text-transform: capitalize;
         margin: 0;
         /* Loại bỏ khoảng trắng ngoài cùng của phần tử */
         text-align: center;
         /* Căn giữa theo chiều ngang */
         line-height: 2.5rem;
         /* Căn giữa theo chiều dọc (dựa trên kích thước font) */
         padding: 1rem 0;
         /* Tạo khoảng cách ở trên và dưới tiêu đề */
      }
   </style>

</head>


<header class="header">

   <section class="flex">


      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Cập nhật thông tin</a>
         <div class="flex-btn">
         </div>
         <a href="../configs/admin_logout.php" onclick="return confirm('Bạn muốn đăng xuất ');" class="delete-btn">Đăng xuất</a>
      </div>

   </section>

</header>
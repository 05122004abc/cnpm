-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2024 lúc 04:26 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `food_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `role`, `status`) VALUES
(1, 'admin', 'thanh2k4', '1', 'active'),
(11, 'QL1', 'Thuan2k4', '2', 'active'),
(33, 'nv', 'hieu2k4', '3', 'active');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_login_history`
--

CREATE TABLE `admin_login_history` (
  `id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_login_history`
--

INSERT INTO `admin_login_history` (`id`, `admin_id`, `login_time`, `ip_address`) VALUES
(72, 1, '2024-04-28 00:39:04', '::1'),
(73, 1, '2024-05-08 03:49:42', '::1'),
(74, 1, '2024-05-08 04:31:51', '::1'),
(75, 1, '2024-12-08 12:36:19', '::1'),
(76, 1, '2024-12-08 14:08:57', '::1'),
(77, 1, '2024-12-08 14:46:30', '::1'),
(78, 1, '2024-12-08 14:49:04', '::1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `category_name`, `image`) VALUES
(18, 'Trà sữa', 'bubble-tea.png'),
(19, 'Bánh ngọt', 'cake.png'),
(20, 'Đồ ăn nhanh', 'cat-1.png'),
(21, 'Nước giải khác', 'cat-3.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 52, 'Thuàn Phuc', 'Thuan@gmail.com', '1231231232', '=))'),
(4, 79, 'admin', 'ph5208352@gmail.com', '0901234567', 'ădawdwa'),
(6, 79, 'hiếu dương', 'dươnghieu@gmail.com', '0126699669', 'ngon lắm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `VAT` int(100) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'wait',
  `order_status` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `VAT`, `placed_on`, `payment_status`, `order_status`, `note`) VALUES
(57, 84, 'Trần Thị Ngọc Huyền ', '0123456789', 'huyenit200x@gmail.com', 'cash on delivery', '1, 1, 1, , , ', 'Trà sữa khoai môn (24000 x 1) - Bánh croisant (19500 x 1) - ', 39150, 4350, '2024-05-08 11:11:54', 'finish', NULL, NULL),
(58, 84, 'Trần Thị Ngọc Huyền ', '0123456789', 'huyenit200x@gmail.com', 'cash on delivery', '1, 1, 1, , , ', 'Trà sữa khoai môn (30000 x 2) - ', 66000, 6000, '2024-05-08 11:32:41', 'sent', NULL, NULL),
(60, 50, 'Le Huu THanh', '0123456789', 'thanh10b6@gmail.com', 'cash on delivery', '1, 1, 1, , , ', 'Trà sữa khoai môn (30000 x 2) - ', 66000, 6000, '2024-05-08 11:32:41', 'sent', NULL, NULL),
(61, 50, 'Lê Hữu THánh', '0904444444', 'thanh10b6@gmail.com', 'cash on delivery', 'QT', 'Trà sữa khoai môn (30000 x 1) - ', 33000, 3000, '2024-12-08 22:02:42', 'wait', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_name`, `price`, `stock`, `detail`, `image`) VALUES
(35, 'Bánh croisant', 'Đồ ăn nhanh', 30000, 173, 'Bánh sừng bò còn được gọi là bánh croa-xăng, có nguồn gốc từ Áo, là một dạng bánh ăn sáng làm từ pâte feuilletée, được sản xuất từ bột mì, men, bơ, sữa, và muối. Bánh croissant đúng kiểu phải thật xốp, giòn và có thể xé ra từng lớp mỏng nhỏ. Bên trong ruộ', 'cr5.jpg'),
(36, 'Trà sữa khoai môn', 'Trà sữa', 30000, 163, 'Hương vị Khoai Môn được hòa cùng với sữa tạo nên thức uống thơm béo.', 'km5.png'),
(37, 'Khoai tây chiên', 'Đồ ăn nhanh', 25000, 0, 'ngon', 'pizza-1.png'),
(38, 'Bánh flan', 'Bánh ngọt', 15000, 287, 'Bánh flan hay gọi thẳng theo tiếng Việt là bánh lăng hay caramen là loại bánh được hấp chín từ các nguyên liệu chính là trứng và sữa, caramel. Đây là một loại bánh xuất xứ từ nền ẩm thực châu Âu tuy hiện nay đã phổ biến tại nhiều nơi trên thế giới.', 'plan3.png'),
(39, 'Trà sữa socola', 'Trà sữa', 30000, 184, 'Trà sữa trân châu socola sẽ là một gợi ý hay để bạn thể hiện tình yêu đong đầy với nửa kia của mình.', 'socola2.jpg'),
(40, 'Bánh Muffin', 'Bánh ngọt', 25000, 194, 'Bánh nướng xốp là một sản phẩm nướng được chia thành từng phần riêng lẻ; tuy nhiên, thuật ngữ này có thể đề cập đến một trong hai mặt hàng riêng biệt: bánh mì dẹt có phần nổi lên được nướng và sau đó nấu trên vỉ nướng hoặc bánh mì nhanh được lên men hóa h', 'Ảnh chụp màn hình 2023-11-15 003351.png'),
(41, 'Trà vải', 'Nước giải khác', 20000, 293, 'Trà vải với vị ngọt thanh của vải, hòa trộn cùng chút chua chua của chanh, hương trà thơm nhẹ nhàng tao nhã tạo nên món uống hấp dẫn mọi lứa tuổi. Những quả vải căng tròn, mọng nước trên bề mặt, đặc biệt có khả năng giải khát, tiếp thêm năng lượng cho cơ ', 'Ảnh chụp màn hình 2023-11-15 003605.png'),
(42, 'Trà chanh xã', 'Nước giải khác', 25000, 297, 'Trà chanh sả là món thức uống thơm ngon, thanh nhiệt, giải cảm và hỗ trợ tăng sức đề kháng cao.', 'Ảnh chụp màn hình 2023-11-15 003900.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `image_url_2` varchar(255) DEFAULT NULL,
  `image_url_3` varchar(255) DEFAULT NULL,
  `image_url_4` varchar(255) DEFAULT NULL,
  `image_url_5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url_2`, `image_url_3`, `image_url_4`, `image_url_5`) VALUES
(11, 35, 'cr1.png', 'cr2.jpg', 'cr3.jpg', 'cr4.png'),
(12, 36, 'km1.png', 'km2.jpg', 'km3.jpg', 'Ảnh chụp màn hình 2023-11-15 002123.png'),
(13, 37, 'pizza-2.png', 'pizza-4.png', 'pizza-5.png', 'pizza-5.png'),
(14, 38, 'plan4.png', 'plan5.png', 'plan1.png', 'plan2.jpg'),
(15, 39, 'socola4.jpg', 'socola3.jpg', 'socola5.png', 'sosola1.png'),
(16, 40, 'Ảnh chụp màn hình 2023-11-15 003336.png', 'Ảnh chụp màn hình 2023-11-15 003324.png', 'Ảnh chụp màn hình 2023-11-15 003310.png', 'Ảnh chụp màn hình 2023-11-15 003440.png'),
(17, 41, 'Ảnh chụp màn hình 2023-11-15 003543.png', 'Ảnh chụp màn hình 2023-11-15 003615.png', 'Ảnh chụp màn hình 2023-11-15 003557.png', 'Ảnh chụp màn hình 2023-11-15 003745.png'),
(18, 42, 'Ảnh chụp màn hình 2023-11-15 003848.png', 'Ảnh chụp màn hình 2023-11-15 003836.png', 'Ảnh chụp màn hình 2023-11-15 003828.png', 'Ảnh chụp màn hình 2023-11-15 003818.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `rating` int(5) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_order` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`, `status`, `id_order`) VALUES
(46, 35, 79, 5, '5', '2023-11-15 07:02:16', 'active', 19),
(48, 38, 79, 3, '3', '2023-11-15 07:02:24', 'active', 19),
(49, 39, 79, 4, '4', '2023-11-15 07:02:29', 'active', 19),
(56, 36, 80, 5, 'rất ngon ', '2023-12-04 11:51:42', 'active', 53),
(57, 36, 80, 3, 'ngon ', '2023-12-04 16:26:25', 'block', 55),
(58, 35, 80, 2, 'ngon', '2023-12-04 16:26:44', 'block', 55),
(59, 37, 80, 3, 'ngon', '2023-12-04 16:26:52', 'block', 55);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `id` int(100) NOT NULL,
  `name_sale` varchar(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `discount_percentage` int(2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`id`, `name_sale`, `products`, `discount_percentage`, `start_date`, `end_date`) VALUES
(6, 'bánh', 'Bánh Muffin,Bánh croisant,Bánh flan,', 35, '2023-11-23', '2023-11-26'),
(7, 'trà', 'Trà sữa khoai môn,Trà sữa socola,', 20, '2023-11-23', '2023-11-26'),
(9, 'baocao', 'Trà sữa khoai môn,', 50, '2023-12-02', '2023-12-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `slider`
--

INSERT INTO `slider` (`id`, `caption`, `name`, `img`) VALUES
(6, 'Mua ngay', 'Trà sữa', 'km1.png'),
(7, 'Mua ngay', 'Trà sữa socola', 'sosola1.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `reset_token` varchar(8) DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL,
  `last_password_reset_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `number`, `password`, `address`, `status`, `reset_token`, `reset_token_expiration`, `last_password_reset_time`) VALUES
(1, 'Hoàng Phúc', 'ph5208352@gmail.com', '0907951936', 'ecd6a010209a0dcd2d60087a67210d98c73a8c56', ' Tỉnh Vĩnh Long', 'active', NULL, NULL, '2023-11-14 15:08:48'),
(50, 'Lê Hữu THánh', 'thanh10b6@gmail.com', '0904444444', '123', 'QT', 'active', 'L9j3r4k1', '2024-12-08 20:20:57', NULL),
(52, 'Nguyên Phuc Thuân', 'pt123456@gmail.com', '0906666666', '123', 'QT', 'active', NULL, NULL, NULL),
(79, 'Hiếu Dương', 'hieuduong@gmail.com', '0901234567', 'hieu123', 'gia lai', 'active', NULL, NULL, NULL),
(80, 'thanh thao ', 'thanhthao@gmail.com', '0789624877', '5d1648230bff3466d9846b9bdbab066281c800c9', '084, Võ Văn kiệt , Việt Nam, 29551, 855, 86', 'active', NULL, NULL, NULL),
(83, 'Ngọc Huyền', 'huyen@gmail.com', '0384163818', '3ce2721f70255044a61df5bb1c10bebba8033faf', '1, 1, 1, , , ', 'active', NULL, NULL, NULL),
(84, 'Trần Thị Ngọc Huyền ', 'huyenit200x@gmail.com', '0123456789', '3ce2721f70255044a61df5bb1c10bebba8033faf', '1, 1, 1, , , ', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_login_history`
--

CREATE TABLE `user_login_history` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_login_history`
--

INSERT INTO `user_login_history` (`id`, `user_id`, `login_time`, `ip_address`) VALUES
(18, 83, '2024-04-28 00:45:19', '::1'),
(19, 83, '2024-04-28 01:02:11', '::1'),
(20, 84, '2024-05-08 03:49:23', '::1'),
(21, 84, '2024-05-08 04:31:31', '::1'),
(22, 1, '2024-12-08 14:04:54', '::1'),
(23, 50, '2024-12-08 14:58:42', '::1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admin_login_history`
--
ALTER TABLE `admin_login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_login_history_ibfk_1` (`admin_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_name` (`category_name`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `user_login_history`
--
ALTER TABLE `user_login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `admin_login_history`
--
ALTER TABLE `admin_login_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `user_login_history`
--
ALTER TABLE `user_login_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin_login_history`
--
ALTER TABLE `admin_login_history`
  ADD CONSTRAINT `admin_login_history_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category_name` FOREIGN KEY (`category_name`) REFERENCES `category` (`category_name`);

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `user_login_history`
--
ALTER TABLE `user_login_history`
  ADD CONSTRAINT `user_login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

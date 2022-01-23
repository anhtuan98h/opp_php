-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 30, 2021 lúc 06:11 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `book_news`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `kind_book_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `books` (`id`, `kind_book_id`, `name`, `authors`, `cost`, `created_at`) VALUES
(1, 1, 'Bách khoa cho trẻ', 'Nhóm tác giả', 160000, '2021-12-30 05:56:38'),
(2, 1, 'Những Cuộc Chu Du Của Tí Ếch', 'Jakop Martin Strid', 60000, '2021-12-30 10:58:53'),
(3, 4, 'Thực tại kẻ tội đồ vĩ đại nhất ', 'Ohso', 39000, '2021-12-29 12:01:44'),
(4, 3, 'Những con đường tơ lụa ', 'Oxford Peter Frankopan', 392000, '2021-12-30 06:02:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kind_of_book`
--

CREATE TABLE `kind_of_book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `kind_of_book`
--

INSERT INTO `kind_of_book` (`id`, `name`) VALUES
(1, 'Thiếu nhi'),
(2, 'Bình luận văn học'),
(3, 'Lịch sử '),
(4, 'Chính trị'),
(5, 'Khoa học'),
(6, 'Địa lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `book_id`, `title`, `image`, `created_at`) VALUES
(1, 4, ' Một lịch sử mới về thế giới', 'The-Silk-Roads-A-New-History-of-The-World.jpg', '2021-12-30 06:07:01'),
(2, 3, 'Lý luận đà điểu', 'thuctaiketoidovidainhat.jpg', '2021-12-30 06:09:53');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kind_book_id` (`kind_book_id`);

--
-- Chỉ mục cho bảng `kind_of_book`
--
ALTER TABLE `kind_of_book`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `kind_of_book`
--
ALTER TABLE `kind_of_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`kind_book_id`) REFERENCES `kind_of_book` (`id`);

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

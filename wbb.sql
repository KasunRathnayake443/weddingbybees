-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 08:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `image`) VALUES
(22, '67134a6431fed3.46366374.jpg'),
(24, '67134a80713539.49767866.jpg'),
(25, '67134a848dad49.20480881.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carousel-text`
--

CREATE TABLE `carousel-text` (
  `id` int(11) NOT NULL,
  `text1` varchar(100) NOT NULL,
  `text2` varchar(100) NOT NULL,
  `text3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousel_text`
--

CREATE TABLE `carousel_text` (
  `id` int(11) NOT NULL,
  `text1` varchar(100) NOT NULL,
  `text2` varchar(100) NOT NULL,
  `text3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel_text`
--

INSERT INTO `carousel_text` (`id`, `text1`, `text2`, `text3`) VALUES
(1, 'Wedding By Bees', 'Your wedding is a movie, and we\'ll take you Beyond the Script.', 'Let the Journey of Forever Begin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`) VALUES
(4, '67136ef41e3081.63128786.jpg'),
(5, '67136efccdd6b0.82846580.jpg'),
(6, '67136f01bf0f28.27217046.jpg'),
(7, '67136f061913a8.99559292.jpg'),
(10, '6713aa67d3d872.92004509.jpg'),
(11, '6713f286a6cb27.44236094.jpg'),
(12, '6713f28e67db78.99092610.jpg'),
(13, '6713f2a232b348.96406682.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `website_name` varchar(255) NOT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `about_us_text` text DEFAULT NULL,
  `about_us_text_2` text NOT NULL,
  `about_us_image1` varchar(255) DEFAULT NULL,
  `about_us_image2` varchar(255) DEFAULT NULL,
  `packages_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `website_name`, `facebook_url`, `instagram_url`, `phone`, `address`, `logo`, `about_us_text`, `about_us_text_2`, `about_us_image1`, `about_us_image2`, `packages_text`) VALUES
(1, 'Wedding By Bees', 'https://www.facebook.com/weddingbybees', 'https://www.facebook.com/weddingbybees', '0718948284', 'Temple Road Colomco', 'logo.png', 'At Wedding by Bees, we believe that every love story is unique and deserves to be celebrated with elegance and style. Founded on the principles of creativity, passion, and attention to detail, we specialize in transforming your wedding dreams into reality.\r\n\r\nOur team of dedicated professionals is committed to making your special day as memorable as possible, whether you\'re envisioning a grand celebration or an intimate gathering. From stunning floral arrangements to breathtaking venue decor, we take pride in curating personalized experiences that reflect your unique love story.\r\n\r\nWith years of experience in the wedding industry, we understand that every detail matters. That\'s why we offer a comprehensive range of services, including venue decoration, floral design, lighting, and event coordination, to ensure that your day runs smoothly from start to finish.\r\n\r\nLet Wedding by Bees take care of the details so you can focus on what matters most—celebrating love.', 'At Wedding by Bees, we take pride in creating unforgettable moments through exquisite decorations and thoughtful design. Every image in this gallery is a testament to our dedication to turning dreams into reality, capturing the essence of beauty and elegance in each event we undertake. Browse through our collection to get inspired by our past projects, and see how we can bring your vision to life.', 'gallery-04.jpg', 'gallery-06.jpg', '   The most important day of your life can also be the most daunting. This is why at Wedding by Bees we have created packages of outstanding value. You decide when and where and we do the rest.');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Kasun Rathnayake', 'madkasunmax@gmail.com', 'ddd', 'ddd', '2024-10-19 15:11:50'),
(2, 'Kasun Rathnayake', 'madkasunmax@gmail.com', 'ddd', 'ddddd', '2024-10-19 15:12:03'),
(3, 'Kasun Rathnayake', 'madkasunmax@gmail.com', 'ddd', 'ddddd', '2024-10-19 15:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`id`, `image`) VALUES
(4, '6713f2d79a8df4.47008372.png'),
(5, '6713f2e2387e03.76386741.jpg'),
(6, '6713f2e5859711.18219212.jpg'),
(8, '6713f2f150cac9.66524457.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'test', 'test@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel-text`
--
ALTER TABLE `carousel-text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel_text`
--
ALTER TABLE `carousel_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `carousel-text`
--
ALTER TABLE `carousel-text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carousel_text`
--
ALTER TABLE `carousel_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 08:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wedding_date` date NOT NULL,
  `venue` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_name`, `email`, `wedding_date`, `venue`, `package_name`, `package_price`, `created_at`) VALUES
(1, 'abc', 'madkasunmax@gmail.com', '2024-12-06', 'Hotel', 'Budget Bliss Package', 65000.00, '2024-11-15 07:45:49'),
(2, 'abc', 'madkasunmax@gmail.com', '2024-11-23', 'Hotel', 'Budget Bliss Package', 65000.00, '2024-11-15 07:48:34'),
(3, 'abc', 'madkasunmax@gmail.com', '2024-11-28', 'Hotel', 'Budget Bliss Package', 65000.00, '2024-11-15 07:49:08'),
(4, 'abc', 'madkasunmax@gmail.com', '2024-11-21', 'Hotel', 'Budget Bliss Package', 65000.00, '2024-11-15 07:49:39'),
(5, 'abc', 'abc@gmail.com', '2024-11-23', 'Grand Hotel', 'Luxe Dream Package', 125000.00, '2024-11-15 07:56:14');

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
(28, '671fb608cd8348.52006254.jpg'),
(29, '671fb60d112569.76558522.jpg'),
(30, '671fb611b69c72.98155275.jpg'),
(31, '671fb623296653.65172157.jpg');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Flowers Bouquet', 'Various types of flowers bouquets', '2024-11-30 09:31:13'),
(2, 'Cake', 'Various Cake', '2024-11-30 10:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone`, `address`, `password`, `profile_pic`, `created_at`) VALUES
(2, 'Kasun Rathnayake', 'madkasunmax@gmail.com', '0718948284', '550/36 A', '$2y$10$X5ytg8ybyepbDXxxDZxg0eaCSbMZdpOZgxLxxr05hW/7XgBXsFXOm', 'png-clipart-computer-icons-font-awesome-user-font-awesome-miscellaneous-rectangle-thumbnail.png', '2024-11-30 16:46:38'),
(3, 'Kasun Rathnayake', 'test123@gmail.com', '0718948284', '550/36 A', '$2y$10$hqV.8FQCEotFpMdGU8Hv2ObnLeUIXa8/./yAb.dnBZX1kBoW1xH6a', 'MSI.png', '2024-12-02 18:35:41'),
(4, 'qww', 'www@gmail.com', '1111111111', '111', '$2y$10$dSDYvVSSCVmtBPDZ7yP4pOAomwtyyxowJQ/KVeM7HJ97fn09rosqy', 'MSI_PRO.jpg', '2025-02-04 15:51:59'),
(5, 'we', 'we@gmail.com', '11111111111', '111', '$2y$10$5cREitx3HKo4.y7nwdpPku1rtokcm1.fM.lfkXRUtOl.pgeh6QU0.', 'MSI_MPG.jpg', '2025-02-04 15:54:19');

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
  `packages_text` text NOT NULL,
  `gallery_text` text NOT NULL,
  `event_text` text NOT NULL,
  `auther` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `website_name`, `facebook_url`, `instagram_url`, `phone`, `address`, `logo`, `about_us_text`, `about_us_text_2`, `about_us_image1`, `about_us_image2`, `packages_text`, `gallery_text`, `event_text`, `auther`) VALUES
(1, 'Wedding By bees', 'https://www.facebook.com/weddingbybees', 'https://www.instagram.com/weddingbybees?igsh=Y3Q2czJmbnYzd3B2', '076 857 3000', ' 518 jana jaya city mall, Rajagiriya', 'logo.png', 'At Wedding by Bees, we believe that every love story is unique and deserves to be celebrated with elegance and style. Founded on the principles of creativity, passion, and attention to detail, we specialize in transforming your wedding dreams into reality.\r\n\r\nOur team of dedicated professionals is committed to making your special day as memorable as possible, whether you\'re envisioning a grand celebration or an intimate gathering. From stunning floral arrangements to breathtaking venue decor, we take pride in curating personalized experiences that reflect your unique love story.\r\n\r\nWith years of experience in the wedding industry, we understand that every detail matters. That\'s why we offer a comprehensive range of services, including venue decoration, floral design, lighting, and event coordination, to ensure that your day runs smoothly from start to finish.\r\n\r\nLet Wedding by Bees take care of the details so you can focus on what matters most—celebrating love.', 'At Wedding by Bees, we take pride in creating unforgettable moments through exquisite decorations and thoughtful design. Every image in this gallery is a testament to our dedication to turning dreams into reality, capturing the essence of beauty and elegance in each event we undertake. Browse through our collection to get inspired by our past projects, and see how we can bring your vision to life.', '241360648_225646269417874_8241028221639879764_n.png', 'gallery-06.jpg', '   The most important day of your life can also be the most daunting. This is why at Wedding by Bees we have created packages of outstanding value. You decide when and where and we do the rest.', ' Explore our gallery and get inspired by the beautiful moments we\'ve crafted for countless celebrations. From elegant floral arrangements to stunning decor setups, each image tells a story of joy, love, and creativity. Whether you\'re planning an intimate wedding or a grand event, our gallery showcases the passion and dedication we put into every detail.', '', 'Kavishan Anjana');

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
(3, 'Kasun Rathnayake', 'madkasunmax@gmail.com', 'ddd', 'ddddd', '2024-10-19 15:13:30'),
(4, 'Kasun Rathnayake', 'madkasunmax@gmail.com', 'test', 'dscdvdv', '2024-10-20 14:59:51'),
(5, 'Kasun Rathnayake', 'madkasunmax@gmail.com', 'kavi', 'test 12344', '2024-10-20 16:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_name` varchar(100) NOT NULL,
  `shipping_email` varchar(100) NOT NULL,
  `shipping_phone` varchar(15) NOT NULL,
  `shipping_address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` enum('Cash on Delivery','Card') NOT NULL,
  `status` enum('Pending','Completed','Cancelled') NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `shipping_name`, `shipping_email`, `shipping_phone`, `shipping_address`, `total_price`, `payment_method`, `status`, `order_date`) VALUES
(11, 3, 'Kasun Rathnayake', 'test123@gmail.com', '0718948284', '550/36 A', 30499.99, 'Cash on Delivery', 'Cancelled', '2025-02-05 06:54:42'),
(12, 3, 'Kasun Rathnayake', 'test123@gmail.com', '0718948284', '550/36 A', 30499.99, 'Cash on Delivery', '', '2025-02-05 06:55:04'),
(13, 3, 'Kasun Rathnayake', 'test123@gmail.com', '0718948284', '550/36 A', 30499.99, 'Cash on Delivery', 'Completed', '2025-02-05 06:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(25, 11, 20, 1, 8500.00),
(26, 11, 21, 1, 5000.00),
(27, 11, 25, 1, 8500.00),
(28, 11, 24, 1, 8499.99),
(29, 12, 20, 1, 8500.00),
(30, 12, 21, 1, 5000.00),
(31, 12, 25, 1, 8500.00),
(32, 12, 24, 1, 8499.99),
(33, 13, 20, 1, 8500.00),
(34, 13, 21, 1, 5000.00),
(35, 13, 25, 1, 8500.00),
(36, 13, 24, 1, 8499.99);

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`id`, `image`, `description`, `price`, `title`) VALUES
(4, '6713f2d79a8df4.47008372.png', '\"Celebrate beautifully without stretching your budget. The Budget Bliss Package is designed to add a charming touch to your special day with simple yet elegant decor.\"', 65000.00, 'Budget Bliss Package'),
(5, '6713f2e2387e03.76386741.jpg', '\"Create timeless memories with the Classic Elegance Package. This package blends sophistication with affordability, giving your event a warm, memorable ambiance.\"', 85000.00, 'Classic Elegance Package.'),
(6, '6713f2e5859711.18219212.jpg', '\"Set the stage for romance with the Premium Romance Package. With stylish decor and tasteful lighting, this package creates a dreamy, elegant atmosphere for any occasion.\"', 100000.00, 'Premium Romance Package'),
(8, '6713f2f150cac9.66524457.jpg', '\"Turn your vision into reality with the Luxe Dream Package. For those seeking a grand experience, this package offers everything to make your day extraordinarily luxurious and memorable.\"', 125000.00, 'Luxe Dream Package');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `category`, `stock`) VALUES
(9, 'Roxanne', 'Treat your beloved like the heroine Roxanne in Cyrano de Bergerac.\r\n\r\n', 10000.00, '674b12e31bbe35.42383220.png', '1', 0),
(19, 'RED ROSE HAPPINESS', 'Red Roses: There is no flower that expresses true love as timelessly and as perfectly as the long. A Bouquet of 12 fresh red roses carefully wrapped and tied-up with a ribbon.', 6500.00, 'red_rose_happiness.jpg', '1', 100),
(20, 'WISHING YOU THE BEST', 'Premium quality yellow Lilies beautifully wrapped and tied up with a bow.\r\nThis charming bouquet showcases lovely pink chrysanthemums, a delightful symphony of delicate beauty. ', 8500.00, 'WhatsApp-Image-2024-02-08-at-110327-AM.jpeg', '1', 100),
(21, 'GLEAMING LOVE', 'Shop for this exquisite bouquet of red roses for your loved ones! Perfect for expressing heartfelt emotions, this alluring bouquet features a bunch of garden-fresh and long-stemmed red roses paired impeccably with white baby’s breath blooms! ', 5000.00, 'WhatsApp-Image-2024-02-08-at-111826-AM.jpeg', '1', 100),
(22, 'CHOCOLATE CHIP CAKE 1KG', 'A soft & rich chocolate chip sponge cake layer & a deliciously soft chocolate cake layer sandwiched & garnished with creamy smooth chocolate ganache.', 8500.00, 'CHOCOLATE-CHIP-CAKE.jpg', '2', 50),
(24, 'CHOCOLATE CRUMBLE', 'A soft rich, crunchy chocolate cake made with the finest cashew nuts layered with creamy butter icing topped with s delicious white chocolate ganache.', 8499.99, 'CHOCOLATE-CRUMBLE.jpg', '2', 50),
(25, 'COFFEE LOVER CAKE 1 kg', 'A combination of rich chocolate mousse & coffee butter cream layered with almond sponge, soaked in brewed extract, covered with chocolate ganache.', 8500.00, 'COFFEE-LOVER-CAKE-2.jpg', '2', 50),
(26, 'NEW YORK BLUEBERRY CHEESE CAKE ', 'Biscuit Based filled with smoothy cream cheese and garnished with Apricot glaze & Blue Berries', 15000.00, 'NEW-YORK-CHEESE-CAKE.jpg', '2', 50);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `image`, `name`, `description`) VALUES
(1, '12.webp', 'Bouquets', 'The main bouquet carried by the bride. Smaller bouquets for the bridesmaids.'),
(2, '5.jpg', 'Boutonnieres', 'Floral arrangements worn by the groom, groomsmen, and other male members of the wedding party.'),
(7, '9.jpg', 'Centerpieces', 'Floral arrangements placed in the center of each dining table at the reception.'),
(8, '7.jpg', 'Floral Installations', 'Larger floral displays, such as flower walls, hanging installations, or floral chandeliers, to create a visually stunning atmosphere.'),
(9, '3.jpg', 'Reception Decor', 'Additional floral arrangements or greenery throughout the reception venue, including entrance decor, escort card table arrangements, and lounge area arrangements.'),
(10, '11.jpg', 'Floral Decor for Cake', 'Coordinating flowers to complement the wedding cake or dessert table.'),
(12, '6.jpg', 'Petals and Aisle Runners', 'Sprinkling petals down the aisle or using floral aisle runners for added elegance.'),
(13, '4.jpg', 'Consultation and Design', 'Collaborating with the couple to understand their vision, theme, and color scheme, and providing professional advice on floral choices.'),
(14, '8.jpg', 'Delivery and Set-Up', 'Transporting the floral arrangements to the venue and setting them up according to the agreed-upon design.'),
(15, '1.jpg', 'Customization', 'Creating custom floral designs to match the couple’s unique style and preferences.'),
(16, '10.jpg', 'Seasonal Considerations', 'Taking into account the seasonality of flowers and suggesting options that are readily available and in line with the wedding date.');

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
(1, 'testss', 'test@gmail.com', '123'),
(4, 'Somapala', 'madkasunmax@gmail.comsasa', '$2y$10$5enoucOMe7EsVWvRqyiIIunonV/5sYN27KiWVXTdMiZHosZWfFTE6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2021 at 12:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshob_dbbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `url_address` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_url` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `url_address`, `title`, `post`, `image`, `date`, `user_url`) VALUES
(2, 'this-is-post-title-for-blog', 'This Is Post Title For Blogggg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\n It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n\r\n', 'uploads/4fsNQpkGLsMga9tFuq7Yqp60ydbC6DuDhPDOFBIvdKAIfl1Rxt7Ifs898RhJ.jpg', '2021-10-22 19:41:28', 'm3fuZv42zx');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `disabled`, `views`) VALUES
(1, 'Johnstons', 0, 0),
(2, 'Ronhil', 0, 0),
(3, 'Albiro', 0, 0),
(4, 'Toyota', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `disabled`, `parent`, `views`) VALUES
(45, 'Renta Car', 0, 0, 6),
(46, 'Renta House', 0, 0, 0),
(47, 'Renta Housee', 0, 46, 5),
(48, 'Sodas', 0, 0, 19);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `date`) VALUES
(4, 'Tarik ', 'tarik@gmail.com', 'Predmet', 'Hello, i mean this page is very good for me', '2021-10-11 13:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(30) NOT NULL,
  `disable` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `disable`) VALUES
(1, 'Bosnia and Herzegovina', 0),
(2, 'Bosnia and Herzegovina', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `delivery_address` varchar(1024) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `country` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `tax` double DEFAULT 0,
  `shipping` double DEFAULT 0,
  `date` datetime NOT NULL,
  `sessionid` varchar(30) NOT NULL,
  `home_phone` varchar(15) NOT NULL,
  `mobile_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_url`, `delivery_address`, `total`, `country`, `state`, `zip`, `tax`, `shipping`, `date`, `sessionid`, `home_phone`, `mobile_phone`) VALUES
(1, 'm3fuZv42zx', 'dawfwaf 123', 515.1, '2', NULL, 'fwafaw', 0, 0, '2021-09-23 12:48:54', 'utuge6d4davjh6vu5knngi75js', '123', '213'),
(2, 'm3fuZv42zx', 'wafawf fwafw', 515.1, '2', NULL, '123', 0, 0, '2021-09-23 12:52:28', 'utuge6d4davjh6vu5knngi75js', '123', '123'),
(3, 'm3fuZv42zx', 'aaaaa aaaa', 80.8, '2', NULL, '123', 0, 0, '2021-09-25 01:43:31', 'sscpvlj2gd86brdiv4usl8dce9', '123', '123'),
(4, 'm3fuZv42zx', 'Zaulica,6 Zaulica,6', 8, '2', NULL, '2010', 0, 0, '2021-09-27 16:14:37', 'mqnd3jfaf14kauqa9hr5e7nbou', '123', '123'),
(5, 'm3fuZv42zx', 'afwawaf afwafw', 8, '2', NULL, '123', 0, 0, '2021-09-28 14:46:48', 'ld1ci4mnsvmfrviciglidspeg9', '123', '123'),
(6, 'm3fuZv42zx', 'Zaulica , 6 Zaulica , 6', 16, NULL, NULL, '2120', 0, 0, '2021-09-29 14:10:19', 'nbptnvrmd6l58dvjeb45j748th', '+38762411664', '+38762411664'),
(7, 'm3fuZv42zx', 'Zaulica , 6 Zaulica , 6', 16, NULL, NULL, '2120', 0, 0, '2021-09-29 14:14:49', 'nbptnvrmd6l58dvjeb45j748th', '+38762411664', '+38762411664'),
(8, 'gy9Gu9mnWUUKHTlRPj05EiG', 'zaulica, 6 zaulica, 6', 424.434, NULL, NULL, '2100', 0, 0, '2021-10-01 11:39:28', 'kv4nrbm7omapeg1htmugs23f1b', '123', '123'),
(9, 'gy9Gu9mnWUUKHTlRPj05EiG', 'zaulica, 6 zaulica, 6', 424.434, NULL, NULL, '2100', 0, 0, '2021-10-01 11:39:40', 'kv4nrbm7omapeg1htmugs23f1b', '123', '123'),
(10, 'gy9Gu9mnWUUKHTlRPj05EiG', 'zaulica, 6 zaulica, 6', 424.434, NULL, NULL, '2100', 0, 0, '2021-10-01 11:39:55', 'kv4nrbm7omapeg1htmugs23f1b', '123', '123'),
(11, 'gy9Gu9mnWUUKHTlRPj05EiG', 'zezez eszse', 90.9, NULL, NULL, '12342', 0, 0, '2021-10-01 20:07:04', 'rtk44ai8177nvlasdbr5gj8j72', '231312', '4214124'),
(12, '', 'zezez eszse', 181.8, NULL, NULL, '12342', 0, 0, '2021-10-01 21:38:41', 'rtk44ai8177nvlasdbr5gj8j72', '231312', '4214124'),
(13, 'm3fuZv42zx', 'fwafwa ffawf', 90.9, NULL, NULL, '1234', 0, 0, '2021-10-02 00:18:29', 'rtk44ai8177nvlasdbr5gj8j72', '231312', '4214124'),
(14, 'BDanbX1nHzWg1c0QU', 'zaulica6 zaulica6', 90.9, NULL, NULL, '4124', 0, 0, '2021-10-24 16:22:48', 'g223n8tshkoonibgsb9sa5r34d', '14214124', '4124124'),
(15, '', 'zaulica6 zaulica6', 90.9, NULL, NULL, '1234', 0, 0, '2021-10-26 15:17:24', '1bmr5hkrduaf2deandjimk60in', '14214124', '1234214'),
(16, 'QlM9NE7OGS46PGpnaO', 'zaulica6 zaulica6', 50, NULL, NULL, '14241', 0, 0, '2021-11-16 10:41:36', 'e3gauq4l5kl1m4eil84gpdalqd', '1241', '42141');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `orderid` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `total` double NOT NULL,
  `productid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderid`, `qty`, `description`, `amount`, `total`, `productid`) VALUES
(1, 1, 3, 'Renta Car 2', 80.8, 242.4, 27),
(2, 1, 3, 'Renta Car', 90.9, 272.7, 26),
(3, 2, 3, 'Renta Car 2', 80.8, 242.4, 27),
(4, 2, 3, 'Renta Car', 90.9, 272.7, 26),
(5, 3, 1, 'Renta House 1.4', 80.8, 80.8, 28),
(6, 4, 1, 'Glen', 8, 8, 30),
(7, 5, 1, 'Glen', 8, 8, 30),
(8, 6, 2, 'Glen', 8, 16, 30),
(9, 7, 2, 'Glen', 8, 16, 30),
(10, 8, 1, 'Blondie 1.5 F', 424.434, 424.434, 29),
(11, 9, 1, 'Blondie 1.5 F', 424.434, 424.434, 29),
(12, 10, 1, 'Blondie 1.5 F', 424.434, 424.434, 29),
(13, 11, 1, 'Renta Car', 90.9, 90.9, 26),
(14, 12, 2, 'Renta Car', 90.9, 181.8, 26),
(15, 13, 1, 'Renta Car', 90.9, 90.9, 26),
(16, 14, 1, 'Renta Car', 90.9, 90.9, 26),
(17, 15, 1, 'Renta Car', 90.9, 90.9, 26),
(18, 16, 1, 'Skoda', 50, 50, 38);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `raw` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `image3` varchar(500) DEFAULT NULL,
  `image4` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `slag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_url`, `description`, `category`, `brand`, `price`, `quantity`, `image`, `image2`, `image3`, `image4`, `date`, `slag`) VALUES
(38, 'm3fuZv42zx', 'Skoda', 45, 45, 50, 1, 'uploads/54pNSxWmz8am9loJn1Yr84lBGo4yPBPeShjXrNdPY8fOgaNE6YignfHZRf8o.jpg', 'uploads/OKQevPI70taz27FloX9pCwonlKFRaZlQZf6YXlEZsLWx2H5x8svD061MhjhQ.jpg', 'uploads/ZPBSa8MMZQJ2rFg9kEGApD9SirYQSWP0GUykyJklrW2hjOFiCQFzIQ51KvWo.jpg', 'uploads/YXfwkVMQQFQqowFLxZ7lkdZ7GLDnRrUSYF1Fu2nQrxxMkxdiyR1RrhgO8dfO.jpg', '2021-10-27 13:53:31', 'skoda'),
(39, 'm3fuZv42zx', 'Alfa', 45, 45, 50.3, 1, 'uploads/8QRqxwG9UhZy5uEHtCb4L6c9w89akvYPVDKbsh6bfC5MuPVf2Ey55catr1UV.jpg', 'uploads/nElAj0wF2kKtI3UajR5q4Cy9fPABM97avJMX677eikAAzOof6QOudU0j1RMc.jpg', 'uploads/MvaAaXCrzSJMN17MEEZcp2xhffct6y0UbfwG8590djl167sYhi8NKYSBc80E.jpg', 'uploads/MVYhxjk3mv1hcl1iy4xveSyDSRne6ppnlZnEBaYtP6SXzDoiyURjZhHcMxvI.jpg', '2021-10-27 13:56:26', 'alfa'),
(40, 'm3fuZv42zx', 'House', 46, 46, 50.3, 1, 'uploads/p0XOH3DKiTOP3G0rF9daIiUSBttAdoG2w6wy79YNE1i7mkRafMS9kzJtnsQg.jpg', 'uploads/86JM5ejMkF1f0id75NNr13IU5EvfadUoVKuwVfxvixwieHp2VX9LIrgXScHy.jpg', 'uploads/gUYv69a1HXlOLsfpXwnI9i2JeSYOqBBq6iAdLKJHvum2MrDQ14bo1INZ93QD.jpg', 'uploads/CsjonVGQPwx67JGf6cqRRMrcveWgeB6O71Mf6Tw6K8YJSDuy9N0ro46PGykA.jpg', '2021-10-27 13:58:38', 'house'),
(41, 'm3fuZv42zx', 'House', 46, 46, 40, 1, 'uploads/d6tbCNxcZP9SXEuNo4XWKGoL1XUOWjQZhRltplCwcNNOqdnYrwduTXyS1BhT.jpg', '', '', '', '2021-10-28 11:52:10', 'house-38822'),
(42, 'm3fuZv42zx', 'House 2', 46, 46, 40, 1, 'uploads/c6bg814zmpOs7Mgj5LwhBm2muSwXGv9G6jAlPx8CovYBDnDL5rLLsLTqGjTa.jpg', '', '', '', '2021-10-28 11:52:39', 'house-2'),
(43, 'm3fuZv42zx', 'House 3', 46, 46, 40, 1, 'uploads/etRAMUtkgPYyURFi4NDVQPLnFXwWVSMFTZ8JQCl1XvVpcuR9iNryHKplCrb4.jpg', 'uploads/ywfm9gp9ejN7U8ESvmPWo5VRasRpS3JgU7FAb4snTARsvKHOVkqAVNZUbXeQ.jpg', '', '', '2021-10-28 11:52:50', 'house-3'),
(44, 'm3fuZv42zx', 'Abc', 47, 47, 40, 1, 'uploads/1OglQovqqDRIs0m2r1SMPwdJ0VVrHr5KXhFKDYEvXt3IRLownmxAA8dNOoCh.jpg', '', '', '', '2021-10-28 11:57:21', 'abc'),
(45, 'm3fuZv42zx', 'Soda', 48, 48, 40, 1, 'uploads/ZOxncWSGYC7DRGXGEJUfcb8ODYjAivaV0PnuVwaHidgMMBEM7mv5m7aBKUv5.jpg', '', '', '', '2021-10-28 12:12:29', 'soda'),
(46, 'm3fuZv42zx', 'Some Product', 45, 1, 20, 1, 'uploads/S0mXHh4yeGLCp6xBTQi7pM53uzHsxVT8TtE8mRTiMSdCI6oOtnmH73oiPAxl.jpg', 'uploads/LiYVQnX0oHhaTVbTURsAMUzKhdBIIEAYbxQqYzjMeOVYEuZWgkzsI1upHtMw.jpg', 'uploads/Z2gDDpJ1NL7koKEhZvv4POJez0qRBnQrNfk0dq5ZgW8sTs0F6XVEWlx28lZR.jpg', '', '2021-11-04 14:44:20', 'some-product'),
(47, 'm3fuZv42zx', 'Renta Car', 48, 2, 20, 1, 'uploads/WALvC1lEzcVVmMyBa1pIObCMM7NkjnORmhz2Gc0V9oblhxMqoGOzbE3wwcnm.jpg', 'uploads/Y8SwSVKvMbAxB1hod4Psn4bGLp1cb1OcbmdiHgF4VrciJuqbxaEtq6R2kj5F.jpg', 'uploads/I4v63obZkJivyIw3ZIy2P8h5FtkqVefqb7nC9SzKujQqLZYbG2NZ3kjos04v.jpg', '', '2021-11-04 15:16:26', 'renta-car'),
(48, 'm3fuZv42zx', 'Renta Car', 48, 2, 20, 1, 'uploads/8nc4BXM1mOuT4GcFJbyoOS3Gk0FlWLzPaquP91FAgYQcbi4D8HjpjiQvhNLc.jpg', 'uploads/JhFMDq45akvfDIwfR1J3AYxoAxDOInb5BfXSDCfsq7z3kCclTFljpyPruS7Y.jpg', 'uploads/6EIK2VT2jRyIcpupmPNXMaqHmGM5In9hcCbTYwcww5Jar6PngqNZUcpb59Jk.jpg', '', '2021-11-04 15:16:36', 'renta-car-69664'),
(49, 'm3fuZv42zx', 'New Product', 48, 1, 20, 1, 'uploads/VecxLtdZvzCWxQzyqKa7k2yCA9qlAF81c0n7SzOvprpqNmrSWywRyrHY8kFy.jpg', '', '', '', '2021-11-08 14:36:32', 'new-product'),
(50, 'm3fuZv42zx', 'New Product', 48, 2, 20, 1, 'uploads/kW7azLx9rQ6ca7USTxgSuWekleOhlYDY3QBuKmM1CMVmqEJf5A3lT1Z4Bs8g.jpg', '', '', '', '2021-11-08 14:36:42', 'new-product-62276'),
(51, 'm3fuZv42zx', 'New Product', 48, 2, 20, 1, 'uploads/gm57AvwdhepfRng4d1aItnXwpFA0k2H99dVFJz6KgN6FEUuJgWwOsZXex25R.jpg', 'uploads/4vPuva7FTibXWltKNcjSQiIFSsclbKZgH1jaWhtODrA3mnlSKHULRBJN3VUz.jpg', 'uploads/qnodLgVL3d7GoQjbFkbupS6yZFN497VXBN8YLR9cd4pQqPh9OF9MuV5GFu4U.jpg', 'uploads/d29zPyyFkY14lS0ryQIChf8QW3TgqTR0wnBBqcLee6Iz7LLXUApOYgH1Sfum.jpg', '2021-11-08 14:36:51', 'new-product-31569'),
(52, 'm3fuZv42zx', 'Oktavia', 47, 3, 30, 5, 'uploads/pOxtqGabyRiosNb3lHq8EfUPsT4VLL9rNQhjnqepJv3SAOcZSKDa2aNO5X1l.jpg', 'uploads/g6UQb1i0VcislGdVTLRXQpsh4ocNqbHVa9e8gEgTuxDzCf5pGY9Upch2PYHZ.jpg', 'uploads/dz2s9o94eI5rNjYdRJAt6wsPJZS0bx07ybDcbFsVWHBP6bG4pdXUk2VhHIWL.jpg', 'uploads/1kfZa4Xepeoge6sr3zeGYta6EaI5rgn1RrvSOe4AdcY0vgpo1B1Of2wh6cHF.jpg', '2021-11-12 15:58:57', 'oktavia');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(30) DEFAULT NULL,
  `value` varchar(2048) DEFAULT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting`, `value`, `type`) VALUES
(1, 'phone_number', '+387 62 411 66', ''),
(2, 'email', 'info@mywebsite.com', ''),
(3, 'facebook_link', 'https://www.facebook.com', ''),
(4, 'twitter_link', 'https://www.twitter.com', ''),
(5, 'linkedin_link', '', ''),
(6, 'google_plus_link', '', ''),
(7, 'website_link', '', ''),
(8, 'youtube_link', '', ''),
(9, 'contact_info', 'E-Shopper Inc\r\n\r\n<b>935 W. Webster Ave New Streets Chicago, IL 60614, NY</b>\r\n\r\nNewyork USA\r\n\r\nMobile: +2346 17 38 93\r\n\r\nFax: 1-714-252-0026\r\n\r\nEmail: info@e-shopper.com\r\n', 'textarea');

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `header1_text` varchar(20) NOT NULL,
  `header2_text` varchar(30) DEFAULT NULL,
  `text` varchar(400) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `header1_text`, `header2_text`, `text`, `link`, `image`, `image2`, `disabled`) VALUES
(1, 'E-Shop', 'Dobro došli, bolje vas našli', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,', 'http://localhost/shop/public/admin/settings/slider_images?action=add', 'uploads/Kbsha7eljUXDze4MEE7BVIjp9cLZTQp9Ii8Yenvx28RtTTeBgl2iKU9drKxI.jpg', '', 0),
(2, 'Fwfaw', 'fawfafw', 'fawfwafawfa', 'http://localhost/shop/public/admin/settings/slider_images?action=add', 'uploads/3e4K0FatAC8gSBM7vcB8GXdz69lEQcMsDI0uzh5AEQtjta9LrPf8J3GLEkuq.jpg', '', 0),
(3, 'Fwafwfa', 'fwafawf', 'wafawf', 'http://localhost/shop/public/product_details/0', 'uploads/LVjrQVfGpz1MrMRg0ztHJXeDT3oygZxYEmEru4tIWy5c3zzbaLpamX4lVBLB.jpg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `state` varchar(30) NOT NULL,
  `disable` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `parent`, `state`, `disable`) VALUES
(1, 1, 'Southern', 0),
(2, 1, 'Nothern', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `url_address` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `rank` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `url_address`, `name`, `email`, `password`, `date`, `rank`) VALUES
(1, 'm3fuZv42zx', 'Tarik', 'faf@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-07-19 17:02:30', 'admin'),
(2, 'o22jcgJzDutF0n3SUh3cnUsoTq1mFpXRJ8329lsCgwJVCdLGn2Y8BIPy', 'Tarik', 'terzotarik@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-07-23 00:44:58', 'customer'),
(3, 'q43NFIDPHlgV0Rc8D0l8tDCz2RJhmnePEU9p1ZiIUnHfqb4', 'admin', 'admin@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2021-08-04 15:10:11', 'admin'),
(4, 'kel2h', 'Tarik', 'tarik@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2021-08-22 20:15:23', 'admin'),
(5, 'aRXx08uazeoQ', 'Damir', 'damir@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-09-29 13:16:48', 'customer'),
(6, 'gy9Gu9mnWUUKHTlRPj05EiG', 'Ajdin', 'ajdin@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-10-01 11:35:06', 'customer'),
(7, 'SDTubIz16WAsmen6aHaWYY9', 'Ajdin', 'ajdinbajramovic@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-10-23 17:38:38', 'customer'),
(8, 'BDanbX1nHzWg1c0QU', 'Haris', 'haris@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-10-24 16:12:43', 'customer'),
(9, 'QlM9NE7OGS46PGpnaO', 'Mirha', 'mirha@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-11-16 10:40:33', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `title` (`title`),
  ADD KEY `image` (`image`),
  ADD KEY `user_url` (`user_url`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`brand`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `views` (`views`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `parent` (`parent`),
  ADD KEY `views` (`views`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `subject` (`subject`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disable` (`disable`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`user_url`),
  ADD KEY `date` (`date`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `description` (`description`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quantity` (`quantity`),
  ADD KEY `date` (`date`),
  ADD KEY `price` (`price`),
  ADD KEY `description` (`description`),
  ADD KEY `user_url` (`user_url`),
  ADD KEY `category` (`category`),
  ADD KEY `slag` (`slag`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting` (`setting`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`),
  ADD KEY `disable` (`disable`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`),
  ADD KEY `rank` (`rank`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

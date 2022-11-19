-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2022 at 08:10 AM
-- Server version: 5.7.33
-- PHP Version: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smile_net_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_categories`
--

CREATE TABLE `admin_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_categories`
--

INSERT INTO `admin_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Movies', 'Natus atque ut ut mo', '2022-11-08 15:02:29', '2022-11-08 15:02:29'),
(2, 'Action', 'Ut eum cupidatat sed', '2022-11-08 15:02:44', '2022-11-08 15:02:44'),
(3, 'Shop', 'Est laudantium reru', '2022-11-08 15:02:55', '2022-11-08 15:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `admin_live_tv`
--

CREATE TABLE `admin_live_tv` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tv_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp4` longtext COLLATE utf8mb4_unicode_ci,
  `tv_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_live_tv`
--

INSERT INTO `admin_live_tv` (`id`, `admin_id`, `title`, `description`, `image`, `tv_link`, `mp4`, `tv_name`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dolores nobis dicta', 'Aut commodo illum e', '2022-11-17-1668682517.png', 'Non harum repellendu', '', 'Ruby Pickett', '2015-09-27 14:40:00', 1, '2022-11-17 10:55:17', '2022-11-17 11:05:35'),
(2, 1, 'Nostrum in cillum co', 'Mollitia corporis id', '2022-11-17-1668682770.png', '', '2022-11-17-1668682770.mkv', 'Moses Bryant', '1973-05-04 08:57:00', 1, '2022-11-17 10:59:31', '2022-11-17 11:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin_live_tv_comments`
--

CREATE TABLE `admin_live_tv_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `live_tv_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_live_tv_likes`
--

CREATE TABLE `admin_live_tv_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `live_tv_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dislike` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_mail_settings`
--

CREATE TABLE `admin_mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_transport` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_encryption` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_mail_settings`
--

INSERT INTO `admin_mail_settings` (`id`, `mail_transport`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.mailtrap.io', '2525', 'cd4124b03fc58e', '065aa527d6a73d', 'tls', ' hello@gmail.com', '2022-11-08 09:34:26', '2022-11-08 09:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_manage_site`
--

CREATE TABLE `admin_manage_site` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manage_site_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_manual_getway`
--

CREATE TABLE `admin_manual_getway` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minium_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_manual_getway`
--

INSERT INTO `admin_manual_getway` (`id`, `admin_id`, `currency_id`, `name`, `alias`, `code`, `image`, `minium_amount`, `maximum_amount`, `fixed_charge`, `percent_charge`, `description`, `user_data`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 'ADPay', '', 1004, '2022-11-14-1668422518.png', '10', '1000', '1', '1', '<p>Pay according to the rules</p>', '{\"enter_name\":{\"field_level\":\"Enter Name\",\"field_name\":\"enter_name\",\"field_type\":\"input\",\"field_validation\":\"required\"},\"transaction_id\":{\"field_level\":\"Transaction ID\",\"field_name\":\"transaction_id\",\"field_type\":\"input\",\"field_validation\":\"required\"}}', 1, '2022-11-14 10:41:58', '2022-11-14 10:51:05'),
(6, 1, 1, 'Manual Bank', '', 1005, '2022-11-14-1668422588.png', '200', '5000', '1', '2', '<p>Pay according to the rules</p>', '{\"token_number\":{\"field_level\":\"Token Number\",\"field_name\":\"token_number\",\"field_type\":\"input\",\"field_validation\":\"required\"}}', 1, '2022-11-14 10:43:08', '2022-11-14 10:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `admin_music_video`
--

CREATE TABLE `admin_music_video` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mp4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_music_video`
--

INSERT INTO `admin_music_video` (`id`, `user_id`, `title`, `artist`, `singer_name`, `image`, `mp4`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Voluptas modi dolore', 'Omnis rem sint sunt', 'Raya Quinn', '2022-11-16-1668595263.png', '2022-11-16-1668595263.mkv', 1, '2022-11-16 10:13:56', '2022-11-16 10:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_news`
--

CREATE TABLE `admin_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `news_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_news`
--

INSERT INTO `admin_news` (`id`, `user_id`, `news_type`, `category_id`, `title`, `image`, `tag`, `description`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'App\\Models\\GeneralUser', 1, 'Rerum pariatur Ut l', '2022-11-12-1668237882.png', 'Est dolorem dignissi', '<p><i><strong>Rerum pariatur Ut l</strong></i></p>', NULL, 1, '2022-11-12 07:24:43', '2022-11-12 07:58:37'),
(2, 1, 'App\\Models\\User', 3, 'Duis expedita molest', '2022-11-12-1668241290.png', 'Consectetur quia om', '<p>Duis expedita molest</p>', NULL, 0, '2022-11-12 08:21:30', '2022-11-17 09:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `admin_news_comments`
--

CREATE TABLE `admin_news_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_news_likes`
--

CREATE TABLE `admin_news_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_pages`
--

CREATE TABLE `admin_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pages` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_pages`
--

INSERT INTO `admin_pages` (`id`, `pages`, `created_at`, `updated_at`) VALUES
(1, 'home', '2022-11-08 09:34:26', NULL),
(2, 'pricing', '2022-11-08 09:34:26', NULL),
(3, 'events', '2022-11-08 09:34:26', NULL),
(4, 'plan', '2022-11-08 09:34:26', NULL),
(5, 'voting', '2022-11-08 09:34:26', NULL),
(6, 'magazine', '2022-11-08 09:34:26', NULL),
(7, 'magazine-details', '2022-11-08 09:34:26', NULL),
(8, 'live-now', '2022-11-08 09:34:26', NULL),
(9, 'music', '2022-11-08 09:34:26', NULL),
(10, 'smile-tv', '2022-11-08 09:34:26', NULL),
(11, 'news', '2022-11-08 09:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_paypal_getways`
--

CREATE TABLE `admin_paypal_getways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_paypal_getways`
--

INSERT INTO `admin_paypal_getways` (`id`, `client_id`, `secret_key`, `app_id`, `mode`, `created_at`, `updated_at`) VALUES
(1, 'AVy2g-FObbs7lvtJV16kDZ4ZSA1rnlpLQPIATifALFjfG0Wo8EBmDPa0JVJFsmeYRdkEIZHveCrBPyYp', 'EGT6-3WPOyq9tRu6EAOwvdeEdMQ9GYjbMCzdyt806FdShzrTXWRsmMVOhxDTE2M7pvek5qtRXcUNP5tl', 'app_id', 'sandbox', '2022-11-08 09:34:26', '2022-11-08 15:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `admin_smile_tv`
--

CREATE TABLE `admin_smile_tv` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smile_tv_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_smile_tv`
--

INSERT INTO `admin_smile_tv` (`id`, `admin_id`, `category_id`, `ticket_type_id`, `name`, `title`, `type`, `image`, `smile_tv_link`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Alma Wolf', 'Qui deserunt nemo vo', 'Quis porro deleniti', '2022-11-13-1668350218.png', 'http://172.16.50.2/play.php?stream=T-Sports', '1990-06-06 21:15:00', 1, '2022-11-13 14:24:47', '2022-11-13 14:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `admin_smile_tv_comments`
--

CREATE TABLE `admin_smile_tv_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `smile_tv_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_smile_tv_likes`
--

CREATE TABLE `admin_smile_tv_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `smile_tv_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dislike` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_social_links`
--

CREATE TABLE `admin_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instragram_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_social_links`
--

INSERT INTO `admin_social_links` (`id`, `email`, `phone`, `address`, `fb_link`, `twitter_link`, `instragram_link`, `linkedin_link`, `created_at`, `updated_at`) VALUES
(1, 'info@example.com', '+ 1-234-567-890', 'Medino, Kitaniya Road , USA', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.linkedin.com/', '2022-11-08 09:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_stripe_getways`
--

CREATE TABLE `admin_stripe_getways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_secret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_stripe_getways`
--

INSERT INTO `admin_stripe_getways` (`id`, `stripe_key`, `stripe_secret`, `created_at`, `updated_at`) VALUES
(1, 'stripe_key', 'stripe_secret', '2022-11-08 09:34:26', '2022-11-08 09:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_id` bigint(20) UNSIGNED NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `first_name`, `last_name`, `address`, `country`, `designation`, `auth_id`, `profile_pic`, `profile_pic_url`, `pic_mime_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super', 'Admin', 'united states', 'United States', 'Super Admin', 1, '2022-11-08-1667905179.png', NULL, NULL, 1, NULL, '2022-11-08 10:59:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_votes`
--

CREATE TABLE `admin_votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `vote_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vote_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_vote_images`
--

CREATE TABLE `admin_vote_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_vote_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_by` int(10) UNSIGNED NOT NULL,
  `balance` decimal(8,2) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'contains full address',
  `status` tinyint(4) DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `kyc_status` tinyint(4) DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `kyc_info` text COLLATE utf8mb4_unicode_ci,
  `kyc_reject_reasons` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ev` tinyint(4) DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(4) DEFAULT '0' COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT 'stores verification code',
  `ver_code_send_at` timestamp NULL DEFAULT NULL,
  `ts` tinyint(4) DEFAULT '0' COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(4) DEFAULT '1' COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1' COMMENT '0: 2fa unverified, 1: 2fa verified',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auths`
--

CREATE TABLE `auths` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL COMMENT '1 = Admin',
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `dob` date DEFAULT NULL,
  `facebook` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_code_expire` datetime DEFAULT NULL,
  `is_first_login` tinyint(4) NOT NULL DEFAULT '1',
  `user_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Admin',
  `can_login` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = Can login, 0 = Can not login',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updated_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ev` tinyint(4) DEFAULT NULL COMMENT '0 = email unverified, 1 = email verifieed',
  `sv` tinyint(4) DEFAULT NULL COMMENT '0 = sms unverified, 1 = sms verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auths`
--

INSERT INTO `auths` (`id`, `username`, `email`, `mobile_no`, `password`, `salt`, `model_id`, `gender`, `dob`, `facebook`, `instagram`, `twitter`, `activation_code`, `activation_code_expire`, `is_first_login`, `user_type`, `can_login`, `status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `ev`, `sv`) VALUES
(1, 'testuser', 'admin@gmail.com', '01016000000789', '$2y$10$1ORFMa43orRcmE6HfhQD7eOELLBjtHwmZelkKyiOnUFGMH2/TEud6', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 0, 0, NULL, NULL, '2022-11-08 13:15:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_role`
--

CREATE TABLE `auth_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auth_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_role`
--

INSERT INTO `auth_role` (`id`, `auth_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-11-08 09:34:25', '2022-11-08 09:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_book_id` bigint(20) UNSIGNED NOT NULL,
  `author_book_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price_id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author_book_id`, `author_book_type`, `category_id`, `price_id`, `price`, `paid_price`, `title`, `image`, `file`, `tag`, `description`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(1, 2, 'App\\Models\\GeneralUser', 3, 1, '18', '0', 'Ex est ea est volupt', '2022-11-09-1667987561.png', '2022-11-09-1667987561.pdf', '586', '<p><strong>Ex est ea est volupt</strong></p>', 1, NULL, '2022-11-09 09:52:41', '2022-11-09 10:02:56'),
(2, 2, 'App\\Models\\GeneralUser', 1, 1, '13', '0', 'Nostrud sed voluptat', '2022-11-09-1667987675.png', '2022-11-09-1667987675.pdf', '97', '<p><strong>Magnam dolor itaque&nbsp;</strong></p>', 1, NULL, '2022-11-09 09:54:35', '2022-11-09 10:03:00'),
(3, 2, 'App\\Models\\GeneralUser', 2, 1, '12', '0', 'Culpa mollit placeat', '2022-11-09-1667987830.png', '2022-11-09-1667987830.pdf', '714', '<p><strong>Culpa mollit placeat</strong></p>', 1, NULL, '2022-11-09 09:57:10', '2022-11-09 10:03:01'),
(4, 2, 'App\\Models\\GeneralUser', 3, 1, '43', '0', 'Voluptate aut aliqui', '2022-11-09-1667988020.png', '2022-11-09-1667988020.pdf', '244', '<p><strong>Voluptate aut aliqui</strong></p>', 0, NULL, '2022-11-09 10:00:20', '2022-11-12 16:27:06'),
(5, 1, 'App\\Models\\User', 1, 1, '414', '0', 'Alias magna elit vo', '2022-11-12-1668259483.png', '2022-11-12-1668259483.pdf', 'Enim quo vel sed occ', '<p>Alias magna elit vo</p>', 1, NULL, '2022-11-12 13:24:43', '2022-11-12 16:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `book_transactions`
--

CREATE TABLE `book_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `author_book_id` bigint(20) UNSIGNED NOT NULL,
  `author_book_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buy_user_id` bigint(20) UNSIGNED NOT NULL,
  `paid_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_getway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(8,2) DEFAULT '0.00',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_transactions`
--

INSERT INTO `book_transactions` (`id`, `book_id`, `author_book_id`, `author_book_type`, `buy_user_id`, `paid_price`, `coupon`, `payment_getway`, `discount`, `transaction_id`, `sold`, `slug`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'App\\Models\\GeneralUser', 2, '2', '123456', 'paypal', '10.00', '{M8462316942M51532527359', '1', NULL, '2022-11-09 10:08:44', '2022-11-09 10:08:44'),
(2, 3, 2, 'App\\Models\\GeneralUser', 2, '2', '123456', 'paypal', '10.00', '42640276}{77936290)86777', '1', NULL, '2022-11-09 10:43:44', '2022-11-09 10:43:44'),
(3, 3, 2, 'App\\Models\\GeneralUser', 2, '2', '123456', 'paypal', '10.00', '68C44261994479847$0W1548', '1', NULL, '2022-11-09 10:46:35', '2022-11-09 10:46:35'),
(4, 3, 2, 'App\\Models\\GeneralUser', 2, '2', '123456', 'paypal', '10.00', '6}2*0037258S085930355512', '1', NULL, '2022-11-09 10:48:03', '2022-11-09 10:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active and 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comming_soon_movies`
--

CREATE TABLE `comming_soon_movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_type_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mp4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comming_soon_movies`
--

INSERT INTO `comming_soon_movies` (`id`, `ticket_type_id`, `admin_id`, `name`, `category`, `year`, `description`, `status`, `image`, `mp4`, `slug`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Shafira Kaufman', 'Consequuntur dolores', '1998', '<p><strong>Although</strong> it is meaningless and out of context but sometimes we all need <i>sample text in MS Word document</i>. People use random text in<strong> Microsoft</strong> Word to act as a <strong>placeholder for i</strong>nserting more sensible text later on. This sample text is just used to fill and hold the space. Such dummy text is also useful to quickly give a demonstration of how something will look when proper text will be in place.</p>', 1, '2022-11-16-1668595763.png', '2022-11-16-1668595763.mkv', 'http://localhost/smile-net/core/storage/app/public/comming-soon-movies/movies/2022-11-16-1668595763.mkv', '2022-11-16 10:49:23', '2022-11-16 10:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` decimal(8,2) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `discount_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'basic', '123456', '10.00', 1, '2022-11-08 15:04:26', '2022-11-08 15:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 => fiat, 2 => crypto',
  `rate` double(8,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 => active, 0 => inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'USER',
  `wallet_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `method_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT '0.00',
  `method_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(8,2) DEFAULT '0.00',
  `rate` decimal(8,2) DEFAULT NULL,
  `final_amo` decimal(8,2) DEFAULT '0.00',
  `detail` text COLLATE utf8mb4_unicode_ci,
  `btc_amo` decimal(8,2) DEFAULT '0.00',
  `btc_wallet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(4) DEFAULT '0',
  `admin_feedback` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'PK users table',
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

CREATE TABLE `email_sms_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci,
  `sms_body` text COLLATE utf8mb4_unicode_ci,
  `shortcodes` text COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(4) NOT NULL DEFAULT '1',
  `sms_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_event_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price_currency_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `sold` tinyint(4) DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `author_event_id`, `category_id`, `price_currency_id`, `title`, `description`, `image`, `tag`, `status`, `sold`, `slug`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 'Cum necessitatibus q', '<p><i><strong>Cum necessitatibus q</strong></i></p>', '2022-11-12-1668258245.png', NULL, 1, 0, NULL, '1977-01-25 02:00:00', '2009-02-20 04:16:00', '2022-11-09 12:38:06', '2022-11-12 13:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `event_plans`
--

CREATE TABLE `event_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `author_event_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_type_id` bigint(20) UNSIGNED NOT NULL,
  `seat` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `sold` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_plans`
--

INSERT INTO `event_plans` (`id`, `event_id`, `author_event_id`, `ticket_type_id`, `seat`, `price`, `sold`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 653, 44, NULL, '2022-11-09 12:38:06', '2022-11-12 13:04:05'),
(2, 1, 2, 2, 103, 15, NULL, '2022-11-09 12:38:06', '2022-11-12 13:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `event_plan_transactions`
--

CREATE TABLE `event_plan_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_plan_id` bigint(20) UNSIGNED NOT NULL,
  `author_event_id` bigint(20) UNSIGNED NOT NULL,
  `buy_user_id` bigint(20) UNSIGNED NOT NULL,
  `paid_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_getway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(8,2) DEFAULT '0.00',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_plan_transactions`
--

INSERT INTO `event_plan_transactions` (`id`, `event_plan_id`, `author_event_id`, `buy_user_id`, `paid_price`, `coupon`, `payment_getway`, `discount`, `transaction_id`, `sold`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, '5', '123456', 'paypal', '10.00', '634197015385579{9888G0O5', '1', '2022-11-09 13:35:55', '2022-11-09 13:35:55'),
(2, 2, 2, 2, '5', '123456', 'paypal', '10.00', '734I1861740862527@4)1857', '1', '2022-11-09 13:37:19', '2022-11-09 13:37:19'),
(3, 2, 2, 2, '5', '123456', 'paypal', '10.00', '9259253XU037882117878T38', '1', '2022-11-09 13:37:56', '2022-11-09 13:37:56'),
(4, 2, 2, 2, '5', '123456', 'paypal', '10.00', '22U92699307550AE04918694', '1', '2022-11-09 13:39:57', '2022-11-09 13:39:57'),
(5, 2, 2, 2, '5', '123456', 'paypal', '10.00', '33G7680792Y976013N089608', '1', '2022-11-09 13:42:50', '2022-11-09 13:42:50'),
(6, 2, 2, 2, '5', '123456', 'paypal', '10.00', '1731W3}7915050598603E450', '1', '2022-11-09 13:45:58', '2022-11-09 13:45:58'),
(7, 2, 2, 2, '5', '123456', 'paypal', '10.00', '0512H38725741649391L7C85', '1', '2022-11-09 13:46:54', '2022-11-09 13:46:54'),
(8, 2, 2, 2, '5', '123456', 'paypal', '10.00', '9259163393R&5154216O1169', '1', '2022-11-09 13:48:01', '2022-11-09 13:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci,
  `shortcode` text COLLATE utf8mb4_unicode_ci,
  `support` text COLLATE utf8mb4_unicode_ci COMMENT 'Help section',
  `status` tinyint(4) DEFAULT NULL COMMENT '1=>enable, 2=>disable	',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_values` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `gateway_parameters` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `crypto` tinyint(4) DEFAULT NULL,
  `extra` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `input_form` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int(11) DEFAULT NULL,
  `gateway_alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(24,2) DEFAULT NULL,
  `max_amount` decimal(24,2) DEFAULT NULL,
  `percent_charge` decimal(24,2) DEFAULT NULL,
  `fixed_charge` decimal(24,2) DEFAULT NULL,
  `rate` decimal(24,2) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dark` tinyint(4) DEFAULT NULL,
  `cur_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_sym` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` json DEFAULT NULL,
  `sms_config` json DEFAULT NULL,
  `ev` tinyint(4) DEFAULT NULL,
  `en` tinyint(4) DEFAULT NULL,
  `sv` tinyint(4) DEFAULT NULL,
  `sn` tinyint(4) DEFAULT NULL,
  `otp_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_verification` tinyint(4) DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `force_ssl` tinyint(4) DEFAULT NULL,
  `secure_password` tinyint(4) DEFAULT NULL,
  `agree` tinyint(4) DEFAULT NULL,
  `registration` tinyint(4) DEFAULT NULL,
  `withdraw_status` tinyint(4) DEFAULT NULL,
  `deposit_status` tinyint(4) DEFAULT NULL,
  `kyc_verification` tinyint(4) DEFAULT NULL,
  `devlopment_mode` tinyint(4) DEFAULT NULL,
  `active_template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci,
  `fiat_currency_api` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto_currency_api` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_template` text COLLATE utf8mb4_unicode_ci,
  `sys_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cron_run` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `sitename`, `site_sub_title`, `dark`, `cur_text`, `cur_sym`, `email_from`, `sms_api`, `base_color`, `secondary_color`, `component_color`, `mail_config`, `sms_config`, `ev`, `en`, `sv`, `sn`, `otp_expiration`, `otp_verification`, `timezone`, `force_ssl`, `secure_password`, `agree`, `registration`, `withdraw_status`, `deposit_status`, `kyc_verification`, `devlopment_mode`, `active_template`, `email_template`, `fiat_currency_api`, `crypto_currency_api`, `qr_template`, `sys_version`, `cron_run`, `created_at`, `updated_at`) VALUES
(1, 'AppDevs Solution', 'Quality Mind Development', 0, 'USD', NULL, 'noreply@appdevs.net', 'hi {{name}}, {{message}}', '#23970c', '#2030ac', '#d41616', '{\"enc\": \"ssl\", \"host\": \"appdevs.net\", \"name\": \"smtp\", \"port\": \"587\", \"password\": \"QP2fsLk?80Ac\", \"username\": \"noreply@appdevs.net\"}', '{\"from\": \"----------------------\", \"name\": \"clickatell\", \"apiv2_key\": \"-------------------------------\", \"auth_token\": \"---------------------------\", \"account_sid\": \"-----------------------\", \"nexmo_api_key\": \"----------------------\", \"infobip_password\": \"----------------------\", \"infobip_username\": \"--------------\", \"nexmo_api_secret\": \"----------------------\", \"clickatell_api_key\": \"----------------------------\", \"text_magic_username\": \"-----------------------\", \"message_bird_api_key\": \"-------------------\", \"sms_broadcast_password\": \"-----------------------------\", \"sms_broadcast_username\": \"----------------------\"}', 1, 1, 1, 1, '60', 0, NULL, 1, 1, 1, 1, 1, 1, 1, 0, 'basic', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n        <!--[if !mso]><!-->\r\n        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n        <!--<![endif]-->\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n        <title></title>\r\n        <style type=\"text/css\">\r\n      .ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n      .ExternalClass { width: 100%; background-color: #ffffff; }\r\n      .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\n      html { width: 100%; }\r\n      body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\n      table { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\n      table table table { table-layout: auto; }\r\n      .yshortcuts a { border-bottom: none !important; }\r\n      img:hover { opacity: 0.9 !important; }\r\n      a { color: #0087ff; text-decoration: none; }\r\n      .textbutton a { font-family: \"open sans\", arial, sans-serif !important;}\r\n      .btn-link a { color:#FFFFFF !important;}\r\n      \r\n      @media only screen and (max-width: 480px) {\r\n      body { width: auto !important; }\r\n      *[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n      *[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n      /* image */\r\n      img[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n      }\r\n      </style>\r\n      \r\n      \r\n      \r\n        <p><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#414a51\" align=\"center\">\r\n          <tbody><tr>\r\n            <td height=\"50\"><br></td>\r\n          </tr>\r\n          <tr>\r\n            <td style=\"text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n              <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n                <tbody><tr>\r\n                  <td width=\"600\" align=\"center\">\r\n                    <!--header-->\r\n                    <table class=\"table-inner\" width=\"95%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n                      <tbody><tr>\r\n                        <td style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" bgcolor=\"#0087ff\" align=\"center\">\r\n                          <table width=\"90%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\"><br></td>\r\n                            </tr>\r\n                            <tr>\r\n                              <td style=\"font-family: \"Open sans\", Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\" align=\"center\"><div align=\"center\"><a href=\"https://premium.appdevs.net/xpay/admin/dashboard\" class=\"sidebar__main-logo\"><img src=\"https://premium.appdevs.net/xpay/assets/images/logoIcon/light_logo.png\" alt=\"image\"></a><br></div></td>\r\n                            </tr>\r\n                            <tr>\r\n                              <td height=\"20\"><br></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                    <!--end header-->\r\n                    <table class=\"table-inner\" width=\"95%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n                      <tbody><tr>\r\n                        <td style=\"text-align:center;vertical-align:top;font-size:0;\" bgcolor=\"#FFFFFF\" align=\"center\">\r\n                          <table width=\"90%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n                            <tbody><tr>\r\n                              <td height=\"35\"><br></td>\r\n                            </tr>\r\n                            <!--logo-->\r\n                            <tr>\r\n                              <td style=\"vertical-align:top;font-size:0;\" align=\"center\">\r\n                                \r\n                              <br></td>\r\n                            </tr>\r\n                            <!--end logo-->\r\n                            <tr>\r\n                              <td height=\"40\"><br></td>\r\n                            </tr>\r\n                            <!--headline-->\r\n                            <tr>\r\n                              <td style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\" align=\"center\">Hello {{fullname}}<br></td>\r\n                            </tr>\r\n                            <!--end headline-->\r\n                            <tr>\r\n                              <td style=\"text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                                <table width=\"40\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n                                  <tbody><tr>\r\n                                    <td style=\" border-bottom:3px solid #0087ff;\" height=\"20\"><br></td>\r\n                                  </tr>\r\n                                </tbody></table>\r\n                              </td>\r\n                            </tr>\r\n                            <tr>\r\n                              <td height=\"20\"><br></td>\r\n                            </tr>\r\n                            <!--content-->\r\n                            <tr>\r\n                              <td style=\"font-family: \"Open sans\", Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\" align=\"left\">{{message}}</td>\r\n                            </tr>\r\n                            <!--end content-->\r\n                            <tr>\r\n                              <td height=\"40\"><br></td>\r\n                            </tr>\r\n                    \r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\" height=\"45\" bgcolor=\"#f4f4f4\" align=\"center\">\r\n                          <table width=\"90%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n                            <tbody><tr>\r\n                              <td height=\"10\"><br></td>\r\n                            </tr>\r\n                            <!--preference-->\r\n                            <tr>\r\n                              <td class=\"preference-link\" style=\"font-family: \"Open sans\", Arial, sans-serif; color:#95a5a6; font-size:14px;\" align=\"center\">\r\n                                © 2022 AppDevs . All Rights Reserved. \r\n                              </td>\r\n                            </tr>\r\n                            <!--end preference-->\r\n                            <tr>\r\n                              <td height=\"10\"><br></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n          <tr>\r\n            <td height=\"60\"><br></td>\r\n          </tr>\r\n        </tbody></table></p>', '14360e0ed85986d6bf9c3aa1a7fd85080000', 'f45ece6d-9f1a-4ed5-841c-647a603d4c0800000', '617569babbeb21635084730.png', NULL, '{\"fiat_cron\":\"2021-10-24T13:28:21.505940Z\",\"crypto_cron\":\"2021-10-24T13:28:16.481555Z\"}', '2022-11-08 09:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `general_users`
--

CREATE TABLE `general_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified_code` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0==unverified, 1==verified',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follower` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci,
  `instagram` text COLLATE utf8mb4_unicode_ci,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_users`
--

INSERT INTO `general_users` (`id`, `full_name`, `email`, `phone`, `verified_code`, `status`, `country`, `photo`, `user_name`, `follower`, `facebook`, `instagram`, `twitter`, `password`, `created_at`, `updated_at`) VALUES
(2, 'test', 'testuser@gmail.com', '18976986', 618813914, 1, 'United States', '2022-11-14-1668415173.png', 'test-user', NULL, 'www.facebook.com', 'www.instragram.com', 'www.twitter.com', '$2y$10$.aa/779q7Q5t67ku4F5JsuKXemL4YDJ2vmvWC.r5M8kJr88k5Nxby', '2022-11-08 09:36:21', '2022-11-14 08:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_forms`
--

CREATE TABLE `kyc_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_data` json NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_09_30_123517_create_permission_groups_table', 1),
(4, '2019_09_30_123523_create_permissions_table', 1),
(5, '2019_09_30_123524_create_roles_table', 1),
(6, '2019_09_30_123525_create_group_role_permission_table', 1),
(7, '2019_09_30_123527_create_auths_table', 1),
(8, '2019_09_30_123528_create_auth_group_role_table', 1),
(9, '2019_10_01_073858_create_admin_users_table', 1),
(10, '2019_10_02_073857_create_users_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2021_12_05_145431_create_posts_table', 1),
(13, '2021_12_05_150220_create_categories_table', 1),
(14, '2021_12_05_150254_create_tags_table', 1),
(15, '2021_12_05_151849_create_user_groups_table', 1),
(16, '2021_12_11_132449_add_slug_to_posts_table', 1),
(17, '2021_12_22_115552_add_tags_to_posts_table', 1),
(18, '2022_08_13_192536_add_columns_to_users_table', 1),
(19, '2022_08_14_154655_add_username_to_users_table', 1),
(20, '2022_08_15_122336_add_email_to_users_table', 1),
(21, '2022_08_16_181514_create_kyc_forms_table', 1),
(22, '2022_08_17_130624_create_email_sms_templates_table', 1),
(23, '2022_08_17_134454_create_support_tickets_table', 1),
(24, '2022_08_20_103433_create_business_settings_table', 1),
(25, '2022_08_21_165813_create_currencies_table', 1),
(26, '2022_08_21_180140_create_gateways_table', 1),
(27, '2022_08_21_184425_create_gateway_currencies_table', 1),
(28, '2022_08_23_124654_add_is_default_to_users_table', 1),
(29, '2022_08_23_124654_add_is_to_auths_table', 1),
(30, '2022_08_23_143449_create_general_settings_table', 1),
(31, '2022_08_25_164813_create_extensions_table', 1),
(32, '2022_08_26_014151_create_frontends_table', 1),
(33, '2022_08_28_114406_add_user_type_support_tickets_table', 1),
(34, '2022_08_28_154757_create_support_messages_table', 1),
(35, '2022_08_28_181841_create_email_logs_table', 1),
(36, '2022_08_28_182346_create_support_attachments_table', 1),
(37, '2022_08_29_010148_create_languages_table', 1),
(38, '2022_08_30_145520_make_name_code_unique_column_in_languages_table', 1),
(39, '2022_09_01_005009_add_country_code_to_users_table', 1),
(40, '2022_09_01_191014_create_deposits_table', 1),
(41, '2022_09_01_191056_create_withdrawals_table', 1),
(42, '2022_09_01_195936_create_agents_table', 1),
(43, '2022_09_02_003534_create_withdraw_methods_table', 1),
(44, '2022_09_12_134702_create_general_users_table', 1),
(45, '2022_09_15_110553_create_verify_users_table', 1),
(46, '2022_09_22_055252_create_news_table', 1),
(49, '2022_09_24_053056_create_countries_table', 1),
(50, '2022_09_29_154337_create_admin_categories_table', 1),
(52, '2022_10_03_175251_create_ticket_types_table', 1),
(53, '2022_10_06_110732_create_price_currencies_table', 1),
(54, '2022_10_08_193149_create_admin_votes_table', 1),
(55, '2022_10_11_131835_create_admin_vote_images_table', 1),
(56, '2022_10_11_154225_create_user_votes_table', 1),
(57, '2022_10_17_171429_create_coupons_table', 1),
(60, '2022_10_24_142854_create_admin_news_table', 1),
(61, '2022_10_24_183359_create_news_details_table', 1),
(62, '2022_10_24_183845_create_admin_news_comments_table', 1),
(63, '2022_10_25_190056_create_admin_news_likes_table', 1),
(64, '2022_10_26_122033_create_admin_live_tv_table', 1),
(65, '2022_10_26_171230_create_admin_social_links_table', 1),
(66, '2022_10_27_135329_create_admin_live_tv_comments_table', 1),
(67, '2022_10_27_135329_create_admin_smile_tv_comments_table', 1),
(68, '2022_10_27_150934_create_admin_live_tv_likes_table', 1),
(69, '2022_10_27_150934_create_admin_smile_tv_likes_table', 1),
(70, '2022_10_28_151123_create_admin_smile_tv_table', 1),
(71, '2022_10_29_163446_create_ticket_type_details_table', 1),
(72, '2022_10_29_205622_create_comming_soon_movies_table', 1),
(73, '2022_10_29_205622_create_new_items_movies_table', 1),
(74, '2022_10_29_205622_create_top_movies_table', 1),
(76, '2022_10_31_164732_create_admin_manage_site_table', 1),
(77, '2022_10_31_165615_create_admin_pages_table', 1),
(78, '2022_11_05_140640_create_admin_mail_settings_table', 1),
(79, '2022_11_06_130613_create_admin_paypal_getways_table', 1),
(80, '2022_11_06_192640_create_admin_stripe_getways_table', 1),
(81, '2022_11_09_140524_create_user_wallet_table', 2),
(84, '2022_10_19_202116_create_book_transactions_table', 3),
(85, '2022_09_22_095759_create_books_table', 4),
(86, '2022_09_22_093258_create_events_table', 5),
(87, '2022_10_02_194424_create_event_plans_table', 5),
(88, '2022_10_31_044632_create_event_plan_transactions_table', 5),
(89, '2022_10_23_120239_create_music_table', 6),
(92, '2022_11_12_163330_create_admin_manual_getway_table', 7),
(97, '2022_11_14_175902_create_user_manual_getway_request_table', 8),
(98, '2022_11_16_141455_create_admin_music_video_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mp3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `user_id`, `title`, `artist`, `singer_name`, `image`, `mp3`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Voluptas eveniet ma', 'Velit ex consequatur', 'Aurora Randall', '2022-11-12-1668267712.png', '2022-11-12-1668267712.mp3', 1, '2022-11-12 15:41:52', '2022-11-12 15:44:28'),
(6, 1, 'Noel Mcbride', 'Nigel Nichols', 'Jonas Rosario', '2022-11-16-1668592805.png', '2022-11-16-1668592806.MP3', 1, '2022-11-16 10:00:06', '2022-11-16 10:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_details`
--

CREATE TABLE `news_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `new_items_movies`
--

CREATE TABLE `new_items_movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_type_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mp4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_items_movies`
--

INSERT INTO `new_items_movies` (`id`, `ticket_type_id`, `admin_id`, `name`, `category`, `description`, `status`, `image`, `mp4`, `slug`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Kimberley Skinner', 'Action', 'gfjbvcnxjvncjv ', 1, '2022-11-12-1668265424.png', '2022-11-12-1668265424.MP3', 'http://localhost/smile-net/core/storage/app/public/new-item-movies/movies/2022-11-12-1668265424.MP3', '2022-11-12 15:03:44', '2022-11-12 15:03:50'),
(2, 1, 1, 'Nicole Guzman', 'Tempor at doloremque', '<p><strong>Nicole Guzman</strong></p>', 1, '2022-11-16-1668612914.png', '2022-11-16-1668612914.mkv', 'http://localhost/smile-net/core/storage/app/public/new-item-movies/movies/2022-11-16-1668612914.mkv', '2022-11-16 15:35:14', '2022-11-16 15:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_group_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `permission_group_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'view_permission_group', 'View', 1, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(2, 'add_permission_group', 'Add', 1, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(3, 'edit_permission_group', 'Edit', 1, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(4, 'delete_permission_group', 'Delete', 1, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(5, 'execute_permission_group', 'Execute', 1, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(6, 'view_permission', 'View', 2, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(7, 'add_permission', 'Add', 2, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(8, 'edit_permission', 'Edit', 2, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(9, 'delete_permission', 'Delete', 2, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(10, 'execute_delete_permission', 'Execute', 2, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(11, 'view_role', 'View', 3, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(12, 'add_role', 'Add', 3, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(13, 'edit_role', 'Edit', 3, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(14, 'delete_role', 'Delete', 3, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(15, 'execute_role', 'Execute', 3, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(16, 'view_dashboard', 'View', 4, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(17, '', 'Add', 4, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(18, '', 'Edit', 4, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(19, '', 'Delete', 4, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(20, 'execute_dashboard', 'Execute', 4, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(21, 'view_admin_user', 'View', 5, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(22, 'add_admin_user', 'Add', 5, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(23, 'edit_admin_user', 'Edit', 5, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(24, 'delete_admin_user', 'Delete', 5, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(25, 'execute_admin_user', 'Execute', 5, 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `group_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Permission group', 1, NULL, '2022-11-08 09:34:24', '2022-11-08 09:34:24'),
(2, 'Permission', 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(3, 'User role', 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(4, 'Dashboard', 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25'),
(5, 'Admin User', 1, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'PK on categories table',
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active and 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_currencies`
--

CREATE TABLE `price_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_currencies`
--

INSERT INTO `price_currencies` (`id`, `name`, `code`, `symbol`, `created_at`, `updated_at`) VALUES
(1, 'United States Dollar', 'USD', '$', '2022-11-08 09:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`, `created_by`, `edited_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 1, 1, 0, NULL, '2022-11-08 09:34:25', '2022-11-08 09:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `permissions`, `role_id`, `created_at`, `updated_at`) VALUES
(1, ',view_dashboard,', 1, '2022-11-08 09:34:25', '2022-11-08 09:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(10) UNSIGNED NOT NULL COMMENT 'PK support_tickets table',
  `admin_id` int(10) UNSIGNED NOT NULL COMMENT 'PK admin_users table',
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'FK users table',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active and 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_types`
--

CREATE TABLE `ticket_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price_currency_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_types`
--

INSERT INTO `ticket_types` (`id`, `price_currency_id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'basic', 'basic', '20', '2022-11-08 15:01:17', '2022-11-08 15:01:17'),
(2, 1, 'premium', 'premium', '30', '2022-11-08 15:01:33', '2022-11-08 15:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type_details`
--

CREATE TABLE `ticket_type_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `paid_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_getway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(8,2) DEFAULT '0.00',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_type_details`
--

INSERT INTO `ticket_type_details` (`id`, `ticket_type_id`, `user_id`, `paid_price`, `coupon`, `payment_getway`, `discount`, `transaction_id`, `sold`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '10', '123456', 'stripe', '4.00', '32432543546&&', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `top_movies`
--

CREATE TABLE `top_movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_type_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mp4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `top_movies`
--

INSERT INTO `top_movies` (`id`, `ticket_type_id`, `admin_id`, `name`, `category`, `description`, `status`, `image`, `mp4`, `slug`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Shana Obrien', 'Quidem quis veniam', 'jdsfgvbdfjbvkfdngv', 1, '2022-11-16-1668596235.png', '2022-11-16-1668596235.mkv', 'http://localhost/smile-net/core/storage/app/public/top-movies/movies/2022-11-16-1668596235.mkv', '2022-11-16 10:57:15', '2022-11-16 10:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_mobile_no` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_id` bigint(20) UNSIGNED NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ev` tinyint(4) DEFAULT NULL COMMENT '0 = email unverified, 1 = email verifieed',
  `sv` tinyint(4) DEFAULT NULL COMMENT '0 = sms unverified, 1 = sms verified',
  `ver_code` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ts` tinyint(4) DEFAULT NULL COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(4) DEFAULT NULL COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(8,2) DEFAULT NULL,
  `kyc_status` tinyint(4) NOT NULL DEFAULT '0',
  `kyc_info` text COLLATE utf8mb4_unicode_ci,
  `kyc_reject_reasons` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL COMMENT 'PK of Roles table',
  `auth_role` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active and 0=Inactive',
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_manual_getway_request`
--

CREATE TABLE `user_manual_getway_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `gateway_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `gateway_parameters` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reject` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_manual_getway_request`
--

INSERT INTO `user_manual_getway_request` (`id`, `user_id`, `currency_id`, `gateway_method`, `amount`, `gateway_parameters`, `transaction_no`, `reject`, `status`, `created_at`, `updated_at`) VALUES
(3, '2', 1, 'ADPay', 60, '{\"enter_name\":{\"field_lavel\":\"Enter Name\",\"field_type\":\"input\",\"value\":\"Quon Kirkland\"},\"transaction_id\":{\"field_lavel\":\"Transaction ID\",\"field_type\":\"input\",\"value\":\"875474574598568\"}}', '25410049', NULL, 0, '2022-11-15 10:04:44', '2022-11-15 13:23:15'),
(4, '2', 1, 'ADPay', 20, '{\"enter_name\":{\"field_lavel\":\"Enter Name\",\"field_type\":\"input\",\"value\":\"Kameko Clark\"},\"transaction_id\":{\"field_lavel\":\"Transaction ID\",\"field_type\":\"input\",\"value\":\"54675376578\"}}', '94831417', 'mfjhm,jhmnjmhjmhg', 2, '2022-11-15 11:41:22', '2022-11-15 13:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_votes`
--

CREATE TABLE `user_votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_vote_image_id` bigint(20) UNSIGNED NOT NULL,
  `admin_vote_id` bigint(20) UNSIGNED NOT NULL,
  `voted` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 2, '283.88', '2022-11-09 09:03:31', '2022-11-15 11:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT '0.00',
  `charge` decimal(8,2) DEFAULT '0.00',
  `final_amount` decimal(8,2) DEFAULT '0.00',
  `after_charge` decimal(8,2) DEFAULT '0.00',
  `rate` decimal(8,2) DEFAULT NULL,
  `withdraw_information` text COLLATE utf8mb4_unicode_ci,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `admin_feedback` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currencies` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_guards` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_limit` decimal(8,2) NOT NULL COMMENT '0.00000000',
  `max_limit` decimal(8,2) NOT NULL COMMENT '0.00000000',
  `fixed_charge` decimal(8,2) NOT NULL COMMENT '0.00000000',
  `percent_charge` decimal(8,2) NOT NULL COMMENT '0.00000000',
  `user_data` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_categories`
--
ALTER TABLE `admin_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_live_tv`
--
ALTER TABLE `admin_live_tv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_live_tv_comments`
--
ALTER TABLE `admin_live_tv_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_live_tv_likes`
--
ALTER TABLE `admin_live_tv_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_mail_settings`
--
ALTER TABLE `admin_mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_manage_site`
--
ALTER TABLE `admin_manage_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_manual_getway`
--
ALTER TABLE `admin_manual_getway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_music_video`
--
ALTER TABLE `admin_music_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_news`
--
ALTER TABLE `admin_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_news_comments`
--
ALTER TABLE `admin_news_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_news_likes`
--
ALTER TABLE `admin_news_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_pages`
--
ALTER TABLE `admin_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_paypal_getways`
--
ALTER TABLE `admin_paypal_getways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_smile_tv`
--
ALTER TABLE `admin_smile_tv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_smile_tv_comments`
--
ALTER TABLE `admin_smile_tv_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_smile_tv_likes`
--
ALTER TABLE `admin_smile_tv_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_social_links`
--
ALTER TABLE `admin_social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_stripe_getways`
--
ALTER TABLE `admin_stripe_getways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_users_auth_id_foreign` (`auth_id`);

--
-- Indexes for table `admin_votes`
--
ALTER TABLE `admin_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_vote_images`
--
ALTER TABLE `admin_vote_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_email_unique` (`email`),
  ADD UNIQUE KEY `agents_mobile_unique` (`mobile`);

--
-- Indexes for table `auths`
--
ALTER TABLE `auths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auths_mobile_no_unique` (`mobile_no`),
  ADD UNIQUE KEY `auths_username_unique` (`username`),
  ADD UNIQUE KEY `auths_email_unique` (`email`);

--
-- Indexes for table `auth_role`
--
ALTER TABLE `auth_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_transactions`
--
ALTER TABLE `book_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_transactions_transaction_id_unique` (`transaction_id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `business_settings_key_unique` (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_title_unique` (`title`);

--
-- Indexes for table `comming_soon_movies`
--
ALTER TABLE `comming_soon_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_plans`
--
ALTER TABLE `event_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_plan_transactions`
--
ALTER TABLE `event_plan_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_plan_transactions_transaction_id_unique` (`transaction_id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `extensions_name_unique` (`name`),
  ADD UNIQUE KEY `extensions_act_unique` (`act`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_users`
--
ALTER TABLE `general_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `general_users_email_unique` (`email`),
  ADD UNIQUE KEY `general_users_verified_code_unique` (`verified_code`);

--
-- Indexes for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_details`
--
ALTER TABLE `news_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_items_movies`
--
ALTER TABLE `new_items_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_permission_group_id_foreign` (`permission_group_id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_title_unique` (`title`);

--
-- Indexes for table `price_currencies`
--
ALTER TABLE `price_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permission_role_id_foreign` (`role_id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_tag_title_unique` (`tag_title`);

--
-- Indexes for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_type_details`
--
ALTER TABLE `ticket_type_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_type_details_transaction_id_unique` (`transaction_id`);

--
-- Indexes for table `top_movies`
--
ALTER TABLE `top_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_auth_id_foreign` (`auth_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_manual_getway_request`
--
ALTER TABLE `user_manual_getway_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_users`
--
ALTER TABLE `verify_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_categories`
--
ALTER TABLE `admin_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_live_tv`
--
ALTER TABLE `admin_live_tv`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_live_tv_comments`
--
ALTER TABLE `admin_live_tv_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_live_tv_likes`
--
ALTER TABLE `admin_live_tv_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_mail_settings`
--
ALTER TABLE `admin_mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_manage_site`
--
ALTER TABLE `admin_manage_site`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_manual_getway`
--
ALTER TABLE `admin_manual_getway`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_music_video`
--
ALTER TABLE `admin_music_video`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_news`
--
ALTER TABLE `admin_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_news_comments`
--
ALTER TABLE `admin_news_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_news_likes`
--
ALTER TABLE `admin_news_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_pages`
--
ALTER TABLE `admin_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admin_paypal_getways`
--
ALTER TABLE `admin_paypal_getways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_smile_tv`
--
ALTER TABLE `admin_smile_tv`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_smile_tv_comments`
--
ALTER TABLE `admin_smile_tv_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_smile_tv_likes`
--
ALTER TABLE `admin_smile_tv_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_social_links`
--
ALTER TABLE `admin_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_stripe_getways`
--
ALTER TABLE `admin_stripe_getways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_votes`
--
ALTER TABLE `admin_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_vote_images`
--
ALTER TABLE `admin_vote_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auths`
--
ALTER TABLE `auths`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_role`
--
ALTER TABLE `auth_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_transactions`
--
ALTER TABLE `book_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comming_soon_movies`
--
ALTER TABLE `comming_soon_movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_plans`
--
ALTER TABLE `event_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_plan_transactions`
--
ALTER TABLE `event_plan_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_users`
--
ALTER TABLE `general_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_details`
--
ALTER TABLE `news_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_items_movies`
--
ALTER TABLE `new_items_movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_currencies`
--
ALTER TABLE `price_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_types`
--
ALTER TABLE `ticket_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_type_details`
--
ALTER TABLE `ticket_type_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `top_movies`
--
ALTER TABLE `top_movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_manual_getway_request`
--
ALTER TABLE `user_manual_getway_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_votes`
--
ALTER TABLE `user_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verify_users`
--
ALTER TABLE `verify_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD CONSTRAINT `admin_users_auth_id_foreign` FOREIGN KEY (`auth_id`) REFERENCES `auths` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_permission_group_id_foreign` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_auth_id_foreign` FOREIGN KEY (`auth_id`) REFERENCES `auths` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

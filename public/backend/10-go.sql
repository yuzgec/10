-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2025 at 03:24 AM
-- Server version: 5.7.33
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel10`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 1, NULL, NULL, '{\"attributes\": {\"name\": \"Sayfa\", \"slug\": \"sayfa\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 2, NULL, NULL, '{\"attributes\": {\"name\": \"Hizmet\", \"slug\": \"hizmet\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(3, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 3, NULL, NULL, '{\"attributes\": {\"name\": \"Blog\", \"slug\": \"blog\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(4, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 4, NULL, NULL, '{\"attributes\": {\"name\": \"Galeri\", \"slug\": \"galeri\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(5, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 5, NULL, NULL, '{\"attributes\": {\"name\": \"SSS\", \"slug\": \"sss\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(6, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 6, NULL, NULL, '{\"attributes\": {\"name\": \"Proje\", \"slug\": \"proje\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(7, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 7, NULL, NULL, '{\"attributes\": {\"name\": \"Ürünler\", \"slug\": \"urunler\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(8, 'category_translations', 'Eklendi', 'App\\Models\\CategoryTranslation', 'created', 8, NULL, NULL, '{\"attributes\": {\"name\": \"Ayarlar\", \"slug\": \"ayarlar\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(9, 'default', 'created', 'App\\Models\\Customer', 'created', 1, NULL, NULL, '{\"attributes\": {\"email\": null, \"phone1\": \"+902168134988\", \"phone2\": \"+90 (544) 757 79 66\", \"staff_name\": \"Toprak Özkök\", \"company_name\": \"Emirhan Akbulut\", \"authorized_person\": \"İrem Köybaşı\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(10, 'default', 'created', 'App\\Models\\Customer', 'created', 2, NULL, NULL, '{\"attributes\": {\"email\": null, \"phone1\": \"0 (556) 670 52 17\", \"phone2\": \"+902167910470\", \"staff_name\": \"Deniz Gönültaş\", \"company_name\": \"Yiğit Bademci\", \"authorized_person\": \"Ümran Velioğlu\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(11, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 1, NULL, NULL, '{\"attributes\": {\"slug\": \"siyah\", \"value\": \"Siyah\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(12, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 2, NULL, NULL, '{\"attributes\": {\"slug\": \"black\", \"value\": \"Black\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(13, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 3, NULL, NULL, '{\"attributes\": {\"slug\": \"beyaz\", \"value\": \"Beyaz\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(14, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 4, NULL, NULL, '{\"attributes\": {\"slug\": \"white\", \"value\": \"White\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(15, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 5, NULL, NULL, '{\"attributes\": {\"slug\": \"kirmizi\", \"value\": \"Kırmızı\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(16, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 6, NULL, NULL, '{\"attributes\": {\"slug\": \"red\", \"value\": \"Red\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(17, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 7, NULL, NULL, '{\"attributes\": {\"slug\": \"mavi\", \"value\": \"Mavi\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(18, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 8, NULL, NULL, '{\"attributes\": {\"slug\": \"blue\", \"value\": \"Blue\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(19, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 9, NULL, NULL, '{\"attributes\": {\"slug\": \"yesil\", \"value\": \"Yeşil\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(20, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 10, NULL, NULL, '{\"attributes\": {\"slug\": \"green\", \"value\": \"Green\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(21, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 11, NULL, NULL, '{\"attributes\": {\"slug\": \"xs\", \"value\": \"XS\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(22, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 12, NULL, NULL, '{\"attributes\": {\"slug\": \"xs\", \"value\": \"XS\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(23, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 13, NULL, NULL, '{\"attributes\": {\"slug\": \"s\", \"value\": \"S\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(24, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 14, NULL, NULL, '{\"attributes\": {\"slug\": \"s\", \"value\": \"S\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(25, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 15, NULL, NULL, '{\"attributes\": {\"slug\": \"m\", \"value\": \"M\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(26, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 16, NULL, NULL, '{\"attributes\": {\"slug\": \"m\", \"value\": \"M\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(27, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 17, NULL, NULL, '{\"attributes\": {\"slug\": \"l\", \"value\": \"L\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(28, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 18, NULL, NULL, '{\"attributes\": {\"slug\": \"l\", \"value\": \"L\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(29, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 19, NULL, NULL, '{\"attributes\": {\"slug\": \"xl\", \"value\": \"XL\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(30, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 20, NULL, NULL, '{\"attributes\": {\"slug\": \"xl\", \"value\": \"XL\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(31, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 21, NULL, NULL, '{\"attributes\": {\"slug\": \"xxl\", \"value\": \"XXL\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(32, 'p_attr_val_trans', 'Eklendi', 'App\\Models\\ProductAttributeValueTranslation', 'created', 22, NULL, NULL, '{\"attributes\": {\"slug\": \"xxl\", \"value\": \"XXL\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(33, 'product_translations', 'Eklendi', 'App\\Models\\ProductTranslation', 'created', 1, NULL, NULL, '{\"attributes\": {\"name\": \"iPhone 14 Pro\", \"slug\": \"iphone-14-pro\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(34, 'product_translations', 'Eklendi', 'App\\Models\\ProductTranslation', 'created', 2, NULL, NULL, '{\"attributes\": {\"name\": \"Nike Spor Ayakkabı\", \"slug\": \"nike-spor-ayakkabi\"}}', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(35, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 1, NULL, NULL, '{\"attributes\": {\"name\": \"Web Sitesi\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(36, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 2, NULL, NULL, '{\"attributes\": {\"name\": \"Sosyal Medya\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(37, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 3, NULL, NULL, '{\"attributes\": {\"name\": \"Logo\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(38, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 4, NULL, NULL, '{\"attributes\": {\"name\": \"Baskı\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(39, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 5, NULL, NULL, '{\"attributes\": {\"name\": \"Google Maps\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(40, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 6, NULL, NULL, '{\"attributes\": {\"name\": \"Google ADS\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(41, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 7, NULL, NULL, '{\"attributes\": {\"name\": \"Meta ADS\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(42, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 8, NULL, NULL, '{\"attributes\": {\"name\": \"Uzaktan Yardım\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(43, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 9, NULL, NULL, '{\"attributes\": {\"name\": \"Satış\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(44, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 10, NULL, NULL, '{\"attributes\": {\"name\": \"Kurumsal Mail\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(45, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 11, NULL, NULL, '{\"attributes\": {\"name\": \"Yeni\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(46, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 12, NULL, NULL, '{\"attributes\": {\"name\": \"İndirimli\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(47, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 13, NULL, NULL, '{\"attributes\": {\"name\": \"Öne Çıkan\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(48, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 14, NULL, NULL, '{\"attributes\": {\"name\": \"Stokta Yok\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(49, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 15, NULL, NULL, '{\"attributes\": {\"name\": \"VIP\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(50, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 16, NULL, NULL, '{\"attributes\": {\"name\": \"Aktif\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(51, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 17, NULL, NULL, '{\"attributes\": {\"name\": \"Potansiyel\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(52, 'tags', 'Eklendi', 'App\\Models\\Tag', 'created', 18, NULL, NULL, '{\"attributes\": {\"name\": \"Eski Müşteri\"}}', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE `analysis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `normalized_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desktop_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tr',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `read_author` int(11) NOT NULL DEFAULT '1',
  `send_mail` tinyint(1) NOT NULL DEFAULT '0',
  `send_offer` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `addGoogle` tinyint(1) NOT NULL DEFAULT '1',
  `addComment` tinyint(1) NOT NULL DEFAULT '0',
  `deleteContent` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL DEFAULT '2025-01-08',
  `publish_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `searchText` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GO Dijital', 'go-dijital', 1, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(2, 'Marka Adı', 'marka-adi', 1, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `_lft`, `_rgt`, `parent_id`, `status`, `rank`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(2, 3, 4, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(3, 5, 6, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(4, 7, 8, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(5, 9, 10, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(6, 11, 12, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(7, 13, 14, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(8, 15, 16, NULL, '1', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `locale`, `name`, `slug`, `short`, `desc`, `seoTitle`, `seoDesc`, `seoKey`) VALUES
(1, 1, 'tr', 'Sayfa', 'sayfa', NULL, NULL, NULL, NULL, NULL),
(2, 2, 'tr', 'Hizmet', 'hizmet', NULL, NULL, NULL, NULL, NULL),
(3, 3, 'tr', 'Blog', 'blog', NULL, NULL, NULL, NULL, NULL),
(4, 4, 'tr', 'Galeri', 'galeri', NULL, NULL, NULL, NULL, NULL),
(5, 5, 'tr', 'SSS', 'sss', NULL, NULL, NULL, NULL, NULL),
(6, 6, 'tr', 'Proje', 'proje', NULL, NULL, NULL, NULL, NULL),
(7, 7, 'tr', 'Ürünler', 'urunler', NULL, NULL, NULL, NULL, NULL),
(8, 8, 'tr', 'Ayarlar', 'ayarlar', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `plate_no`) VALUES
(1, 'İSTANBUL', '34'),
(2, 'ANKARA', '6'),
(3, 'İZMİR', '35'),
(4, 'BURSA', '16'),
(5, 'ADANA', '1'),
(6, 'ADIYAMAN', '2'),
(7, 'AFYONKARAHİSAR', '3'),
(8, 'AĞRI', '4'),
(9, 'AKSARAY', '68'),
(10, 'AMASYA', '5'),
(11, 'ANTALYA', '7'),
(12, 'ARDAHAN', '75'),
(13, 'ARTVİN', '8'),
(14, 'AYDIN', '9'),
(15, 'BALIKESİR', '10'),
(16, 'BARTIN', '74'),
(17, 'BATMAN', '72'),
(18, 'BAYBURT', '69'),
(19, 'BİLECİK', '11'),
(20, 'BİNGÖL', '12'),
(21, 'BİTLİS', '13'),
(22, 'BOLU', '14'),
(23, 'BURDUR', '15'),
(24, 'ÇANAKKALE', '17'),
(25, 'ÇANKIRI', '18'),
(26, 'ÇORUM', '19'),
(27, 'DENİZLİ', '20'),
(28, 'DİYARBAKIR', '21'),
(29, 'KOCAELİ', '41'),
(30, 'KONYA', '42'),
(31, 'KÜTAHYA', '43'),
(32, 'MALATYA', '44'),
(33, 'MANİSA', '45'),
(34, 'MARDİN', '47'),
(35, 'MERSİN', '33'),
(36, 'MUĞLA', '48'),
(37, 'MUŞ', '49'),
(38, 'NEVŞEHİR', '50'),
(39, 'NİĞDE', '51'),
(40, 'ORDU', '52'),
(41, 'OSMANİYE', '80'),
(42, 'RİZE', '53'),
(43, 'SAKARYA', '54'),
(44, 'SAMSUN', '55'),
(45, 'SİİRT', '56'),
(46, 'SİNOP', '57'),
(47, 'ŞIRNAK', '73'),
(48, 'SİVAS', '58'),
(49, 'TEKİRDAĞ', '59'),
(50, 'TOKAT', '60'),
(51, 'TRABZON', '61'),
(52, 'TUNCELİ', '62'),
(53, 'ŞANLIURFA', '63'),
(54, 'UŞAK', '64'),
(55, 'VAN', '65'),
(56, 'YALOVA', '77'),
(57, 'YOZGAT', '66'),
(58, 'ZONGULDAK', '67'),
(59, 'DÜZCE', '81'),
(60, 'EDİRNE', '22'),
(61, 'ELAZIĞ', '23'),
(62, 'ERZİNCAN', '24'),
(63, 'ERZURUM', '25'),
(64, 'ESKİŞEHİR', '26'),
(65, 'GAZİANTEP', '27'),
(66, 'GİRESUN', '28'),
(67, 'GÜMÜŞHANE', '29'),
(68, 'HAKKARİ', '30'),
(69, 'HATAY', '31'),
(70, 'IĞDIR', '76'),
(71, 'ISPARTA', '32'),
(72, 'KAHRAMANMARAŞ', '46'),
(73, 'KARABÜK', '78'),
(74, 'KARAMAN', '70'),
(75, 'KARS', '36'),
(76, 'KASTAMONU', '37'),
(77, 'KAYSERİ', '38'),
(78, 'KİLİS', '79'),
(79, 'KIRIKKALE', '71'),
(80, 'KIRKLARELİ', '39'),
(81, 'KIRŞEHİR', '40');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tr',
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `read_user` int(11) DEFAULT NULL,
  `favorite` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorized_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googlemaps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) NOT NULL DEFAULT '35',
  `district_id` int(11) NOT NULL DEFAULT '76',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '6',
  `medium` int(11) NOT NULL DEFAULT '6',
  `firstdate_at` date NOT NULL DEFAULT '2025-01-08',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_name`, `authorized_person`, `staff_name`, `tax_number`, `tax_place`, `email1`, `email2`, `address`, `phone1`, `phone2`, `mobile`, `whatsapp`, `website1`, `website2`, `instagram`, `facebook`, `linkedin`, `tiktok`, `youtube`, `googlemaps`, `note`, `city_id`, `district_id`, `user_id`, `status`, `medium`, `firstdate_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Emirhan Akbulut', 'İrem Köybaşı', 'Toprak Özkök', NULL, NULL, 'turker.elicin@pektemek.com.tr', 'oraloglu.utku@gmail.com', NULL, '+902168134988', '+90 (544) 757 79 66', NULL, NULL, 'godijital.net', NULL, 'instagram.com/godijital.net', 'facebook.com/godijital.net', 'linkedin.com/godijital.net', 'tiktok.com/godijital.net', 'youtube.com/godijital.net', NULL, NULL, 35, 76, 1, 6, 6, '2025-01-08', '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(2, 'Yiğit Bademci', 'Ümran Velioğlu', 'Deniz Gönültaş', NULL, NULL, 'sahnur.duygulu@kocyigit.com.tr', 'emir.catalbas@superposta.com', NULL, '0 (556) 670 52 17', '+902167910470', NULL, NULL, 'godijital.net', NULL, 'instagram.com/godijital.net', 'facebook.com/godijital.net', 'linkedin.com/godijital.net', 'tiktok.com/godijital.net', 'youtube.com/godijital.net', NULL, NULL, 35, 76, 1, 6, 6, '2025-01-08', '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_offers`
--

CREATE TABLE `customer_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `offer_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `currency` enum('TRY','USD','EUR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TRY',
  `offer_date` date NOT NULL,
  `valid_until` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_offer_items`
--

CREATE TABLE `customer_offer_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_works`
--

CREATE TABLE `customer_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `city_id`, `name`, `district_id`) VALUES
(1, '34', 'ADALAR', 1103),
(2, '34', 'ARNAVUTKÖY', 2048),
(3, '34', 'ATAŞEHİR', 2049),
(4, '34', 'AVCILAR', 2003),
(5, '34', 'BAĞCILAR', 2004),
(6, '34', 'BAHÇELİEVLER', 2005),
(7, '34', 'BAKIRKÖY', 1166),
(8, '34', 'BAŞAKŞEHİR', 2050),
(9, '34', 'BAYRAMPAŞA', 1886),
(10, '34', 'BEŞİKTAŞ', 1183),
(11, '34', 'BEYKOZ', 1185),
(12, '34', 'BEYLİKDÜZÜ', 2051),
(13, '34', 'BEYOĞLU', 1186),
(14, '34', 'BÜYÜKÇEKMECE', 1782),
(15, '34', 'ÇATALCA', 1237),
(16, '34', 'ÇEKMEKÖY', 2052),
(17, '34', 'ESENLER', 2016),
(18, '34', 'ESENYURT', 2053),
(19, '34', 'EYÜP', 1325),
(20, '34', 'FATİH', 1327),
(21, '34', 'GAZİOSMANPAŞA', 1336),
(22, '34', 'GÜNGÖREN', 2010),
(23, '34', 'KADIKÖY', 1421),
(24, '34', 'KAĞITHANE', 1810),
(25, '34', 'KARTAL', 1449),
(26, '34', 'KÜÇÜKÇEKMECE', 1823),
(27, '34', 'MALTEPE', 2012),
(28, '34', 'PENDİK', 1835),
(29, '34', 'SANCAKTEPE', 2054),
(30, '34', 'SARIYER', 1604),
(31, '34', 'SİLİVRİ', 1622),
(32, '34', 'SULTANBEYLİ', 2014),
(33, '34', 'SULTANGAZİ', 2055),
(34, '34', 'ŞİLE', 1659),
(35, '34', 'ŞİŞLİ', 1663),
(36, '34', 'TUZLA', 2015),
(37, '34', 'ÜMRANİYE', 1852),
(38, '34', 'ÜSKÜDAR', 1708),
(39, '34', 'ZEYTİNBURNU', 1739),
(40, '6', 'AKYURT', 1872),
(41, '6', 'ALTINDAĞ', 1130),
(42, '6', 'AYAŞ', 1157),
(43, '6', 'BALA', 1167),
(44, '6', 'BEYPAZARI', 1187),
(45, '6', 'ÇAMLIDERE', 1227),
(46, '6', 'ÇANKAYA', 1231),
(47, '6', 'ÇUBUK', 1260),
(48, '6', 'ELMADAĞ', 1302),
(49, '6', 'ETİMESGUT', 1922),
(50, '6', 'EVREN', 1924),
(51, '6', 'GÖLBAŞI', 1744),
(52, '6', 'GÜDÜL', 1365),
(53, '6', 'HAYMANA', 1387),
(54, '6', 'KAHRAMANKAZAN', 1815),
(55, '6', 'KALECİK', 1427),
(56, '6', 'KEÇİÖREN', 1745),
(57, '6', 'KIZILCAHAMAM', 1473),
(58, '6', 'MAMAK', 1746),
(59, '6', 'NALLIHAN', 1539),
(60, '6', 'POLATLI', 1578),
(61, '6', 'PURSAKLAR', 2034),
(62, '6', 'SİNCAN', 1747),
(63, '6', 'ŞEREFLİKOÇHİSAR', 1658),
(64, '6', 'YENİMAHALLE', 1723),
(65, '35', 'ALİAĞA', 1128),
(66, '35', 'BALÇOVA', 2006),
(67, '35', 'BAYINDIR', 1178),
(68, '35', 'BAYRAKLI', 2056),
(69, '35', 'BERGAMA', 1181),
(70, '35', 'BEYDAĞ', 1776),
(71, '35', 'BORNOVA', 1203),
(72, '35', 'BUCA', 1780),
(73, '35', 'ÇEŞME', 1251),
(74, '35', 'ÇİĞLİ', 2007),
(75, '35', 'DİKİLİ', 1280),
(76, '35', 'FOÇA', 1334),
(77, '35', 'GAZİEMİR', 2009),
(78, '35', 'GÜZELBAHÇE', 2018),
(79, '35', 'KARABAĞLAR', 2057),
(80, '35', 'KARABURUN', 1432),
(81, '35', 'KARŞIYAKA', 1448),
(82, '35', 'KEMALPAŞA', 1461),
(83, '35', 'KINIK', 1467),
(84, '35', 'KİRAZ', 1477),
(85, '35', 'KONAK', 1819),
(86, '35', 'MENDERES', 1826),
(87, '35', 'MENEMEN', 1521),
(88, '35', 'NARLIDERE', 2013),
(89, '35', 'ÖDEMİŞ', 1563),
(90, '35', 'SEFERİHİSAR', 1611),
(91, '35', 'SELÇUK', 1612),
(92, '35', 'TİRE', 1677),
(93, '35', 'TORBALI', 1682),
(94, '35', 'URLA', 1703),
(95, '16', 'BÜYÜKORHAN', 1783),
(96, '16', 'GEMLİK', 1343),
(97, '16', 'GÜRSU', 1935),
(98, '16', 'HARMANCIK', 1799),
(99, '16', 'İNEGÖL', 1411),
(100, '16', 'İZNİK', 1420),
(101, '16', 'KARACABEY', 1434),
(102, '16', 'KELES', 1457),
(103, '16', 'KESTEL', 1960),
(104, '16', 'MUDANYA', 1530),
(105, '16', 'MUSTAFAKEMALPAŞA', 1535),
(106, '16', 'NİLÜFER', 1829),
(107, '16', 'ORHANELİ', 1553),
(108, '16', 'ORHANGAZİ', 1554),
(109, '16', 'OSMANGAZİ', 1832),
(110, '16', 'YENİŞEHİR', 1725),
(111, '16', 'YILDIRIM', 1859),
(112, '1', 'ALADAĞ', 1757),
(113, '1', 'CEYHAN', 1219),
(114, '1', 'ÇUKUROVA', 2033),
(115, '1', 'FEKE', 1329),
(116, '1', 'İMAMOĞLU', 1806),
(117, '1', 'KARAİSALI', 1437),
(118, '1', 'KARATAŞ', 1443),
(119, '1', 'KOZAN', 1486),
(120, '1', 'POZANTI', 1580),
(121, '1', 'SAİMBEYLİ', 1588),
(122, '1', 'SARIÇAM', 2032),
(123, '1', 'SEYHAN', 1104),
(124, '1', 'TUFANBEYLİ', 1687),
(125, '1', 'YUMURTALIK', 1734),
(126, '1', 'YÜREĞİR', 1748),
(127, '2', 'BESNİ', 1182),
(128, '2', 'ÇELİKHAN', 1246),
(129, '2', 'GERGER', 1347),
(130, '2', 'GÖLBAŞI', 1354),
(131, '2', 'KAHTA', 1425),
(132, '2', 'MERKEZ', 1105),
(133, '2', 'SAMSAT', 1592),
(134, '2', 'SİNCİK', 1985),
(135, '2', 'TUT', 1989),
(136, '3', 'BAŞMAKÇI', 1771),
(137, '3', 'BAYAT', 1773),
(138, '3', 'BOLVADİN', 1200),
(139, '3', 'ÇAY', 1239),
(140, '3', 'ÇOBANLAR', 1906),
(141, '3', 'DAZKIRI', 1267),
(142, '3', 'DİNAR', 1281),
(143, '3', 'EMİRDAĞ', 1306),
(144, '3', 'EVCİLER', 1923),
(145, '3', 'HOCALAR', 1944),
(146, '3', 'İHSANİYE', 1404),
(147, '3', 'İSCEHİSAR', 1809),
(148, '3', 'KIZILÖREN', 1961),
(149, '3', 'MERKEZ', 1108),
(150, '3', 'SANDIKLI', 1594),
(151, '3', 'SİNANPAŞA', 1626),
(152, '3', 'SULTANDAĞI', 1639),
(153, '3', 'ŞUHUT', 1664),
(154, '4', 'DİYADİN', 1283),
(155, '4', 'DOĞUBAYAZIT', 1287),
(156, '4', 'ELEŞKİRT', 1301),
(157, '4', 'HAMUR', 1379),
(158, '4', 'MERKEZ', 1111),
(159, '4', 'PATNOS', 1568),
(160, '4', 'TAŞLIÇAY', 1667),
(161, '4', 'TUTAK', 1691),
(162, '68', 'AĞAÇÖREN', 1860),
(163, '68', 'ESKİL', 1921),
(164, '68', 'GÜLAĞAÇ', 1932),
(165, '68', 'GÜZELYURT', 1861),
(166, '68', 'MERKEZ', 1120),
(167, '68', 'ORTAKÖY', 1557),
(168, '68', 'SARIYAHŞİ', 1866),
(169, '5', 'GÖYNÜCEK', 1363),
(170, '5', 'GÜMÜŞHACIKÖY', 1368),
(171, '5', 'HAMAMÖZÜ', 1938),
(172, '5', 'MERKEZ', 1134),
(173, '5', 'MERZİFON', 1524),
(174, '5', 'SULUOVA', 1641),
(175, '5', 'TAŞOVA', 1668),
(176, '7', 'AKSEKİ', 1121),
(177, '7', 'AKSU', 2035),
(178, '7', 'ALANYA', 1126),
(179, '7', 'DEMRE', 1811),
(180, '7', 'DÖŞEMEALTI', 2036),
(181, '7', 'ELMALI', 1303),
(182, '7', 'FİNİKE', 1333),
(183, '7', 'GAZİPAŞA', 1337),
(184, '7', 'GÜNDOĞMUŞ', 1370),
(185, '7', 'İBRADI', 1946),
(186, '7', 'KAŞ', 1451),
(187, '7', 'KEMER', 1959),
(188, '7', 'KEPEZ', 2037),
(189, '7', 'KONYAALTI', 2038),
(190, '7', 'KORKUTELİ', 1483),
(191, '7', 'KUMLUCA', 1492),
(192, '7', 'MANAVGAT', 1512),
(193, '7', 'MURATPAŞA', 2039),
(194, '7', 'SERİK', 1616),
(195, '75', 'ÇILDIR', 1252),
(196, '75', 'DAMAL', 2008),
(197, '75', 'GÖLE', 1356),
(198, '75', 'HANAK', 1380),
(199, '75', 'MERKEZ', 1144),
(200, '75', 'POSOF', 1579),
(201, '8', 'ARDANUÇ', 1145),
(202, '8', 'ARHAVİ', 1147),
(203, '8', 'BORÇKA', 1202),
(204, '8', 'HOPA', 1395),
(205, '8', 'MERKEZ', 1152),
(206, '8', 'MURGUL', 1828),
(207, '8', 'ŞAVŞAT', 1653),
(208, '8', 'YUSUFELİ', 1736),
(209, '9', 'BOZDOĞAN', 1206),
(210, '9', 'BUHARKENT', 1781),
(211, '9', 'ÇİNE', 1256),
(212, '9', 'DİDİM', 2000),
(213, '9', 'EFELER', 2076),
(214, '9', 'GERMENCİK', 1348),
(215, '9', 'İNCİRLİOVA', 1807),
(216, '9', 'KARACASU', 1435),
(217, '9', 'KARPUZLU', 1957),
(218, '9', 'KOÇARLI', 1479),
(219, '9', 'KÖŞK', 1968),
(220, '9', 'KUŞADASI', 1497),
(221, '9', 'KUYUCAK', 1498),
(222, '9', 'NAZİLLİ', 1542),
(223, '9', 'SÖKE', 1637),
(224, '9', 'SULTANHİSAR', 1640),
(225, '9', 'YENİPAZAR', 1724),
(226, '10', 'ALTIEYLÜL', 2077),
(227, '10', 'AYVALIK', 1161),
(228, '10', 'BALYA', 1169),
(229, '10', 'BANDIRMA', 1171),
(230, '10', 'BİGADİÇ', 1191),
(231, '10', 'BURHANİYE', 1216),
(232, '10', 'DURSUNBEY', 1291),
(233, '10', 'EDREMİT', 1294),
(234, '10', 'ERDEK', 1310),
(235, '10', 'GÖMEÇ', 1928),
(236, '10', 'GÖNEN', 1360),
(237, '10', 'HAVRAN', 1384),
(238, '10', 'İVRİNDİ', 1418),
(239, '10', 'KARESİ', 2078),
(240, '10', 'KEPSUT', 1462),
(241, '10', 'MANYAS', 1514),
(242, '10', 'MARMARA', 1824),
(243, '10', 'SAVAŞTEPE', 1608),
(244, '10', 'SINDIRGI', 1619),
(245, '10', 'SUSURLUK', 1644),
(246, '74', 'AMASRA', 1761),
(247, '74', 'KURUCAŞİLE', 1496),
(248, '74', 'MERKEZ', 1172),
(249, '74', 'ULUS', 1701),
(250, '72', 'BEŞİRİ', 1184),
(251, '72', 'GERCÜŞ', 1345),
(252, '72', 'HASANKEYF', 1941),
(253, '72', 'KOZLUK', 1487),
(254, '72', 'MERKEZ', 1174),
(255, '72', 'SASON', 1607),
(256, '69', 'AYDINTEPE', 1767),
(257, '69', 'DEMİRÖZÜ', 1788),
(258, '69', 'MERKEZ', 1176),
(259, '11', 'BOZÜYÜK', 1210),
(260, '11', 'GÖLPAZARI', 1359),
(261, '11', 'İNHİSAR', 1948),
(262, '11', 'MERKEZ', 1192),
(263, '11', 'OSMANELİ', 1559),
(264, '11', 'PAZARYERİ', 1571),
(265, '11', 'SÖĞÜT', 1636),
(266, '11', 'YENİPAZAR', 1857),
(267, '12', 'ADAKLI', 1750),
(268, '12', 'GENÇ', 1344),
(269, '12', 'KARLIOVA', 1446),
(270, '12', 'KİĞI', 1475),
(271, '12', 'MERKEZ', 1193),
(272, '12', 'SOLHAN', 1633),
(273, '12', 'YAYLADERE', 1855),
(274, '12', 'YEDİSU', 1996),
(275, '13', 'ADİLCEVAZ', 1106),
(276, '13', 'AHLAT', 1112),
(277, '13', 'GÜROYMAK', 1798),
(278, '13', 'HİZAN', 1394),
(279, '13', 'MERKEZ', 1196),
(280, '13', 'MUTKİ', 1537),
(281, '13', 'TATVAN', 1669),
(282, '14', 'DÖRTDİVAN', 1916),
(283, '14', 'GEREDE', 1346),
(284, '14', 'GÖYNÜK', 1364),
(285, '14', 'KIBRISCIK', 1466),
(286, '14', 'MENGEN', 1522),
(287, '14', 'MERKEZ', 1199),
(288, '14', 'MUDURNU', 1531),
(289, '14', 'SEBEN', 1610),
(290, '14', 'YENİÇAĞA', 1997),
(291, '15', 'AĞLASUN', 1109),
(292, '15', 'ALTINYAYLA', 1874),
(293, '15', 'BUCAK', 1211),
(294, '15', 'ÇAVDIR', 1899),
(295, '15', 'ÇELTİKÇİ', 1903),
(296, '15', 'GÖLHİSAR', 1357),
(297, '15', 'KARAMANLI', 1813),
(298, '15', 'KEMER', 1816),
(299, '15', 'MERKEZ', 1215),
(300, '15', 'TEFENNİ', 1672),
(301, '15', 'YEŞİLOVA', 1728),
(302, '17', 'AYVACIK', 1160),
(303, '17', 'BAYRAMİÇ', 1180),
(304, '17', 'BİGA', 1190),
(305, '17', 'BOZCAADA', 1205),
(306, '17', 'ÇAN', 1229),
(307, '17', 'ECEABAT', 1293),
(308, '17', 'EZİNE', 1326),
(309, '17', 'GELİBOLU', 1340),
(310, '17', 'GÖKÇEADA', 1408),
(311, '17', 'LAPSEKİ', 1503),
(312, '17', 'MERKEZ', 1230),
(313, '17', 'YENİCE', 1722),
(314, '18', 'ATKARACALAR', 1765),
(315, '18', 'BAYRAMÖREN', 1885),
(316, '18', 'ÇERKEŞ', 1248),
(317, '18', 'ELDİVAN', 1300),
(318, '18', 'ILGAZ', 1399),
(319, '18', 'KIZILIRMAK', 1817),
(320, '18', 'KORGUN', 1963),
(321, '18', 'KURŞUNLU', 1494),
(322, '18', 'MERKEZ', 1232),
(323, '18', 'ORTA', 1555),
(324, '18', 'ŞABANÖZÜ', 1649),
(325, '18', 'YAPRAKLI', 1718),
(326, '19', 'ALACA', 1124),
(327, '19', 'BAYAT', 1177),
(328, '19', 'BOĞAZKALE', 1778),
(329, '19', 'DODURGA', 1911),
(330, '19', 'İSKİLİP', 1414),
(331, '19', 'KARGI', 1445),
(332, '19', 'LAÇİN', 1972),
(333, '19', 'MECİTÖZÜ', 1520),
(334, '19', 'MERKEZ', 1259),
(335, '19', 'OĞUZLAR', 1976),
(336, '19', 'ORTAKÖY', 1556),
(337, '19', 'OSMANCIK', 1558),
(338, '19', 'SUNGURLU', 1642),
(339, '19', 'UĞURLUDAĞ', 1850),
(340, '20', 'ACIPAYAM', 1102),
(341, '20', 'BABADAĞ', 1769),
(342, '20', 'BAKLAN', 1881),
(343, '20', 'BEKİLLİ', 1774),
(344, '20', 'BEYAĞAÇ', 1888),
(345, '20', 'BOZKURT', 1889),
(346, '20', 'BULDAN', 1214),
(347, '20', 'ÇAL', 1224),
(348, '20', 'ÇAMELİ', 1226),
(349, '20', 'ÇARDAK', 1233),
(350, '20', 'ÇİVRİL', 1257),
(351, '20', 'GÜNEY', 1371),
(352, '20', 'HONAZ', 1803),
(353, '20', 'KALE', 1426),
(354, '20', 'MERKEZEFENDİ', 2079),
(355, '20', 'PAMUKKALE', 1871),
(356, '20', 'SARAYKÖY', 1597),
(357, '20', 'SERİNHİSAR', 1840),
(358, '20', 'TAVAS', 1670),
(359, '21', 'BAĞLAR', 2040),
(360, '21', 'BİSMİL', 1195),
(361, '21', 'ÇERMİK', 1249),
(362, '21', 'ÇINAR', 1253),
(363, '21', 'ÇÜNGÜŞ', 1263),
(364, '21', 'DİCLE', 1278),
(365, '21', 'EĞİL', 1791),
(366, '21', 'ERGANİ', 1315),
(367, '21', 'HANİ', 1381),
(368, '21', 'HAZRO', 1389),
(369, '21', 'KAYAPINAR', 2041),
(370, '21', 'KOCAKÖY', 1962),
(371, '21', 'KULP', 1490),
(372, '21', 'LİCE', 1504),
(373, '21', 'SİLVAN', 1624),
(374, '21', 'SUR', 2042),
(375, '21', 'YENİŞEHİR', 2043),
(376, '41', 'BAŞİSKELE', 2058),
(377, '41', 'ÇAYIROVA', 2059),
(378, '41', 'DARICA', 2060),
(379, '41', 'DERİNCE', 2030),
(380, '41', 'DİLOVASI', 2061),
(381, '41', 'GEBZE', 1338),
(382, '41', 'GÖLCÜK', 1355),
(383, '41', 'İZMİT', 2062),
(384, '41', 'KANDIRA', 1430),
(385, '41', 'KARAMÜRSEL', 1440),
(386, '41', 'KARTEPE', 2063),
(387, '41', 'KÖRFEZ', 1821),
(388, '42', 'AHIRLI', 1868),
(389, '42', 'AKÖREN', 1753),
(390, '42', 'AKŞEHİR', 1122),
(391, '42', 'ALTINEKİN', 1760),
(392, '42', 'BEYŞEHİR', 1188),
(393, '42', 'BOZKIR', 1207),
(394, '42', 'CİHANBEYLİ', 1222),
(395, '42', 'ÇELTİK', 1902),
(396, '42', 'ÇUMRA', 1262),
(397, '42', 'DERBENT', 1907),
(398, '42', 'DEREBUCAK', 1789),
(399, '42', 'DOĞANHİSAR', 1285),
(400, '42', 'EMİRGAZİ', 1920),
(401, '42', 'EREĞLİ', 1312),
(402, '42', 'GÜNEYSINIR', 1933),
(403, '42', 'HADİM', 1375),
(404, '42', 'HALKAPINAR', 1937),
(405, '42', 'HÜYÜK', 1804),
(406, '42', 'ILGIN', 1400),
(407, '42', 'KADINHANI', 1422),
(408, '42', 'KARAPINAR', 1441),
(409, '42', 'KARATAY', 1814),
(410, '42', 'KULU', 1491),
(411, '42', 'MERAM', 1827),
(412, '42', 'SARAYÖNÜ', 1598),
(413, '42', 'SELÇUKLU', 1839),
(414, '42', 'SEYDİŞEHİR', 1617),
(415, '42', 'TAŞKENT', 1848),
(416, '42', 'TUZLUKÇU', 1990),
(417, '42', 'YALIHÜYÜK', 1994),
(418, '42', 'YUNAK', 1735),
(419, '43', 'ALTINTAŞ', 1132),
(420, '43', 'ASLANAPA', 1764),
(421, '43', 'ÇAVDARHİSAR', 1898),
(422, '43', 'DOMANİÇ', 1288),
(423, '43', 'DUMLUPINAR', 1790),
(424, '43', 'EMET', 1304),
(425, '43', 'GEDİZ', 1339),
(426, '43', 'HİSARCIK', 1802),
(427, '43', 'MERKEZ', 1500),
(428, '43', 'PAZARLAR', 1979),
(429, '43', 'SİMAV', 1625),
(430, '43', 'ŞAPHANE', 1843),
(431, '43', 'TAVŞANLI', 1671),
(432, '44', 'AKÇADAĞ', 1114),
(433, '44', 'ARAPGİR', 1143),
(434, '44', 'ARGUVAN', 1148),
(435, '44', 'BATTALGAZİ', 1772),
(436, '44', 'DARENDE', 1265),
(437, '44', 'DOĞANŞEHİR', 1286),
(438, '44', 'DOĞANYOL', 1914),
(439, '44', 'HEKİMHAN', 1390),
(440, '44', 'KALE', 1953),
(441, '44', 'KULUNCAK', 1969),
(442, '44', 'PÜTÜRGE', 1582),
(443, '44', 'YAZIHAN', 1995),
(444, '44', 'YEŞİLYURT', 1729),
(445, '45', 'AHMETLİ', 1751),
(446, '45', 'AKHİSAR', 1118),
(447, '45', 'ALAŞEHİR', 1127),
(448, '45', 'DEMİRCİ', 1269),
(449, '45', 'GÖLMARMARA', 1793),
(450, '45', 'GÖRDES', 1362),
(451, '45', 'KIRKAĞAÇ', 1470),
(452, '45', 'KÖPRÜBAŞI', 1965),
(453, '45', 'KULA', 1489),
(454, '45', 'SALİHLİ', 1590),
(455, '45', 'SARIGÖL', 1600),
(456, '45', 'SARUHANLI', 1606),
(457, '45', 'SELENDİ', 1613),
(458, '45', 'SOMA', 1634),
(459, '45', 'ŞEHZADELER', 2086),
(460, '45', 'TURGUTLU', 1689),
(461, '45', 'YUNUSEMRE', 2087),
(462, '47', 'ARTUKLU', 2088),
(463, '47', 'DARGEÇİT', 1787),
(464, '47', 'DERİK', 1273),
(465, '47', 'KIZILTEPE', 1474),
(466, '47', 'MAZIDAĞI', 1519),
(467, '47', 'MİDYAT', 1526),
(468, '47', 'NUSAYBİN', 1547),
(469, '47', 'ÖMERLİ', 1564),
(470, '47', 'SAVUR', 1609),
(471, '47', 'YEŞİLLİ', 2002),
(472, '33', 'AKDENİZ', 2064),
(473, '33', 'ANAMUR', 1135),
(474, '33', 'AYDINCIK', 1766),
(475, '33', 'BOZYAZI', 1779),
(476, '33', 'ÇAMLIYAYLA', 1892),
(477, '33', 'ERDEMLİ', 1311),
(478, '33', 'GÜLNAR', 1366),
(479, '33', 'MEZİTLİ', 2065),
(480, '33', 'MUT', 1536),
(481, '33', 'SİLİFKE', 1621),
(482, '33', 'TARSUS', 1665),
(483, '33', 'TOROSLAR', 2066),
(484, '33', 'YENİŞEHİR', 2067),
(485, '48', 'BODRUM', 1197),
(486, '48', 'DALAMAN', 1742),
(487, '48', 'DATÇA', 1266),
(488, '48', 'FETHİYE', 1331),
(489, '48', 'KAVAKLIDERE', 1958),
(490, '48', 'KÖYCEĞİZ', 1488),
(491, '48', 'MARMARİS', 1517),
(492, '48', 'MENTEŞE', 2089),
(493, '48', 'MİLAS', 1528),
(494, '48', 'ORTACA', 1831),
(495, '48', 'SEYDİKEMER', 2090),
(496, '48', 'ULA', 1695),
(497, '48', 'YATAĞAN', 1719),
(498, '49', 'BULANIK', 1213),
(499, '49', 'HASKÖY', 1801),
(500, '49', 'KORKUT', 1964),
(501, '49', 'MALAZGİRT', 1510),
(502, '49', 'MERKEZ', 1534),
(503, '49', 'VARTO', 1711),
(504, '50', 'ACIGÖL', 1749),
(505, '50', 'AVANOS', 1155),
(506, '50', 'DERİNKUYU', 1274),
(507, '50', 'GÜLŞEHİR', 1367),
(508, '50', 'HACIBEKTAŞ', 1374),
(509, '50', 'KOZAKLI', 1485),
(510, '50', 'MERKEZ', 1543),
(511, '50', 'ÜRGÜP', 1707),
(512, '51', 'ALTUNHİSAR', 1876),
(513, '51', 'BOR', 1201),
(514, '51', 'ÇAMARDI', 1225),
(515, '51', 'ÇİFTLİK', 1904),
(516, '51', 'MERKEZ', 1544),
(517, '51', 'ULUKIŞLA', 1700),
(518, '52', 'AKKUŞ', 1119),
(519, '52', 'ALTINORDU', 2103),
(520, '52', 'AYBASTI', 1158),
(521, '52', 'ÇAMAŞ', 1891),
(522, '52', 'ÇATALPINAR', 1897),
(523, '52', 'ÇAYBAŞI', 1900),
(524, '52', 'FATSA', 1328),
(525, '52', 'GÖLKÖY', 1358),
(526, '52', 'GÜLYALI', 1795),
(527, '52', 'GÜRGENTEPE', 1797),
(528, '52', 'İKİZCE', 1947),
(529, '52', 'KABADÜZ', 1950),
(530, '52', 'KABATAŞ', 1951),
(531, '52', 'KORGAN', 1482),
(532, '52', 'KUMRU', 1493),
(533, '52', 'MESUDİYE', 1525),
(534, '52', 'PERŞEMBE', 1573),
(535, '52', 'ULUBEY', 1696),
(536, '52', 'ÜNYE', 1706),
(537, '80', 'BAHÇE', 1165),
(538, '80', 'DÜZİÇİ', 1743),
(539, '80', 'HASANBEYLİ', 2027),
(540, '80', 'KADİRLİ', 1423),
(541, '80', 'MERKEZ', 1560),
(542, '80', 'SUMBAS', 2028),
(543, '80', 'TOPRAKKALE', 2029),
(544, '53', 'ARDEŞEN', 1146),
(545, '53', 'ÇAMLIHEMŞİN', 1228),
(546, '53', 'ÇAYELİ', 1241),
(547, '53', 'DEREPAZARI', 1908),
(548, '53', 'FINDIKLI', 1332),
(549, '53', 'GÜNEYSU', 1796),
(550, '53', 'HEMŞİN', 1943),
(551, '53', 'İKİZDERE', 1405),
(552, '53', 'İYİDERE', 1949),
(553, '53', 'KALKANDERE', 1428),
(554, '53', 'MERKEZ', 1586),
(555, '53', 'PAZAR', 1569),
(556, '54', 'ADAPAZARI', 2068),
(557, '54', 'AKYAZI', 1123),
(558, '54', 'ARİFİYE', 2069),
(559, '54', 'ERENLER', 2070),
(560, '54', 'FERİZLİ', 1925),
(561, '54', 'GEYVE', 1351),
(562, '54', 'HENDEK', 1391),
(563, '54', 'KARAPÜRÇEK', 1955),
(564, '54', 'KARASU', 1442),
(565, '54', 'KAYNARCA', 1453),
(566, '54', 'KOCAALİ', 1818),
(567, '54', 'PAMUKOVA', 1833),
(568, '54', 'SAPANCA', 1595),
(569, '54', 'SERDİVAN', 2071),
(570, '54', 'SÖĞÜTLÜ', 1986),
(571, '54', 'TARAKLI', 1847),
(572, '55', 'ALAÇAM', 1125),
(573, '55', 'ASARCIK', 1763),
(574, '55', 'ATAKUM', 2072),
(575, '55', 'AYVACIK', 1879),
(576, '55', 'BAFRA', 1164),
(577, '55', 'CANİK', 2073),
(578, '55', 'ÇARŞAMBA', 1234),
(579, '55', 'HAVZA', 1386),
(580, '55', 'İLKADIM', 2074),
(581, '55', 'KAVAK', 1452),
(582, '55', 'LADİK', 1501),
(583, '55', 'SALIPAZARI', 1838),
(584, '55', 'TEKKEKÖY', 1849),
(585, '55', 'TERME', 1676),
(586, '55', 'VEZİRKÖPRÜ', 1712),
(587, '55', 'YAKAKENT', 1993),
(588, '55', '19 MAYIS', 1830),
(589, '56', 'BAYKAN', 1179),
(590, '56', 'ERUH', 1317),
(591, '56', 'KURTALAN', 1495),
(592, '56', 'MERKEZ', 1620),
(593, '56', 'PERVARİ', 1575),
(594, '56', 'ŞİRVAN', 1662),
(595, '56', 'TİLLO', 1878),
(596, '57', 'AYANCIK', 1156),
(597, '57', 'BOYABAT', 1204),
(598, '57', 'DİKMEN', 1910),
(599, '57', 'DURAĞAN', 1290),
(600, '57', 'ERFELEK', 1314),
(601, '57', 'GERZE', 1349),
(602, '57', 'MERKEZ', 1627),
(603, '57', 'SARAYDÜZÜ', 1981),
(604, '57', 'TÜRKELİ', 1693),
(605, '73', 'BEYTÜŞŞEBAP', 1189),
(606, '73', 'CİZRE', 1223),
(607, '73', 'GÜÇLÜKONAK', 1931),
(608, '73', 'İDİL', 1403),
(609, '73', 'MERKEZ', 1661),
(610, '73', 'SİLOPİ', 1623),
(611, '73', 'ULUDERE', 1698),
(612, '58', 'AKINCILAR', 1870),
(613, '58', 'ALTINYAYLA', 1875),
(614, '58', 'DİVRİĞİ', 1282),
(615, '58', 'DOĞANŞAR', 1913),
(616, '58', 'GEMEREK', 1342),
(617, '58', 'GÖLOVA', 1927),
(618, '58', 'GÜRÜN', 1373),
(619, '58', 'HAFİK', 1376),
(620, '58', 'İMRANLI', 1407),
(621, '58', 'KANGAL', 1431),
(622, '58', 'KOYULHİSAR', 1484),
(623, '58', 'MERKEZ', 1628),
(624, '58', 'SUŞEHRİ', 1646),
(625, '58', 'ŞARKIŞLA', 1650),
(626, '58', 'ULAŞ', 1991),
(627, '58', 'YILDIZELİ', 1731),
(628, '58', 'ZARA', 1738),
(629, '59', 'ÇERKEZKÖY', 1250),
(630, '59', 'ÇORLU', 1258),
(631, '59', 'ERGENE', 2094),
(632, '59', 'HAYRABOLU', 1388),
(633, '59', 'KAPAKLI', 2095),
(634, '59', 'MALKARA', 1511),
(635, '59', 'MARMARAEREĞLİSİ', 1825),
(636, '59', 'MURATLI', 1538),
(637, '59', 'SARAY', 1596),
(638, '59', 'SÜLEYMANPAŞA', 2096),
(639, '59', 'ŞARKÖY', 1652),
(640, '60', 'ALMUS', 1129),
(641, '60', 'ARTOVA', 1151),
(642, '60', 'BAŞÇİFTLİK', 1883),
(643, '60', 'ERBAA', 1308),
(644, '60', 'MERKEZ', 1679),
(645, '60', 'NİKSAR', 1545),
(646, '60', 'PAZAR', 1834),
(647, '60', 'REŞADİYE', 1584),
(648, '60', 'SULUSARAY', 1987),
(649, '60', 'TURHAL', 1690),
(650, '60', 'YEŞİLYURT', 1858),
(651, '60', 'ZİLE', 1740),
(652, '61', 'AKÇAABAT', 1113),
(653, '61', 'ARAKLI', 1141),
(654, '61', 'ARSİN', 1150),
(655, '61', 'BEŞİKDÜZÜ', 1775),
(656, '61', 'ÇARŞIBAŞI', 1896),
(657, '61', 'ÇAYKARA', 1244),
(658, '61', 'DERNEKPAZARI', 1909),
(659, '61', 'DÜZKÖY', 1917),
(660, '61', 'HAYRAT', 1942),
(661, '61', 'KÖPRÜBAŞI', 1966),
(662, '61', 'MAÇKA', 1507),
(663, '61', 'OF', 1548),
(664, '61', 'ORTAHİSAR', 2097),
(665, '61', 'SÜRMENE', 1647),
(666, '61', 'ŞALPAZARI', 1842),
(667, '61', 'TONYA', 1681),
(668, '61', 'VAKFIKEBİR', 1709),
(669, '61', 'YOMRA', 1732),
(670, '62', 'ÇEMİŞGEZEK', 1247),
(671, '62', 'HOZAT', 1397),
(672, '62', 'MAZGİRT', 1518),
(673, '62', 'MERKEZ', 1688),
(674, '62', 'NAZIMİYE', 1541),
(675, '62', 'OVACIK', 1562),
(676, '62', 'PERTEK', 1574),
(677, '62', 'PÜLÜMÜR', 1581),
(678, '63', 'AKÇAKALE', 1115),
(679, '63', 'BİRECİK', 1194),
(680, '63', 'BOZOVA', 1209),
(681, '63', 'CEYLANPINAR', 1220),
(682, '63', 'EYYÜBİYE', 2091),
(683, '63', 'HALFETİ', 1378),
(684, '63', 'HALİLİYE', 2092),
(685, '63', 'HARRAN', 1800),
(686, '63', 'HİLVAN', 1393),
(687, '63', 'KARAKÖPRÜ', 2093),
(688, '63', 'SİVEREK', 1630),
(689, '63', 'SURUÇ', 1643),
(690, '63', 'VİRANŞEHİR', 1713),
(691, '64', 'BANAZ', 1170),
(692, '64', 'EŞME', 1323),
(693, '64', 'KARAHALLI', 1436),
(694, '64', 'MERKEZ', 1704),
(695, '64', 'SİVASLI', 1629),
(696, '64', 'ULUBEY', 1697),
(697, '65', 'BAHÇESARAY', 1770),
(698, '65', 'BAŞKALE', 1175),
(699, '65', 'ÇALDIRAN', 1786),
(700, '65', 'ÇATAK', 1236),
(701, '65', 'EDREMİT', 1918),
(702, '65', 'ERCİŞ', 1309),
(703, '65', 'GEVAŞ', 1350),
(704, '65', 'GÜRPINAR', 1372),
(705, '65', 'İPEKYOLU', 2098),
(706, '65', 'MURADİYE', 1533),
(707, '65', 'ÖZALP', 1565),
(708, '65', 'SARAY', 1980),
(709, '65', 'TUŞBA', 2099),
(710, '77', 'ALTINOVA', 2019),
(711, '77', 'ARMUTLU', 2020),
(712, '77', 'ÇINARCIK', 2021),
(713, '77', 'ÇİFTLİKKÖY', 2022),
(714, '77', 'MERKEZ', 1716),
(715, '77', 'TERMAL', 2026),
(716, '66', 'AKDAĞMADENİ', 1117),
(717, '66', 'AYDINCIK', 1877),
(718, '66', 'BOĞAZLIYAN', 1198),
(719, '66', 'ÇANDIR', 1895),
(720, '66', 'ÇAYIRALAN', 1242),
(721, '66', 'ÇEKEREK', 1245),
(722, '66', 'KADIŞEHRİ', 1952),
(723, '66', 'MERKEZ', 1733),
(724, '66', 'SARAYKENT', 1982),
(725, '66', 'SARIKAYA', 1602),
(726, '66', 'SORGUN', 1635),
(727, '66', 'ŞEFAATLİ', 1655),
(728, '66', 'YENİFAKILI', 1998),
(729, '66', 'YERKÖY', 1726),
(730, '67', 'ALAPLI', 1758),
(731, '67', 'ÇAYCUMA', 1240),
(732, '67', 'DEVREK', 1276),
(733, '67', 'EREĞLİ', 1313),
(734, '67', 'GÖKÇEBEY', 1926),
(735, '67', 'KİLİMLİ', 2100),
(736, '67', 'KOZLU', 2101),
(737, '67', 'MERKEZ', 1741),
(738, '81', 'AKÇAKOCA', 1116),
(739, '81', 'CUMAYERİ', 1784),
(740, '81', 'ÇİLİMLİ', 1905),
(741, '81', 'GÖLYAKA', 1794),
(742, '81', 'GÜMÜŞOVA', 2017),
(743, '81', 'KAYNAŞLI', 2031),
(744, '81', 'MERKEZ', 1292),
(745, '81', 'YIĞILCA', 1730),
(746, '22', 'ENEZ', 1307),
(747, '22', 'HAVSA', 1385),
(748, '22', 'İPSALA', 1412),
(749, '22', 'KEŞAN', 1464),
(750, '22', 'LALAPAŞA', 1502),
(751, '22', 'MERİÇ', 1523),
(752, '22', 'MERKEZ', 1295),
(753, '22', 'SÜLOĞLU', 1988),
(754, '22', 'UZUNKÖPRÜ', 1705),
(755, '23', 'AĞIN', 1110),
(756, '23', 'ALACAKAYA', 1873),
(757, '23', 'ARICAK', 1762),
(758, '23', 'BASKİL', 1173),
(759, '23', 'KARAKOÇAN', 1438),
(760, '23', 'KEBAN', 1455),
(761, '23', 'KOVANCILAR', 1820),
(762, '23', 'MADEN', 1506),
(763, '23', 'MERKEZ', 1298),
(764, '23', 'PALU', 1566),
(765, '23', 'SİVRİCE', 1631),
(766, '24', 'ÇAYIRLI', 1243),
(767, '24', 'İLİÇ', 1406),
(768, '24', 'KEMAH', 1459),
(769, '24', 'KEMALİYE', 1460),
(770, '24', 'MERKEZ', 1318),
(771, '24', 'OTLUKBELİ', 1977),
(772, '24', 'REFAHİYE', 1583),
(773, '24', 'TERCAN', 1675),
(774, '24', 'ÜZÜMLÜ', 1853),
(775, '25', 'AŞKALE', 1153),
(776, '25', 'AZİZİYE', 1945),
(777, '25', 'ÇAT', 1235),
(778, '25', 'HINIS', 1392),
(779, '25', 'HORASAN', 1396),
(780, '25', 'İSPİR', 1416),
(781, '25', 'KARAÇOBAN', 1812),
(782, '25', 'KARAYAZI', 1444),
(783, '25', 'KÖPRÜKÖY', 1967),
(784, '25', 'NARMAN', 1540),
(785, '25', 'OLTU', 1550),
(786, '25', 'OLUR', 1551),
(787, '25', 'PALANDÖKEN', 2044),
(788, '25', 'PASİNLER', 1567),
(789, '25', 'PAZARYOLU', 1865),
(790, '25', 'ŞENKAYA', 1657),
(791, '25', 'TEKMAN', 1674),
(792, '25', 'TORTUM', 1683),
(793, '25', 'UZUNDERE', 1851),
(794, '25', 'YAKUTİYE', 2045),
(795, '26', 'ALPU', 1759),
(796, '26', 'BEYLİKOVA', 1777),
(797, '26', 'ÇİFTELER', 1255),
(798, '26', 'GÜNYÜZÜ', 1934),
(799, '26', 'HAN', 1939),
(800, '26', 'İNÖNÜ', 1808),
(801, '26', 'MAHMUDİYE', 1508),
(802, '26', 'MİHALGAZİ', 1973),
(803, '26', 'MİHALIÇÇIK', 1527),
(804, '26', 'ODUNPAZARI', 2046),
(805, '26', 'SARICAKAYA', 1599),
(806, '26', 'SEYİTGAZİ', 1618),
(807, '26', 'SİVRİHİSAR', 1632),
(808, '26', 'TEPEBAŞI', 2047),
(809, '27', 'ARABAN', 1139),
(810, '27', 'İSLAHİYE', 1415),
(811, '27', 'KARKAMIŞ', 1956),
(812, '27', 'NİZİP', 1546),
(813, '27', 'NURDAĞI', 1974),
(814, '27', 'OĞUZELİ', 1549),
(815, '27', 'ŞAHİNBEY', 1841),
(816, '27', 'ŞEHİTKAMİL', 1844),
(817, '27', 'YAVUZELİ', 1720),
(818, '28', 'ALUCRA', 1133),
(819, '28', 'BULANCAK', 1212),
(820, '28', 'ÇAMOLUK', 1893),
(821, '28', 'ÇANAKÇI', 1894),
(822, '28', 'DERELİ', 1272),
(823, '28', 'DOĞANKENT', 1912),
(824, '28', 'ESPİYE', 1320),
(825, '28', 'EYNESİL', 1324),
(826, '28', 'GÖRELE', 1361),
(827, '28', 'GÜCE', 1930),
(828, '28', 'KEŞAP', 1465),
(829, '28', 'MERKEZ', 1352),
(830, '28', 'PİRAZİZ', 1837),
(831, '28', 'ŞEBİNKARAHİSAR', 1654),
(832, '28', 'TİREBOLU', 1678),
(833, '28', 'YAĞLIDERE', 1854),
(834, '29', 'KELKİT', 1458),
(835, '29', 'KÖSE', 1822),
(836, '29', 'KÜRTÜN', 1971),
(837, '29', 'MERKEZ', 1369),
(838, '29', 'ŞİRAN', 1660),
(839, '29', 'TORUL', 1684),
(840, '30', 'ÇUKURCA', 1261),
(841, '30', 'MERKEZ', 1377),
(842, '30', 'ŞEMDİNLİ', 1656),
(843, '30', 'YÜKSEKOVA', 1737),
(844, '31', 'ALTINÖZÜ', 1131),
(845, '31', 'ANTAKYA', 2080),
(846, '31', 'ARSUZ', 2081),
(847, '31', 'BELEN', 1887),
(848, '31', 'DEFNE', 2082),
(849, '31', 'DÖRTYOL', 1289),
(850, '31', 'ERZİN', 1792),
(851, '31', 'HASSA', 1382),
(852, '31', 'İSKENDERUN', 1413),
(853, '31', 'KIRIKHAN', 1468),
(854, '31', 'KUMLU', 1970),
(855, '31', 'PAYAS', 2083),
(856, '31', 'REYHANLI', 1585),
(857, '31', 'SAMANDAĞ', 1591),
(858, '31', 'YAYLADAĞI', 1721),
(859, '76', 'ARALIK', 1142),
(860, '76', 'KARAKOYUNLU', 2011),
(861, '76', 'MERKEZ', 1398),
(862, '76', 'TUZLUCA', 1692),
(863, '32', 'AKSU', 1755),
(864, '32', 'ATABEY', 1154),
(865, '32', 'EĞİRDİR', 1297),
(866, '32', 'GELENDOST', 1341),
(867, '32', 'GÖNEN', 1929),
(868, '32', 'KEÇİBORLU', 1456),
(869, '32', 'MERKEZ', 1401),
(870, '32', 'SENİRKENT', 1615),
(871, '32', 'SÜTÇÜLER', 1648),
(872, '32', 'ŞARKİKARAAĞAÇ', 1651),
(873, '32', 'ULUBORLU', 1699),
(874, '32', 'YALVAÇ', 1717),
(875, '32', 'YENİŞARBADEMLİ', 2001),
(876, '46', 'AFŞİN', 1107),
(877, '46', 'ANDIRIN', 1136),
(878, '46', 'ÇAĞLAYANCERİT', 1785),
(879, '46', 'DULKADİROĞLU', 2084),
(880, '46', 'EKİNÖZÜ', 1919),
(881, '46', 'ELBİSTAN', 1299),
(882, '46', 'GÖKSUN', 1353),
(883, '46', 'NURHAK', 1975),
(884, '46', 'ONİKİŞUBAT', 2085),
(885, '46', 'PAZARCIK', 1570),
(886, '46', 'TÜRKOĞLU', 1694),
(887, '78', 'EFLANİ', 1296),
(888, '78', 'ESKİPAZAR', 1321),
(889, '78', 'MERKEZ', 1433),
(890, '78', 'OVACIK', 1561),
(891, '78', 'SAFRANBOLU', 1587),
(892, '78', 'YENİCE', 1856),
(893, '70', 'AYRANCI', 1768),
(894, '70', 'BAŞYAYLA', 1884),
(895, '70', 'ERMENEK', 1316),
(896, '70', 'KAZIMKARABEKİR', 1862),
(897, '70', 'MERKEZ', 1439),
(898, '70', 'SARIVELİLER', 1983),
(899, '36', 'AKYAKA', 1756),
(900, '36', 'ARPAÇAY', 1149),
(901, '36', 'DİGOR', 1279),
(902, '36', 'KAĞIZMAN', 1424),
(903, '36', 'MERKEZ', 1447),
(904, '36', 'SARIKAMIŞ', 1601),
(905, '36', 'SELİM', 1614),
(906, '36', 'SUSUZ', 1645),
(907, '37', 'ABANA', 1101),
(908, '37', 'AĞLI', 1867),
(909, '37', 'ARAÇ', 1140),
(910, '37', 'AZDAVAY', 1162),
(911, '37', 'BOZKURT', 1208),
(912, '37', 'CİDE', 1221),
(913, '37', 'ÇATALZEYTİN', 1238),
(914, '37', 'DADAY', 1264),
(915, '37', 'DEVREKANİ', 1277),
(916, '37', 'DOĞANYURT', 1915),
(917, '37', 'HANÖNÜ', 1940),
(918, '37', 'İHSANGAZİ', 1805),
(919, '37', 'İNEBOLU', 1410),
(920, '37', 'KÜRE', 1499),
(921, '37', 'MERKEZ', 1450),
(922, '37', 'PINARBAŞI', 1836),
(923, '37', 'SEYDİLER', 1984),
(924, '37', 'ŞENPAZAR', 1845),
(925, '37', 'TAŞKÖPRÜ', 1666),
(926, '37', 'TOSYA', 1685),
(927, '38', 'AKKIŞLA', 1752),
(928, '38', 'BÜNYAN', 1218),
(929, '38', 'DEVELİ', 1275),
(930, '38', 'FELAHİYE', 1330),
(931, '38', 'HACILAR', 1936),
(932, '38', 'İNCESU', 1409),
(933, '38', 'KOCASİNAN', 1863),
(934, '38', 'MELİKGAZİ', 1864),
(935, '38', 'ÖZVATAN', 1978),
(936, '38', 'PINARBAŞI', 1576),
(937, '38', 'SARIOĞLAN', 1603),
(938, '38', 'SARIZ', 1605),
(939, '38', 'TALAS', 1846),
(940, '38', 'TOMARZA', 1680),
(941, '38', 'YAHYALI', 1715),
(942, '38', 'YEŞİLHİSAR', 1727),
(943, '79', 'ELBEYLİ', 2023),
(944, '79', 'MERKEZ', 1476),
(945, '79', 'MUSABEYLİ', 2024),
(946, '79', 'POLATELİ', 2025),
(947, '71', 'BAHŞİLİ', 1880),
(948, '71', 'BALIŞEYH', 1882),
(949, '71', 'ÇELEBİ', 1901),
(950, '71', 'DELİCE', 1268),
(951, '71', 'KARAKEÇİLİ', 1954),
(952, '71', 'KESKİN', 1463),
(953, '71', 'MERKEZ', 1469),
(954, '71', 'SULAKYURT', 1638),
(955, '71', 'YAHŞİHAN', 1992),
(956, '39', 'BABAESKİ', 1163),
(957, '39', 'DEMİRKÖY', 1270),
(958, '39', 'KOFÇAZ', 1480),
(959, '39', 'LÜLEBURGAZ', 1505),
(960, '39', 'MERKEZ', 1471),
(961, '39', 'PEHLİVANKÖY', 1572),
(962, '39', 'PINARHİSAR', 1577),
(963, '39', 'VİZE', 1714),
(964, '40', 'AKÇAKENT', 1869),
(965, '40', 'AKPINAR', 1754),
(966, '40', 'BOZTEPE', 1890),
(967, '40', 'ÇİÇEKDAĞI', 1254),
(968, '40', 'KAMAN', 1429),
(969, '40', 'MERKEZ', 1472),
(970, '40', 'MUCUR', 1529);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rates`
--

CREATE TABLE `exchange_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buying_rate` decimal(10,4) NOT NULL,
  `selling_rate` decimal(10,4) NOT NULL,
  `effective_rate` decimal(10,4) NOT NULL,
  `rate_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `currency_code`, `buying_rate`, `selling_rate`, `effective_rate`, `rate_date`, `created_at`, `updated_at`) VALUES
(1, 'USD', '35.2764', '35.3400', '35.3930', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(2, 'AUD', '22.0945', '22.2385', '22.3720', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(3, 'DKK', '4.9190', '4.9432', '4.9545', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(4, 'EUR', '36.7501', '36.8163', '36.8715', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(5, 'GBP', '44.2045', '44.4350', '44.5016', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(6, 'CHF', '38.9127', '39.1625', '39.2213', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(7, 'SEK', '3.1898', '3.2228', '3.2302', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(8, 'CAD', '24.6180', '24.7290', '24.8230', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(9, 'KWD', '113.8334', '115.3229', '117.0527', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(10, 'NOK', '3.1228', '3.1438', '3.1510', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(11, 'SAR', '9.3965', '9.4135', '9.4841', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(12, 'JPY', '22.3263', '22.4742', '22.5596', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(13, 'BGN', '18.6846', '18.9291', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(14, 'RON', '7.3462', '7.4423', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(15, 'RUB', '0.3284', '0.3327', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(16, 'IRR', '0.0079', '0.0080', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(17, 'CNY', '4.7880', '4.8506', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(18, 'PKR', '0.1259', '0.1276', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(19, 'QAR', '9.6223', '9.7482', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(20, 'KRW', '0.0242', '0.0245', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(21, 'AZN', '20.6345', '20.9045', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(22, 'AED', '9.5504', '9.6754', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26'),
(23, 'XDR', '46.0572', '0.0000', '0.0000', '2025-01-08', '2025-01-07 23:24:26', '2025-01-07 23:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqables`
--

CREATE TABLE `faqables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_id` bigint(20) UNSIGNED NOT NULL,
  `faqable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faqable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_galleries`
--

CREATE TABLE `image_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `addGoogle` tinyint(1) NOT NULL DEFAULT '1',
  `addComment` tinyint(1) NOT NULL DEFAULT '0',
  `deleteContent` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL DEFAULT '2025-01-08',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_gallery_translations`
--

CREATE TABLE `image_gallery_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_gallery_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `native` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `regional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `script` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang`, `name`, `native`, `rank`, `regional`, `script`, `active`, `created_at`, `updated_at`) VALUES
(1, 'tr', 'Turkish', 'Türkçe', NULL, 'tr_TR', 'Latn', 1, NULL, NULL),
(2, 'en', 'English', 'English', NULL, 'en_GB', 'Latn', 0, NULL, NULL),
(3, 'es', 'Spanish', 'español', NULL, 'es_ES', 'Latn', 0, NULL, NULL),
(4, 'de', 'German', 'Deutsch', NULL, 'de_DE', 'Latn', 0, NULL, NULL),
(5, 'nl', 'Dutch', 'Nederlands', NULL, 'nl_NL', 'Latn', 0, NULL, NULL),
(6, 'it', 'Italian', 'italiano', NULL, 'it_IT', 'Latn', 0, NULL, NULL),
(7, 'ru', 'Russian', 'русский', NULL, 'ru_RU', 'Cyrl', 0, NULL, NULL),
(8, 'fr', 'French', 'français', NULL, 'fr_FR', 'Latn', 0, NULL, NULL),
(9, 'sa', 'Arabic', 'العربية', NULL, 'ar_AE', 'Arab', 0, NULL, NULL),
(10, 'pt', 'Portuguese', 'português', NULL, 'pt_PT', 'Latn', 0, NULL, NULL),
(11, 'ro', 'Romanian', 'română', NULL, 'ro_RO', 'Latn', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_lines`
--

CREATE TABLE `language_lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language_lines`
--

INSERT INTO `language_lines` (`id`, `group`, `key`, `text`, `created_at`, `updated_at`) VALUES
(1, 'site', 'hakkimizda', '{\"en\": \"About Us\", \"tr\": \"Hakkımızda\"}', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 'site', 'anasayfa', '{\"en\": \"Home\", \"tr\": \"Anasayfa\"}', '2025-01-07 23:24:19', '2025-01-07 23:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_09_23_005916_create_cache_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_000004_create_site_table', 1),
(4, '2015_09_23_005916_create_site_settings', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_01_000001_create_product_system_tables', 1),
(7, '2024_05_25_113521_create_media_table', 1),
(8, '2024_05_26_094648_create_permission_tables', 1),
(9, '2024_05_27_200944_create_activity_log_table', 1),
(10, '2024_05_27_200945_add_event_column_to_activity_log_table', 1),
(11, '2024_05_27_200946_add_batch_uuid_column_to_activity_log_table', 1),
(12, '2024_05_27_201153_create_views_table', 1),
(13, '2024_05_30_121655_create_tag_tables', 1),
(14, '2024_06_25_085438_create_customers_table', 1),
(15, '2024_12_09_174729_create_analysis_table', 1),
(16, '2024_12_19_232325_create_image_galleries_table', 1),
(17, '2024_12_19_232405_create_image_gallery_translations_table', 1),
(18, '2024_12_24_153713_create_videos_table', 1),
(19, '2024_12_24_153714_create_video_translations_table', 1),
(20, '2025_01_08_011234_create_exchange_rates_table', 1),
(21, '2025_01_08_024513_create_offer_templates_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offer_templates`
--

CREATE TABLE `offer_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TRY',
  `description` text COLLATE utf8mb4_unicode_ci,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer_templates`
--

INSERT INTO `offer_templates` (`id`, `name`, `currency`, `description`, `terms`, `notes`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Şablon 1', 'TRY', '<h3>A&ccedil;ıklama</h3>', '<h3>Teklif Şartları</h3>', '<h3>İ&ccedil; Notlar</h3>\r\n\r\n<p>&nbsp;</p>', 0, '2025-01-08 00:15:31', '2025-01-08 00:15:31'),
(2, 'Şablon 2', 'TRY', '<h3>A&ccedil;ıklama</h3>', '<h3>Teklif Şartları</h3>', '<h3>İ&ccedil; Notlar</h3>', 0, '2025-01-08 00:18:56', '2025-01-08 00:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `offer_template_items`
--

CREATE TABLE `offer_template_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_template_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL DEFAULT '1',
  `amount` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(5,2) NOT NULL DEFAULT '20.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer_template_items`
--

INSERT INTO `offer_template_items` (`id`, `offer_template_id`, `item_name`, `unit`, `amount`, `discount`, `tax`, `created_at`, `updated_at`) VALUES
(1, 1, 'Web Tasarım', 1, '10000.00', '0.00', '20.00', '2025-01-08 00:15:31', '2025-01-08 00:15:31'),
(2, 2, 'Logo', 1, '500.00', '0.00', '20.00', '2025-01-08 00:18:56', '2025-01-08 00:18:56'),
(3, 2, 'Tasarım', 1, '4000.00', '0.00', '20.00', '2025-01-08 00:18:56', '2025-01-08 00:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `addGoogle` tinyint(1) NOT NULL DEFAULT '1',
  `addComment` tinyint(1) NOT NULL DEFAULT '0',
  `deleteContent` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL DEFAULT '2025-01-08',
  `publish_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'access-go', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 'view-dashboard', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(3, 'manage-users', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(4, 'manage-roles', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(5, 'manage-products', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(6, 'manage-categories', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(7, 'manage-brands', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(8, 'manage-attributes', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(9, 'manage-orders', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(10, 'manage-customers', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(11, 'manage-settings', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(12, 'manage-services', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(13, 'manage-pages', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(14, 'manage-teams', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(15, 'manage-blogs', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(16, 'manage-comments', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(17, 'manage-media', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(18, 'manage-payments', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(19, 'manage-reports', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(20, 'manage-notifications', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(21, 'manage-seo', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(22, 'manage-sitemap', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(23, 'manage-backup', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(24, 'manage-logs', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(25, 'manage-cache', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(26, 'manage-maintenance', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(27, 'manage-updates', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(28, 'manage-translations', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'simple',
  `price` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `purchase_note` text COLLATE utf8mb4_unicode_ci,
  `tax_status` enum('taxable','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'taxable',
  `tax_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `manage_stock` tinyint(1) NOT NULL DEFAULT '1',
  `weight` decimal(10,2) DEFAULT NULL,
  `dimension_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `external_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addGoogle` tinyint(1) NOT NULL DEFAULT '1',
  `addComment` tinyint(1) NOT NULL DEFAULT '0',
  `deleteContent` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `type`, `price`, `discount_price`, `stock`, `sku`, `featured`, `purchase_note`, `tax_status`, `tax_class_id`, `manage_stock`, `weight`, `dimension_unit`, `length`, `width`, `height`, `external_url`, `button_text`, `addGoogle`, `addComment`, `deleteContent`, `status`, `rank`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'simple', '54999.00', NULL, 42, 'BcPHkX6K', 0, NULL, 'taxable', NULL, 1, '0.17', 'mm', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 'published', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL),
(2, 1, 'variable', NULL, NULL, NULL, NULL, 1, NULL, 'taxable', NULL, 1, '0.30', 'cm', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 'published', NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'select',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rank` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `type`, `status`, `rank`, `created_at`, `updated_at`) VALUES
(1, 'color', 1, 1, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 'select', 1, 2, '2025-01-07 23:24:19', '2025-01-07 23:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_relations`
--

CREATE TABLE `product_attribute_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_translations`
--

CREATE TABLE `product_attribute_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_translations`
--

INSERT INTO `product_attribute_translations` (`id`, `product_attribute_id`, `locale`, `name`, `slug`) VALUES
(1, 1, 'tr', 'Renk', 'renk'),
(2, 1, 'en', 'Color', 'color'),
(3, 2, 'tr', 'Beden', 'beden'),
(4, 2, 'en', 'Size', 'size');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `product_attribute_id`, `color_code`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '#000000', 0, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 1, '#FFFFFF', 1, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(3, 1, '#FF0000', 2, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(4, 1, '#0000FF', 3, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(5, 1, '#00FF00', 4, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(6, 2, NULL, 0, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(7, 2, NULL, 1, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(8, 2, NULL, 2, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(9, 2, NULL, 3, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(10, 2, NULL, 4, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(11, 2, NULL, 5, '2025-01-07 23:24:19', '2025-01-07 23:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `addGoogle` tinyint(1) NOT NULL DEFAULT '1',
  `addComment` tinyint(1) NOT NULL DEFAULT '0',
  `deleteContent` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL DEFAULT '2025-01-08',
  `publish_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `_lft`, `_rgt`, `parent_id`, `addGoogle`, `addComment`, `deleteContent`, `status`, `rank`, `publish_date`, `publish_password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, NULL, 1, 0, 0, '1', NULL, '2025-01-08', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20', NULL),
(2, 2, 3, 1, 1, 0, 0, '1', NULL, '2025-01-08', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20', NULL),
(3, 4, 5, 1, 1, 0, 0, '1', NULL, '2025-01-08', NULL, '2025-01-07 23:24:20', '2025-01-07 23:24:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category_translations`
--

CREATE TABLE `product_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category_translations`
--

INSERT INTO `product_category_translations` (`id`, `product_category_id`, `locale`, `name`, `slug`, `short`, `desc`, `seoTitle`, `seoDesc`, `seoKey`) VALUES
(1, 1, 'tr', 'Elektronik', 'elektronik', NULL, 'Elektronik ürünler kategorisi', NULL, NULL, NULL),
(2, 1, 'en', 'Electronics', 'electronics', NULL, 'Electronics products category', NULL, NULL, NULL),
(3, 2, 'tr', 'Telefonlar', 'telefonlar', NULL, NULL, NULL, NULL, NULL),
(4, 2, 'en', 'Phones', 'phones', NULL, NULL, NULL, NULL, NULL),
(5, 3, 'tr', 'Bilgisayarlar', 'bilgisayarlar', NULL, NULL, NULL, NULL, NULL),
(6, 3, 'en', 'Computers', 'computers', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short` text COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_url_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_note` text COLLATE utf8mb4_unicode_ci,
  `campaign_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` text COLLATE utf8mb4_unicode_ci,
  `seoDesc` text COLLATE utf8mb4_unicode_ci,
  `seoTitle` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_translations`
--

INSERT INTO `product_translations` (`id`, `product_id`, `locale`, `name`, `slug`, `short`, `desc`, `button_text`, `external_url_text`, `purchase_note`, `campaign_text`, `cargo_text`, `warranty_text`, `pay_text`, `return_text`, `exchange_text`, `refund_text`, `cancel_text`, `contact_text`, `seoKey`, `seoDesc`, `seoTitle`, `created_at`, `updated_at`) VALUES
(1, 1, 'tr', 'iPhone 14 Pro', 'iphone-14-pro', 'Bu bir örnek iPhone 14 Pro kısa açıklamasıdır.', 'Bu bir örnek iPhone 14 Pro detaylı açıklamasıdır.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'iphone 14 pro', 'En uygun fiyatlarla iPhone 14 Pro satın alın', 'iPhone 14 Pro', NULL, NULL),
(2, 2, 'tr', 'Nike Spor Ayakkabı', 'nike-spor-ayakkabi', 'Bu bir örnek Nike Spor Ayakkabı kısa açıklamasıdır.', 'Bu bir örnek Nike Spor Ayakkabı detaylı açıklamasıdır.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nike spor ayakkabı', 'En uygun fiyatlarla Nike Spor Ayakkabı satın alın', 'Nike Spor Ayakkabı', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `variation_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `sku`, `price`, `discount_price`, `stock`, `status`, `variation_key`, `created_at`, `updated_at`) VALUES
(1, 2, '79HMRCAx', '920.00', NULL, 46, 1, '1-6', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 2, '41N94UuV', '457.00', NULL, 38, 1, '1-7', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(3, 2, 'RaO9kexe', '889.00', NULL, 43, 1, '1-8', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(4, 2, 'PPJaITIG', '461.00', NULL, 31, 1, '1-9', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(5, 2, '2Cb0SHJB', '873.00', NULL, 27, 1, '1-10', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(6, 2, 'BtEvvaPb', '421.00', NULL, 33, 1, '1-11', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(7, 2, 'E7prcpo2', '555.00', NULL, 22, 1, '2-6', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(8, 2, 'roztohOl', '341.00', NULL, 27, 1, '2-7', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(9, 2, 'thFaCuOv', '558.00', NULL, 40, 1, '2-8', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(10, 2, 'Ygrkf6Xd', '548.00', NULL, 37, 1, '2-9', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(11, 2, 'HTdjRxUC', '922.00', NULL, 40, 1, '2-10', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(12, 2, 'LhC6TBpC', '319.00', NULL, 16, 1, '2-11', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(13, 2, '0rEX3Bam', '359.00', NULL, 24, 1, '3-6', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(14, 2, 'G5aztsHo', '757.00', NULL, 43, 1, '3-7', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(15, 2, '1ARIrWAw', '727.00', NULL, 30, 1, '3-8', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(16, 2, 'K2R5KnWA', '942.00', NULL, 25, 1, '3-9', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(17, 2, 'nJfzKBAa', '437.00', NULL, 49, 1, '3-10', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(18, 2, 's2g1V0gH', '445.00', NULL, 27, 1, '3-11', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(19, 2, 'ROjOm3du', '603.00', NULL, 45, 1, '4-6', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(20, 2, 'U8KfySz9', '489.00', NULL, 47, 1, '4-7', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(21, 2, 'k00ssVf5', '616.00', NULL, 14, 1, '4-8', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(22, 2, '43c0rtgm', '850.00', NULL, 47, 1, '4-9', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(23, 2, 'SyQQzV2G', '387.00', NULL, 23, 1, '4-10', '2025-01-07 23:24:19', '2025-01-07 23:24:20'),
(24, 2, '1szwH9U1', '347.00', NULL, 11, 1, '4-11', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(25, 2, 'FjkWOqE0', '583.00', NULL, 48, 1, '5-6', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(26, 2, 'dl7N68iI', '389.00', NULL, 12, 1, '5-7', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(27, 2, 'DNnkGEGP', '621.00', NULL, 40, 1, '5-8', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(28, 2, 'DRSuvilm', '782.00', NULL, 5, 1, '5-9', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(29, 2, 'vEvxC8mL', '811.00', NULL, 20, 1, '5-10', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(30, 2, 'p2OeFCaR', '955.00', NULL, 34, 1, '5-11', '2025-01-07 23:24:20', '2025-01-07 23:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_variation_attributes`
--

CREATE TABLE `product_variation_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variation_attributes`
--

INSERT INTO `product_variation_attributes` (`id`, `variation_id`, `attribute_id`, `value_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 6, NULL, NULL),
(3, 2, 1, 1, NULL, NULL),
(4, 2, 2, 7, NULL, NULL),
(5, 3, 1, 1, NULL, NULL),
(6, 3, 2, 8, NULL, NULL),
(7, 4, 1, 1, NULL, NULL),
(8, 4, 2, 9, NULL, NULL),
(9, 5, 1, 1, NULL, NULL),
(10, 5, 2, 10, NULL, NULL),
(11, 6, 1, 1, NULL, NULL),
(12, 6, 2, 11, NULL, NULL),
(13, 7, 1, 2, NULL, NULL),
(14, 7, 2, 6, NULL, NULL),
(15, 8, 1, 2, NULL, NULL),
(16, 8, 2, 7, NULL, NULL),
(17, 9, 1, 2, NULL, NULL),
(18, 9, 2, 8, NULL, NULL),
(19, 10, 1, 2, NULL, NULL),
(20, 10, 2, 9, NULL, NULL),
(21, 11, 1, 2, NULL, NULL),
(22, 11, 2, 10, NULL, NULL),
(23, 12, 1, 2, NULL, NULL),
(24, 12, 2, 11, NULL, NULL),
(25, 13, 1, 3, NULL, NULL),
(26, 13, 2, 6, NULL, NULL),
(27, 14, 1, 3, NULL, NULL),
(28, 14, 2, 7, NULL, NULL),
(29, 15, 1, 3, NULL, NULL),
(30, 15, 2, 8, NULL, NULL),
(31, 16, 1, 3, NULL, NULL),
(32, 16, 2, 9, NULL, NULL),
(33, 17, 1, 3, NULL, NULL),
(34, 17, 2, 10, NULL, NULL),
(35, 18, 1, 3, NULL, NULL),
(36, 18, 2, 11, NULL, NULL),
(37, 19, 1, 4, NULL, NULL),
(38, 19, 2, 6, NULL, NULL),
(39, 20, 1, 4, NULL, NULL),
(40, 20, 2, 7, NULL, NULL),
(41, 21, 1, 4, NULL, NULL),
(42, 21, 2, 8, NULL, NULL),
(43, 22, 1, 4, NULL, NULL),
(44, 22, 2, 9, NULL, NULL),
(45, 23, 1, 4, NULL, NULL),
(46, 23, 2, 10, NULL, NULL),
(47, 24, 1, 4, NULL, NULL),
(48, 24, 2, 11, NULL, NULL),
(49, 25, 1, 5, NULL, NULL),
(50, 25, 2, 6, NULL, NULL),
(51, 26, 1, 5, NULL, NULL),
(52, 26, 2, 7, NULL, NULL),
(53, 27, 1, 5, NULL, NULL),
(54, 27, 2, 8, NULL, NULL),
(55, 28, 1, 5, NULL, NULL),
(56, 28, 2, 9, NULL, NULL),
(57, 29, 1, 5, NULL, NULL),
(58, 29, 2, 10, NULL, NULL),
(59, 30, 1, 5, NULL, NULL),
(60, 30, 2, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_attr_val_trans`
--

CREATE TABLE `p_attr_val_trans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_attribute_value_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `p_attr_val_trans`
--

INSERT INTO `p_attr_val_trans` (`id`, `product_attribute_value_id`, `locale`, `value`, `slug`) VALUES
(1, 1, 'tr', 'Siyah', 'siyah'),
(2, 1, 'en', 'Black', 'black'),
(3, 2, 'tr', 'Beyaz', 'beyaz'),
(4, 2, 'en', 'White', 'white'),
(5, 3, 'tr', 'Kırmızı', 'kirmizi'),
(6, 3, 'en', 'Red', 'red'),
(7, 4, 'tr', 'Mavi', 'mavi'),
(8, 4, 'en', 'Blue', 'blue'),
(9, 5, 'tr', 'Yeşil', 'yesil'),
(10, 5, 'en', 'Green', 'green'),
(11, 6, 'tr', 'XS', 'xs'),
(12, 6, 'en', 'XS', 'xs'),
(13, 7, 'tr', 'S', 's'),
(14, 7, 'en', 'S', 's'),
(15, 8, 'tr', 'M', 'm'),
(16, 8, 'en', 'M', 'm'),
(17, 9, 'tr', 'L', 'l'),
(18, 9, 'en', 'L', 'l'),
(19, 10, 'tr', 'XL', 'xl'),
(20, 10, 'en', 'XL', 'xl'),
(21, 11, 'tr', 'XXL', 'xxl'),
(22, 11, 'en', 'XXL', 'xxl');

-- --------------------------------------------------------

--
-- Table structure for table `p_var_trans`
--

CREATE TABLE `p_var_trans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redirects`
--

CREATE TABLE `redirects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_code` int(11) NOT NULL DEFAULT '301',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 'editor', 'web', '2025-01-07 23:24:19', '2025-01-07 23:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(1, 2),
(2, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `addGoogle` tinyint(1) NOT NULL DEFAULT '1',
  `addComment` tinyint(1) NOT NULL DEFAULT '0',
  `deleteContent` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL DEFAULT '2025-01-08',
  `publish_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isImage` tinyint(1) NOT NULL DEFAULT '0',
  `isType` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Web Sitesi', 'web-sitesi', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(2, 'Sosyal Medya', 'sosyal-medya', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(3, 'Logo', 'logo', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(4, 'Baskı', 'baski', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(5, 'Google Maps', 'google-maps', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(6, 'Google ADS', 'google-ads', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(7, 'Meta ADS', 'meta-ads', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(8, 'Uzaktan Yardım', 'uzaktan-yardim', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(9, 'Satış', 'satis', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(10, 'Kurumsal Mail', 'kurumsal-mail', 'job', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(11, 'Yeni', 'yeni', 'product', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(12, 'İndirimli', 'indirimli', 'product', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(13, 'Öne Çıkan', 'one-cikan', 'product', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(14, 'Stokta Yok', 'stokta-yok', 'product', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(15, 'VIP', 'vip', 'customer', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(16, 'Aktif', 'aktif', 'customer', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(17, 'Potansiyel', 'potansiyel', 'customer', '2025-01-07 23:24:20', '2025-01-07 23:24:20'),
(18, 'Eski Müşteri', 'eski-musteri', 'customer', '2025-01-07 23:24:20', '2025-01-07 23:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `tax_classes`
--

CREATE TABLE `tax_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(5,2) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_classes`
--

INSERT INTO `tax_classes` (`id`, `name`, `slug`, `rate`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'KDV %1', 'kdv-1', '1.00', 0, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 'KDV %10', 'kdv-10', '10.00', 0, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(3, 'KDV %20', 'kdv-20', '20.00', 1, '2025-01-07 23:24:19', '2025-01-07 23:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL DEFAULT '2025-01-08',
  `publish_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_translations`
--

CREATE TABLE `team_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jobTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'GO Dijital', 'olcayy@gmail.com', '2025-01-07 23:24:19', '$2y$12$qPTpcgTLcZoQOyYL9F1fme2WAn8Lc0r3AUYqdqyYm6nRoqHFJHCnq', NULL, NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19'),
(2, 'Editor', 'editor@editor.com', '2025-01-07 23:24:19', '$2y$12$9vWKZ9//OeT.q6oGbMAJU.WI8HrKsoVvO6nmTEOHUABltYgkr9/86', NULL, NULL, '2025-01-07 23:24:19', '2025-01-07 23:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `videoCode` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `rank` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL DEFAULT '2025-01-08',
  `publish_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_translations`
--

CREATE TABLE `video_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short` longtext COLLATE utf8mb4_unicode_ci,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `viewable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewable_id` bigint(20) UNSIGNED NOT NULL,
  `visitor` text COLLATE utf8mb4_unicode_ci,
  `collection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_translations_blog_id_locale_unique` (`blog_id`,`locale`),
  ADD KEY `blog_translations_locale_index` (`locale`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`product_id`,`product_category_id`),
  ADD KEY `category_product_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_locale_unique` (`category_id`,`locale`),
  ADD KEY `category_translations_locale_index` (`locale`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_plate_no_unique` (`plate_no`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_offers`
--
ALTER TABLE `customer_offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_offers_offer_no_unique` (`offer_no`),
  ADD KEY `customer_offers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customer_offer_items`
--
ALTER TABLE `customer_offer_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_offer_items_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_payments_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `customer_works`
--
ALTER TABLE `customer_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_works_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_works_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_city_id_foreign` (`city_id`);

--
-- Indexes for table `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exchange_rates_currency_code_rate_date_unique` (`currency_code`,`rate_date`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faq_category_id_foreign` (`category_id`);

--
-- Indexes for table `faqables`
--
ALTER TABLE `faqables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqables_faq_id_foreign` (`faq_id`),
  ADD KEY `faqables_faqable_type_faqable_id_index` (`faqable_type`,`faqable_id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_translations_faq_id_locale_unique` (`faq_id`,`locale`),
  ADD KEY `faq_translations_locale_index` (`locale`);

--
-- Indexes for table `image_galleries`
--
ALTER TABLE `image_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_galleries_category_id_foreign` (`category_id`);

--
-- Indexes for table `image_gallery_translations`
--
ALTER TABLE `image_gallery_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image_gallery_translations_image_gallery_id_locale_unique` (`image_gallery_id`,`locale`),
  ADD KEY `image_gallery_translations_locale_index` (`locale`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_lines`
--
ALTER TABLE `language_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language_lines_group_index` (`group`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `offer_templates`
--
ALTER TABLE `offer_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_template_items`
--
ALTER TABLE `offer_template_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_template_items_offer_template_id_foreign` (`offer_template_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_category_id_foreign` (`category_id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`),
  ADD KEY `page_translations_locale_index` (`locale`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_tax_class_id_foreign` (`tax_class_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute_relations`
--
ALTER TABLE `product_attribute_relations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_attribute_relations_product_id_attribute_id_unique` (`product_id`,`attribute_id`),
  ADD KEY `product_attribute_relations_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_attribute_relations_value_id_foreign` (`value_id`);

--
-- Indexes for table `product_attribute_translations`
--
ALTER TABLE `product_attribute_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pat_attribute_locale_unique` (`product_attribute_id`,`locale`),
  ADD UNIQUE KEY `pat_locale_slug_unique` (`locale`,`slug`),
  ADD KEY `product_attribute_translations_locale_index` (`locale`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_values_product_attribute_id_foreign` (`product_attribute_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- Indexes for table `product_category_translations`
--
ALTER TABLE `product_category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_category_translations_product_category_id_locale_unique` (`product_category_id`,`locale`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_translations_product_id_locale_unique` (`product_id`,`locale`),
  ADD UNIQUE KEY `product_translations_locale_slug_unique` (`locale`,`slug`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variations_sku_unique` (`sku`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variation_attributes_variation_id_attribute_id_unique` (`variation_id`,`attribute_id`),
  ADD KEY `product_variation_attributes_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_variation_attributes_value_id_foreign` (`value_id`);

--
-- Indexes for table `p_attr_val_trans`
--
ALTER TABLE `p_attr_val_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_attr_val_trans_product_attribute_value_id_foreign` (`product_attribute_value_id`);

--
-- Indexes for table `p_var_trans`
--
ALTER TABLE `p_var_trans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `p_var_trans_product_variation_id_locale_unique` (`product_variation_id`,`locale`);

--
-- Indexes for table `redirects`
--
ALTER TABLE `redirects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `redirects_from_url_unique` (`from_url`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_id_foreign` (`category_id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`),
  ADD KEY `service_translations_locale_index` (`locale`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_category_id_foreign` (`category_id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD UNIQUE KEY `taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  ADD KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_classes`
--
ALTER TABLE `tax_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_category_id_foreign` (`category_id`);

--
-- Indexes for table `team_translations`
--
ALTER TABLE `team_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_translations_team_id_locale_unique` (`team_id`,`locale`),
  ADD KEY `team_translations_locale_index` (`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_category_id_foreign` (`category_id`);

--
-- Indexes for table `video_translations`
--
ALTER TABLE `video_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_translations_video_id_locale_unique` (`video_id`,`locale`),
  ADD KEY `video_translations_locale_index` (`locale`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_viewable_type_viewable_id_index` (`viewable_type`,`viewable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_offers`
--
ALTER TABLE `customer_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_offer_items`
--
ALTER TABLE `customer_offer_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_works`
--
ALTER TABLE `customer_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=971;

--
-- AUTO_INCREMENT for table `exchange_rates`
--
ALTER TABLE `exchange_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqables`
--
ALTER TABLE `faqables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_galleries`
--
ALTER TABLE `image_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_gallery_translations`
--
ALTER TABLE `image_gallery_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `language_lines`
--
ALTER TABLE `language_lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `offer_templates`
--
ALTER TABLE `offer_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offer_template_items`
--
ALTER TABLE `offer_template_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attribute_relations`
--
ALTER TABLE `product_attribute_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_attribute_translations`
--
ALTER TABLE `product_attribute_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_category_translations`
--
ALTER TABLE `product_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `p_attr_val_trans`
--
ALTER TABLE `p_attr_val_trans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `p_var_trans`
--
ALTER TABLE `p_var_trans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redirects`
--
ALTER TABLE `redirects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tax_classes`
--
ALTER TABLE `tax_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_translations`
--
ALTER TABLE `team_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_translations`
--
ALTER TABLE `video_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD CONSTRAINT `blog_translations_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_offers`
--
ALTER TABLE `customer_offers`
  ADD CONSTRAINT `customer_offers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_offer_items`
--
ALTER TABLE `customer_offer_items`
  ADD CONSTRAINT `customer_offer_items_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `customer_offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD CONSTRAINT `customer_payments_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `customer_offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_works`
--
ALTER TABLE `customer_works`
  ADD CONSTRAINT `customer_works_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_works_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `customer_offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`plate_no`) ON DELETE CASCADE;

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faqables`
--
ALTER TABLE `faqables`
  ADD CONSTRAINT `faqables_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faq` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD CONSTRAINT `faq_translations_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faq` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image_galleries`
--
ALTER TABLE `image_galleries`
  ADD CONSTRAINT `image_galleries_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image_gallery_translations`
--
ALTER TABLE `image_gallery_translations`
  ADD CONSTRAINT `image_gallery_translations_image_gallery_id_foreign` FOREIGN KEY (`image_gallery_id`) REFERENCES `image_galleries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offer_template_items`
--
ALTER TABLE `offer_template_items`
  ADD CONSTRAINT `offer_template_items_offer_template_id_foreign` FOREIGN KEY (`offer_template_id`) REFERENCES `offer_templates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_tax_class_id_foreign` FOREIGN KEY (`tax_class_id`) REFERENCES `tax_classes` (`id`);

--
-- Constraints for table `product_attribute_relations`
--
ALTER TABLE `product_attribute_relations`
  ADD CONSTRAINT `product_attribute_relations_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attribute_relations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attribute_relations_value_id_foreign` FOREIGN KEY (`value_id`) REFERENCES `product_attribute_values` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attribute_translations`
--
ALTER TABLE `product_attribute_translations`
  ADD CONSTRAINT `product_attribute_translations_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `product_attribute_values_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category_translations`
--
ALTER TABLE `product_category_translations`
  ADD CONSTRAINT `product_category_translations_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD CONSTRAINT `product_translations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variation_attributes`
--
ALTER TABLE `product_variation_attributes`
  ADD CONSTRAINT `product_variation_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`),
  ADD CONSTRAINT `product_variation_attributes_value_id_foreign` FOREIGN KEY (`value_id`) REFERENCES `product_attribute_values` (`id`),
  ADD CONSTRAINT `product_variation_attributes_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `p_attr_val_trans`
--
ALTER TABLE `p_attr_val_trans`
  ADD CONSTRAINT `p_attr_val_trans_product_attribute_value_id_foreign` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_values` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `p_var_trans`
--
ALTER TABLE `p_var_trans`
  ADD CONSTRAINT `p_var_trans_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD CONSTRAINT `service_translations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_translations`
--
ALTER TABLE `team_translations`
  ADD CONSTRAINT `team_translations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_translations`
--
ALTER TABLE `video_translations`
  ADD CONSTRAINT `video_translations_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

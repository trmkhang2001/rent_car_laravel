/*
 Navicat Premium Data Transfer

 Source Server         : ConnectDBXampp
 Source Server Type    : MySQL
 Source Server Version : 100432
 Source Host           : localhost:3306
 Source Schema         : shopmaytinh

 Target Server Type    : MySQL
 Target Server Version : 100432
 File Encoding         : 65001

 Date: 14/03/2024 14:54:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `vitri` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (6, '/images/2024-03-12-08-54-31-banner-duyen-car-3.jpg', 0, 0, '2024-03-12 08:54:31', '2024-03-12 14:31:28');
INSERT INTO `banners` VALUES (7, '/images/2024-03-12-14-06-25-hinh-anh-gia-xe-VinFast-Lux-A2.0-ban-tieu-chuan-mau-do-mystique-red.png', 1, 1, '2024-03-12 14:06:25', '2024-03-12 14:06:25');
INSERT INTO `banners` VALUES (8, '/images/2024-03-12-14-09-52-banner.jpg', 0, 0, '2024-03-12 14:09:52', '2024-03-12 14:10:31');
INSERT INTO `banners` VALUES (9, '/images/2024-03-12-14-10-39-tải xuống.jpg', 0, 0, '2024-03-12 14:10:39', '2024-03-12 14:31:24');
INSERT INTO `banners` VALUES (10, '/images/2024-03-12-14-31-35-1603338300_honda civic.jpg', 1, 0, '2024-03-12 14:31:35', '2024-03-12 14:31:35');
INSERT INTO `banners` VALUES (11, '/images/2024-03-12-14-31-41-1603338000_DSC_7294_800x450.jpg', 1, 0, '2024-03-12 14:31:41', '2024-03-12 14:31:41');
INSERT INTO `banners` VALUES (12, '/images/2024-03-12-14-31-49-1603337160_image.imgs.full.high.jpg', 1, 0, '2024-03-12 14:31:49', '2024-03-12 14:31:49');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (9, 'Oto VinFast', '2024-03-12 07:03:45', '2024-03-12 07:03:57');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for guarantees
-- ----------------------------
DROP TABLE IF EXISTS `guarantees`;
CREATE TABLE `guarantees`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `time` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of guarantees
-- ----------------------------
INSERT INTO `guarantees` VALUES (1, 12, 'Bảo hành chính hảng 12, không phải lỗi do phía khách hàng', '2023-12-21 13:07:29', '2023-12-21 13:07:33');

-- ----------------------------
-- Table structure for images_products
-- ----------------------------
DROP TABLE IF EXISTS `images_products`;
CREATE TABLE `images_products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for info_ships
-- ----------------------------
DROP TABLE IF EXISTS `info_ships`;
CREATE TABLE `info_ships`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of info_ships
-- ----------------------------
INSERT INTO `info_ships` VALUES (12, 21, 'Trần Minh Khang', '0866411902', 'Xã Cẩm Sơn', 'Huyện Cai Lậy', 'Tỉnh Tiền Giang', '2024-03-12 13:38:29', '2024-03-12 13:38:29', 'trmkhang2001@gmail.com', '1102 Huỳnh Tấn Phát');
INSERT INTO `info_ships` VALUES (14, 22, 'Tran Van An', '12313123123', 'Xã Quảng Thịnh', 'Huyện Hải Hà', 'Tỉnh Quảng Ninh', '2024-03-12 13:47:00', '2024-03-12 13:47:00', 'admin@mail.com', '1102 Huỳnh Tấn Phát');
INSERT INTO `info_ships` VALUES (15, 22, 'Vui Cùng Noel', '12313123123', 'Xã Sơn Tình', 'Huyện Cẩm Khê', 'Tỉnh Phú Thọ', '2024-03-12 13:47:31', '2024-03-12 13:47:31', 'tranquocbao@gmail.com', '1102 Huỳnh Tấn Phát');
INSERT INTO `info_ships` VALUES (16, 1, 'Trần Minh Khang', '0866411902', 'Phường Trưng Nhị', 'Thành phố Phúc Yên', 'Tỉnh Vĩnh Phúc', '2024-03-13 10:23:30', '2024-03-13 10:23:30', 'trmkhang2001@gmail.com', '1102 Huỳnh Tấn Phát');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2023_12_16_093154_edit_users_table', 1);
INSERT INTO `migrations` VALUES (6, '2023_12_16_114945_create_categories_table', 1);
INSERT INTO `migrations` VALUES (7, '2023_12_16_184800_create_promotions_table', 1);
INSERT INTO `migrations` VALUES (8, '2023_12_18_152421_create_guarantees_table', 2);
INSERT INTO `migrations` VALUES (10, '2023_12_18_153517_create_import_coupons_table', 4);
INSERT INTO `migrations` VALUES (11, '2023_12_18_152708_create_suppliers_table', 5);
INSERT INTO `migrations` VALUES (12, '2023_12_18_154010_create_detail_import_coupons_table', 6);
INSERT INTO `migrations` VALUES (13, '2023_12_20_090611_create_images_products_table', 7);
INSERT INTO `migrations` VALUES (19, '2023_12_20_090930_create_products_table', 8);
INSERT INTO `migrations` VALUES (22, '2023_12_22_224258_add_column_to_users', 9);
INSERT INTO `migrations` VALUES (25, '2023_12_24_160425_create_parameter_products_table', 11);
INSERT INTO `migrations` VALUES (27, '2023_12_24_220007_remove_id_category_from_products', 12);
INSERT INTO `migrations` VALUES (34, '2023_12_25_150518_create_orders_table', 13);
INSERT INTO `migrations` VALUES (35, '2023_12_25_150531_create_order_items_table', 13);
INSERT INTO `migrations` VALUES (36, '2023_12_25_150551_create_transactions_table', 13);
INSERT INTO `migrations` VALUES (37, '2023_12_26_155539_remove_column_from_orders', 14);
INSERT INTO `migrations` VALUES (38, '2023_12_26_155849_add_column_from_orders', 15);
INSERT INTO `migrations` VALUES (39, '2023_12_26_181401_modify_column_from_orders', 16);
INSERT INTO `migrations` VALUES (40, '2023_12_26_185434_modify_column_from_orders', 17);
INSERT INTO `migrations` VALUES (41, '2023_12_26_190022_remove_column_from_orders', 18);
INSERT INTO `migrations` VALUES (42, '2023_12_26_190504_modify_column_from_orders', 19);
INSERT INTO `migrations` VALUES (45, '2023_12_26_190644_modify_column_from_orders', 22);
INSERT INTO `migrations` VALUES (46, '2023_12_26_190722_add_column_from_orders', 23);
INSERT INTO `migrations` VALUES (47, '2023_12_26_191146_remove_column_from_orders', 24);
INSERT INTO `migrations` VALUES (48, '2023_12_26_191220_add_column_from_order_items', 25);
INSERT INTO `migrations` VALUES (49, '2023_12_29_071208_create_roles_table', 26);
INSERT INTO `migrations` VALUES (50, '2023_12_29_071505_modify_column_from_users', 27);
INSERT INTO `migrations` VALUES (51, '2023_12_29_071928_add_column_from_users', 28);
INSERT INTO `migrations` VALUES (52, '2023_12_29_125028_remove_column_from_users', 29);
INSERT INTO `migrations` VALUES (53, '2023_12_29_125047_remove_column_from_suppliers', 29);
INSERT INTO `migrations` VALUES (54, '2023_12_29_125207_add_column_from_suppliers', 30);
INSERT INTO `migrations` VALUES (55, '2024_01_02_080529_remove_column_from_images_product', 31);
INSERT INTO `migrations` VALUES (56, '2024_01_02_080601_add_column_from_images_product', 32);
INSERT INTO `migrations` VALUES (57, '2024_01_02_080718_remove_column_from_images_products', 33);
INSERT INTO `migrations` VALUES (58, '2024_01_03_063345_create_banners_table', 34);
INSERT INTO `migrations` VALUES (59, '2024_01_20_084907_create_tbl_address_ship_table', 35);
INSERT INTO `migrations` VALUES (60, '2024_01_20_090347_create_info_ships_table', 36);
INSERT INTO `migrations` VALUES (61, '2024_01_21_100413_add_column_orders', 37);
INSERT INTO `migrations` VALUES (62, '2024_01_21_101630_create_transactions_table', 38);
INSERT INTO `migrations` VALUES (63, '2024_03_13_101941_create_review_table', 39);

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_items_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `order_items_order_id_foreign`(`order_id`) USING BTREE,
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_items
-- ----------------------------
INSERT INTO `order_items` VALUES (36, 28, 34, 1, '2024-03-12 13:38:44', '2024-03-12 13:38:44', 3000000);
INSERT INTO `order_items` VALUES (37, 28, 36, 1, '2024-03-12 13:41:39', '2024-03-12 13:41:39', 3000000);
INSERT INTO `order_items` VALUES (38, 27, 37, 1, '2024-03-12 13:43:20', '2024-03-12 13:43:20', 2000000);
INSERT INTO `order_items` VALUES (39, 28, 38, 1, '2024-03-12 13:49:06', '2024-03-12 13:49:06', 3000000);
INSERT INTO `order_items` VALUES (40, 28, 39, 1, '2024-03-12 13:59:12', '2024-03-12 13:59:12', 3000000);
INSERT INTO `order_items` VALUES (41, 28, 40, 1, '2024-03-12 14:02:43', '2024-03-12 14:02:43', 3000000);
INSERT INTO `order_items` VALUES (42, 32, 41, 1, '2024-03-13 10:29:26', '2024-03-13 10:29:26', 123456);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `delivered_date` date NULL DEFAULT NULL,
  `canceled_date` date NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` double NOT NULL,
  `isPay` tinyint(1) NOT NULL,
  `setDate` date NULL DEFAULT NULL,
  `dropDate` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `orders_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (34, 21, 'Trần Minh Khang', '0866411902', 'trmkhang2001@gmail.com', 'Xã Cẩm Sơn', '1102 Huỳnh Tấn Phát', 'Huyện Cai Lậy', 'Tỉnh Tiền Giang', 3, NULL, NULL, '2024-03-12 13:38:44', '2024-03-12 13:43:39', 3150000, 0, '2024-03-20', '2024-03-28');
INSERT INTO `orders` VALUES (35, 21, 'Trần Minh Khang', '0866411902', 'trmkhang2001@gmail.com', 'Xã Cẩm Sơn', '1102 Huỳnh Tấn Phát', 'Huyện Cai Lậy', 'Tỉnh Tiền Giang', 1, NULL, NULL, '2024-03-12 13:39:34', '2024-03-12 13:39:34', 150000, 0, '2024-03-20', '2024-03-28');
INSERT INTO `orders` VALUES (36, 21, 'Trần Minh Khang', '0866411902', 'trmkhang2001@gmail.com', 'Xã Cẩm Sơn', '1102 Huỳnh Tấn Phát', 'Huyện Cai Lậy', 'Tỉnh Tiền Giang', 0, NULL, NULL, '2024-03-12 13:41:39', '2024-03-12 13:43:25', 3150000, 0, '2024-03-14', '2024-03-27');
INSERT INTO `orders` VALUES (37, 21, 'Trần Minh Khang', '0866411902', 'trmkhang2001@gmail.com', 'Xã Cẩm Sơn', '1102 Huỳnh Tấn Phát', 'Huyện Cai Lậy', 'Tỉnh Tiền Giang', 0, NULL, NULL, '2024-03-12 13:43:20', '2024-03-12 13:43:26', 2150000, 0, '2024-03-12', '2024-03-27');
INSERT INTO `orders` VALUES (38, 22, 'Tran Van An', '12313123123', 'admin@mail.com', 'Xã Quảng Thịnh', '1102 Huỳnh Tấn Phát', 'Huyện Hải Hà', 'Tỉnh Quảng Ninh', 4, NULL, NULL, '2024-03-12 13:49:06', '2024-03-12 13:49:18', 3150000, 0, '2024-03-20', '2024-04-05');
INSERT INTO `orders` VALUES (39, 22, 'Tran Van An', '12313123123', 'admin@mail.com', 'Xã Quảng Thịnh', '1102 Huỳnh Tấn Phát', 'Huyện Hải Hà', 'Tỉnh Quảng Ninh', 1, NULL, NULL, '2024-03-12 13:59:12', '2024-03-12 13:59:12', 3150000, 0, '2024-03-14', '2024-03-29');
INSERT INTO `orders` VALUES (40, 22, 'Tran Van An', '12313123123', 'admin@mail.com', 'Xã Quảng Thịnh', '1102 Huỳnh Tấn Phát', 'Huyện Hải Hà', 'Tỉnh Quảng Ninh', 1, NULL, NULL, '2024-03-12 14:02:43', '2024-03-12 14:02:43', 3150000, 0, '2024-03-13', '2024-03-16');
INSERT INTO `orders` VALUES (41, 1, 'Trần Minh Khang', '0866411902', 'trmkhang2001@gmail.com', 'Phường Trưng Nhị', '1102 Huỳnh Tấn Phát', 'Thành phố Phúc Yên', 'Tỉnh Vĩnh Phúc', 1, NULL, NULL, '2024-03-13 10:29:26', '2024-03-13 10:29:26', 1481472, 0, '2024-03-14', '2024-03-26');

-- ----------------------------
-- Table structure for parameter_products
-- ----------------------------
DROP TABLE IF EXISTS `parameter_products`;
CREATE TABLE `parameter_products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `main` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cpu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `vga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `hhd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ssd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `psu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `case` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `parameter_products_id_product_unique`(`id_product`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `id_bh` int NULL DEFAULT NULL,
  `quantity` int NOT NULL,
  `status` int NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `promotion_id` int NULL DEFAULT NULL,
  `id_supploer` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (27, 'VF_LUXA', '/images/2024-03-12-07-08-06-hinh-anh-gia-xe-VinFast-Lux-A2.0-ban-tieu-chuan-mau-do-mystique-red.png', 'VinFast LuxA 2.0', 'Description', 2000000, NULL, -1, 1, 9, NULL, NULL, '2024-03-12 07:08:06', '2024-03-12 13:44:16');
INSERT INTO `products` VALUES (28, 'VF9', '/images/2024-03-12-08-41-17-VF9thumjpg-1679907708.jpg', 'VinFast VF9', 'VinFast VF9', 3000000, NULL, -1, 0, 9, NULL, NULL, '2024-03-12 08:41:17', '2024-03-12 14:02:43');
INSERT INTO `products` VALUES (29, 'Mer', '/images/2024-03-12-14-23-27-banner.jpg', 'LMer', 'asdadada', 1500000, NULL, 1, 1, 9, NULL, NULL, '2024-03-12 14:23:27', '2024-03-12 14:23:27');
INSERT INTO `products` VALUES (32, 'VICC', '/images/2024-03-13-10-15-13-1603338300_honda civic.png', '2020 Honda Civic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent aliquet justo accumsan varius efficitur. Sed sit amet massa quam. Aenean dictum urna nulla, nec iaculis ligula ullamcorper eleifend. Nulla imperdiet semper leo. Aliquam elit lectus, cursus sit amet felis sed, sollicitudin sollicitudin dui. Ut placerat consectetur', 123456, NULL, 1, 0, 9, NULL, NULL, '2024-03-13 10:15:13', '2024-03-13 10:29:26');

-- ----------------------------
-- Table structure for promotions
-- ----------------------------
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of promotions
-- ----------------------------
INSERT INTO `promotions` VALUES (1, 'Tết Đến Rồi', '30', '2023-12-30 00:00:00', '2024-02-09 00:00:00', 1, '2023-12-18 14:21:57', '2023-12-18 15:18:00');
INSERT INTO `promotions` VALUES (2, 'Vui Cùng Noel', '25', '2023-12-18 00:00:00', '2023-12-28 00:00:00', 1, '2023-12-18 14:37:10', '2023-12-18 14:37:10');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `star` int NOT NULL,
  `comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO `reviews` VALUES (1, 32, 2, '3', '2024-03-13 11:00:19', '2024-03-13 11:00:19');
INSERT INTO `reviews` VALUES (2, 32, 2, '3', '2024-03-13 11:00:19', '2024-03-13 11:00:19');
INSERT INTO `reviews` VALUES (3, 32, 2, '3', '2024-03-13 11:00:19', '2024-03-13 11:00:19');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', '2023-12-29 14:20:51', '2023-12-29 14:20:53');
INSERT INTO `roles` VALUES (2, 'employee', '2023-12-29 14:21:05', '2023-12-29 14:21:07');
INSERT INTO `roles` VALUES (3, 'user', '2023-12-29 14:21:21', '2023-12-29 14:21:23');

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `amout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noidung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@mail.com', NULL, '$2y$12$4GPSoHX0meHhXrn61QrNkuaSx7rQP7IHyQcjE0dyKpKA1XrRWOLqS', '9pAhHhUxricGeb3YfysPCXbhs5gDfijD6pvrjFJsOekueu6Gp52YvskGFujR', '2023-12-18 06:33:05', '2023-12-18 06:33:05', '0866411902', NULL, NULL, 1);
INSERT INTO `users` VALUES (21, 'Tôi Là User', 'user123@gmail.com', NULL, '$2y$12$xxAki3hxPeGyyJmcscTxFufRh4XpikOVxq4DfF2nfQiQF4nISyWue', NULL, '2024-03-12 13:28:21', '2024-03-12 13:28:21', '0866411902', NULL, NULL, 3);
INSERT INTO `users` VALUES (22, 'Tran Van A', 'tranvana@gmail.com', NULL, '$2y$12$Buyli2wUF2N2yuXuMJq0NuKaB6PSyHUe2LSN8/XWLUKtnZ0K/xR7u', NULL, '2024-03-12 13:46:02', '2024-03-12 13:46:02', '0866411902', NULL, NULL, 3);

SET FOREIGN_KEY_CHECKS = 1;

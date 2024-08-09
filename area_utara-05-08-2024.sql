/*
 Navicat Premium Data Transfer

 Source Server         : local mysql
 Source Server Type    : MySQL
 Source Server Version : 80033 (8.0.33)
 Source Host           : localhost:3306
 Source Schema         : area_utara

 Target Server Type    : MySQL
 Target Server Version : 80033 (8.0.33)
 File Encoding         : 65001

 Date: 05/08/2024 12:15:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Balaclava');
INSERT INTO `kategori` VALUES (2, 'Hoodie');
INSERT INTO `kategori` VALUES (3, 'Scarf');
INSERT INTO `kategori` VALUES (4, 'T-Shirt');
INSERT INTO `kategori` VALUES (5, 'Sticker');

-- ----------------------------
-- Table structure for lokasi_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `lokasi_pengguna`;
CREATE TABLE `lokasi_pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lokasi_pengguna
-- ----------------------------
INSERT INTO `lokasi_pengguna` VALUES (1, 'sarkuy', 'Lokasi Dummy', '2024-08-03 01:43:35');
INSERT INTO `lokasi_pengguna` VALUES (2, 'sarkuy', 'Lokasi Dummy', '2024-08-03 01:55:40');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `postcode` int NULL DEFAULT NULL,
  `delivery_method` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delivery_fee` float NULL DEFAULT NULL,
  `sub_total` float NULL DEFAULT NULL,
  `total` float NULL DEFAULT NULL,
  `products` json NULL,
  `created_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (27, '61QHVFy2dk', 'riskisyko@gmail.com', 'Riski Ramdan', 'Jalan Jurang ', 40161, 'ship', 15000, 100000, 115000, '[{\"0\": \"24\", \"1\": \"4\", \"2\": \"T-Shirt STRIPE\", \"3\": \"100000\", \"4\": \"YS3URvYoBP6TVvY16Qio.jpg\", \"5\": \"T-Shirt STRIPE kualitas premium\", \"6\": \"tersedia\", \"id\": \"24\", \"foto\": \"YS3URvYoBP6TVvY16Qio.jpg\", \"nama\": \"T-Shirt STRIPE\", \"harga\": \"100000\", \"detail\": \"T-Shirt STRIPE kualitas premium\", \"quantity\": 1, \"kategori_id\": \"4\", \"ketersediaan_stok\": \"tersedia\"}]', 1722794498);
INSERT INTO `order` VALUES (28, 'gILHkSdtu9', 'riski@mail.com', NULL, NULL, NULL, 'pickup', 0, 470000, 470000, '[{\"0\": \"6\", \"1\": \"1\", \"2\": \"Balaclava CRASS\", \"3\": \"100000\", \"4\": \"kQ92E6mhvGr85L1xokdk.jpg\", \"5\": \"Balaclava CRASS kualitas premium\", \"6\": \"tersedia\", \"id\": \"6\", \"foto\": \"kQ92E6mhvGr85L1xokdk.jpg\", \"nama\": \"Balaclava CRASS\", \"harga\": \"100000\", \"detail\": \"Balaclava CRASS kualitas premium\", \"quantity\": 1, \"kategori_id\": \"1\", \"ketersediaan_stok\": \"tersedia\"}, {\"0\": \"3\", \"1\": \"1\", \"2\": \"Balaclava ALLEZ\", \"3\": \"100000\", \"4\": \"fS2XCgX3oBfNR81tCXNY.jpg\", \"5\": \"Balaclava ALLEZ Kualitas Premium\", \"6\": \"tersedia\", \"id\": \"3\", \"foto\": \"fS2XCgX3oBfNR81tCXNY.jpg\", \"nama\": \"Balaclava ALLEZ\", \"harga\": \"100000\", \"detail\": \"Balaclava ALLEZ Kualitas Premium\", \"quantity\": 1, \"kategori_id\": \"1\", \"ketersediaan_stok\": \"tersedia\"}, {\"0\": \"21\", \"1\": \"4\", \"2\": \"T-Shirt CIRCLE\", \"3\": \"90000\", \"4\": \"nhmPyjqh2It8wkLt1xNb.jpg\", \"5\": \"T-Shirt CIRCLE kualitas premium\", \"6\": \"tersedia\", \"id\": \"21\", \"foto\": \"nhmPyjqh2It8wkLt1xNb.jpg\", \"nama\": \"T-Shirt CIRCLE\", \"harga\": \"90000\", \"detail\": \"T-Shirt CIRCLE kualitas premium\", \"quantity\": 3, \"kategori_id\": \"4\", \"ketersediaan_stok\": \"tersedia\"}]', 1722794562);
INSERT INTO `order` VALUES (29, 'q1i4G9Q4mS', 'riskisyko@gmail.com', 'Riski Ramdan', 'Jalan Jurang Gang bapa Adma Rt 07 Rw 05 No 636/181 (Riski Salon)', 40161, 'ship', 15000, 100000, 115000, '[{\"0\": \"3\", \"1\": \"1\", \"2\": \"Balaclava ALLEZ\", \"3\": \"100000\", \"4\": \"fS2XCgX3oBfNR81tCXNY.jpg\", \"5\": \"Balaclava ALLEZ Kualitas Premium\", \"6\": \"tersedia\", \"id\": \"3\", \"foto\": \"fS2XCgX3oBfNR81tCXNY.jpg\", \"nama\": \"Balaclava ALLEZ\", \"harga\": \"100000\", \"detail\": \"Balaclava ALLEZ Kualitas Premium\", \"quantity\": 1, \"kategori_id\": \"1\", \"ketersediaan_stok\": \"tersedia\"}]', 1722834056);
INSERT INTO `order` VALUES (30, 'k2YX4EGwdR', 'asdasd@mail.com', NULL, NULL, NULL, 'pickup', 0, 50000, 50000, '[{\"0\": \"19\", \"1\": \"3\", \"2\": \"Scarf SKUL SLAYER BANDANA\", \"3\": \"50000\", \"4\": \"gHZ1fYM8N88XXIAoh1KR.jpg\", \"5\": \"Scarf SKUL SLAYER BANDANA kualitas premium\", \"6\": \"tersedia\", \"id\": \"19\", \"foto\": \"gHZ1fYM8N88XXIAoh1KR.jpg\", \"nama\": \"Scarf SKUL SLAYER BANDANA\", \"harga\": \"50000\", \"detail\": \"Scarf SKUL SLAYER BANDANA kualitas premium\", \"quantity\": 1, \"kategori_id\": \"3\", \"ketersediaan_stok\": \"tersedia\"}]', 1722834556);

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori_id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `ketersediaan_stok` enum('habis','tersedia') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'tersedia',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `nama`(`nama` ASC) USING BTREE,
  INDEX `kategori_produk`(`kategori_id` ASC) USING BTREE,
  CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (2, 1, 'Balaclava ACAB', 100000, 'N2JKBcHE0LxkOX42I6Bc.jpg', 'Balaclava ACAB Kulitas Premium', 'tersedia');
INSERT INTO `produk` VALUES (3, 1, 'Balaclava ALLEZ', 100000, 'fS2XCgX3oBfNR81tCXNY.jpg', 'Balaclava ALLEZ Kualitas Premium', 'tersedia');
INSERT INTO `produk` VALUES (4, 1, 'Balaclava ATHENS', 90000, '78jUARW5nMyQpDOEKCct.jpg', 'Balaclava ATHENS Kualitas Premium', 'tersedia');
INSERT INTO `produk` VALUES (5, 1, 'Balaclava BOBOTOH', 120000, 'bNmYk8USTrAmz8k8CUkC.jpg', 'Balaclava BOBOTOH kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (6, 1, 'Balaclava CRASS', 100000, 'kQ92E6mhvGr85L1xokdk.jpg', 'Balaclava CRASS kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (7, 1, 'Balaclava DEVIL', 90000, 'p1eR2HHOeltUxrYUJrcv.jpg', 'Balaclava DEVIL kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (8, 1, 'Balaclava DIAVOLO', 80000, '45V7w32bbuuyiF9wT8Og.jpg', 'Balaclava DIAVOLO kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (9, 1, 'Balaclava FANATICS', 95000, '2tTojNxuQQcznfim8N8J.jpg', 'Balaclava FANATICS kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (10, 1, 'Balaclava HOOLIGANS', 100000, 'yzNjvQ2w6cLq8vZ3EXrD.jpg', 'Balaclava HOOLIGANS kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (11, 1, 'Balaclava HOOLS WHITE', 135000, 'jDJ9CoJm7SFCDHG15oXd.jpg', 'Balaclava HOOLS WHITE kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (12, 1, 'Balaclava SANTOS', 100000, 'mbs75SCSLB26fWV7xVEI.jpg', 'Balaclava SANTOS kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (13, 1, 'Balaclava WARRIORS', 80000, 'nd8UY647SbkZol8DaHPM.jpg', 'Balaclava WARRIORS produk premium', 'tersedia');
INSERT INTO `produk` VALUES (14, 1, 'Balaclava WARSZAWA', 95000, 'tWhGZpyqekASr9tyfAhN.jpg', 'Balaclava WARSZAWA kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (15, 1, 'Balaclava ZEBRA', 80000, 'hjeLLsMcKucECvqzOJUn.jpg', 'Balaclava ZEBRA kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (16, 2, 'Hoodie PASSION', 350000, 'ApGavWNBWiSpQlW7pwso.jpg', 'Hoodie PASSION kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (17, 2, 'Hoodie SCARED', 300000, 's0IABpYmJijPEPN4bfW8.jpg', 'Hoodie SCARED kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (18, 2, 'Hoodie ULTRAS SKULL', 350000, '5oL58pYcZpvLdBlIIwLj.jpg', 'Hoodie ULTRAS SKULL kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (19, 3, 'Scarf SKUL SLAYER BANDANA', 50000, 'gHZ1fYM8N88XXIAoh1KR.jpg', 'Scarf SKUL SLAYER BANDANA kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (20, 4, 'T-Shirt BRIGADE BLACK', 85000, 'oDBCvF0f8SjMjF2v56BO.jpg', 'T-Shirt BRIGADE BLACK kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (21, 4, 'T-Shirt CIRCLE', 90000, 'nhmPyjqh2It8wkLt1xNb.jpg', 'T-Shirt CIRCLE kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (22, 4, 'T-Shirt INDONESIA FC', 90000, 'R2k9vmpDwMBh5VzRJ6oW.jpg', 'T-Shirt INDONESIA FC kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (23, 4, 'T-Shirt NORD WHITE', 90000, 'M8Jxa2pfWorycgjl7lNm.jpg', 'T-Shirt NORD WHITE kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (24, 4, 'T-Shirt STRIPE', 100000, 'YS3URvYoBP6TVvY16Qio.jpg', 'T-Shirt STRIPE kualitas premium', 'tersedia');
INSERT INTO `produk` VALUES (25, 4, 'T-SHIRT ULTRAS', 120000, '4KnPsaI9Ak9bsaUYqQZN.jpg', 'T-SHIRT ULTRAS kualitas premium', 'tersedia');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2b$10$LuBph9mb/gAg5iaS8Y1yB.LJqUNdmMwTYm4HDJfFOfsTZcaDn12yO');
INSERT INTO `users` VALUES (3, 'remora', '123123123');
INSERT INTO `users` VALUES (4, 'sarmini', '$2y$10$6qgWMhu5xCZ3bpk.as50Z./7QbOEm25EXUwJwWUmTWiXN2q02CegO');
INSERT INTO `users` VALUES (5, 'sarkuy', 'f5bb0c8de146c67b44babbf4e6584cc0');
INSERT INTO `users` VALUES (6, 'test', '8068c76c7376bc08e2836ab26359d4a4');

SET FOREIGN_KEY_CHECKS = 1;

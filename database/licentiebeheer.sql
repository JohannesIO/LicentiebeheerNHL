/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : licentiebeheer

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 10/04/2020 12:16:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for gebruikers
-- ----------------------------
DROP TABLE IF EXISTS `gebruikers`;
CREATE TABLE `gebruikers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gebruikersnaam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wachtwoord` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isAdmin` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gebruikers
-- ----------------------------
INSERT INTO `gebruikers` VALUES (1, 'test@test.com', 'test', '$2y$10$JnzhmJ7uYee8.tGKZQEbB.eJ0rxtbXZbP1J1ZN8g4adq6P8UKtNrO', '0');

-- ----------------------------
-- Table structure for licenties
-- ----------------------------
DROP TABLE IF EXISTS `licenties`;
CREATE TABLE `licenties`  (
  `licentieid` int(11) NOT NULL AUTO_INCREMENT,
  `licentienummer` int(255) NOT NULL,
  `vervaldatum` date NULL DEFAULT NULL,
  `hoofdgebruiker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `licentienaam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `licentiebeschrijving` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `installatieuitleg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `verlenguitleg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `doelgroep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`licentieid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of licenties
-- ----------------------------
INSERT INTO `licenties` VALUES (2, 2, '2020-06-10', 'afdeling ict', 'Facebook', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (3, 3, '2020-06-10', 'afdeling ict', 'Tumblr', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (4, 4, '2020-06-10', 'afdeling ict', 'LinkedIn', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (5, 5, '2020-06-10', 'afdeling ict', 'MySpace', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (6, 6, '2020-06-10', 'afdeling ict', 'Hyves', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (7, 7, '2020-06-10', 'afdeling ict', 'Habbo', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (8, 8, '2020-06-10', 'afdeling ict', 'Google Agenda', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (9, 9, '2020-06-10', 'afdeling ict', 'PHPStorm', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (10, 10, '2020-06-10', 'afdeling ict', 'XAMPP', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (11, 11, '2020-06-10', 'afdeling ict', 'CMD', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (12, 12, '2020-06-10', 'afdeling ict', 'Microsoft Word', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (13, 13, '2020-06-10', 'afdeling ict', 'Microsoft Teamsssssssssssssss', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');
INSERT INTO `licenties` VALUES (23, 86, '2020-06-10', 'afdeling ict', 'Google', 'beschrijving 1', 'installatieuitleg1', 'dit is een verlenguitleg', 'Toegepaste Psychologie');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cookie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES (18, '', 'test@test.com', '508c72f08a09c4c1d3439642cdf95c9895948eb1');
INSERT INTO `sessions` VALUES (19, '', 'test@test.com', '3e90886657942387410c38091d5b46ffb287c216');
INSERT INTO `sessions` VALUES (20, '', 'test@test.com', 'ec1266feaa5963be037ec569bbbcbf0d7ae49c9b');
INSERT INTO `sessions` VALUES (21, '', 'test@test.com', '841fc4c3821531c32b23cb8663e8565d50eacbdb');
INSERT INTO `sessions` VALUES (22, '', 'test@test.com', '327cd67bf9a38ccc098338a09321564e3d433f0b');
INSERT INTO `sessions` VALUES (23, '', 'test@test.com', '9cc64ce7b784e338fc0f1efceda6453f232fbcc5');
INSERT INTO `sessions` VALUES (24, '', 'test@test.com', '4dfb76d94cd1faaf6b171a4da9fd992f1fae86bf');
INSERT INTO `sessions` VALUES (25, '', 'test@test.com', '618bff07f51615ed8f7ab6ecb95c0b7cbf36b970');
INSERT INTO `sessions` VALUES (26, '', 'test@test.com', '9c4f6b86cf2df6896d25b4a5c8d4da8ae7b86025');
INSERT INTO `sessions` VALUES (27, '', 'test@test.com', '1ad764cc38532ae419923ffcc3c2baf938ecc47b');
INSERT INTO `sessions` VALUES (28, '', 'test@test.com', '9b085787bd1e61fa55b347efa4d0887529ed7e0e');
INSERT INTO `sessions` VALUES (29, '', 'test@test.com', 'test3fe3fa2aab6b49d72faf18b81450963e8b68721f');
INSERT INTO `sessions` VALUES (30, '', 'test@test.com', 'testec605f7954909f350a22c0c50788c89199abead6');
INSERT INTO `sessions` VALUES (31, '', 'test@test.com', 'test0fb47b6326b1f693c1d18b936a4c73b58ac251f6');
INSERT INTO `sessions` VALUES (32, 'test', 'test@test.com', '796e4a16ac13cd9b9ac2b80f34c724e8d18c6b25');
INSERT INTO `sessions` VALUES (33, 'test', 'test@test.com', 'dec15f93ebaa6abfc3572ba848f845eab1e369dd');
INSERT INTO `sessions` VALUES (34, 'test', 'test@test.com', 'ff8f710996863347e77d933854c853588f204ec7');
INSERT INTO `sessions` VALUES (35, 'test', 'test@test.com', '44ff6b3368bfa4ad22ede2b8448f650ca06cbe0e');
INSERT INTO `sessions` VALUES (36, 'test', 'test@test.com', 'ae4e23999965c9247d4859c9ebc76caa0c689ef4');
INSERT INTO `sessions` VALUES (37, 'test', 'test@test.com', 'ddd462a81ff1423f7011722ff22877c70a2696c3');
INSERT INTO `sessions` VALUES (38, 'test', 'test@test.com', 'd1eb7b8f1703cd332c8bda5e4e7d5a296fefc7ff');
INSERT INTO `sessions` VALUES (39, 'test', 'test@test.com', '3628a5776acbc800c004e99c73f4e4796862d655');
INSERT INTO `sessions` VALUES (40, 'test', 'test@test.com', 'e8f33c0a7194af864b07e0901f68bf03e900bf36');
INSERT INTO `sessions` VALUES (41, 'test', 'test@test.com', 'df73a61b24d2b4923c3caafa6f24afca14d54879');
INSERT INTO `sessions` VALUES (42, 'test', 'test@test.com', 'a3b8eedb2b490bf88dc51456eef43c625b2bd2cb');
INSERT INTO `sessions` VALUES (43, 'test', 'test@test.com', 'f3f9cafbd692ed755473ccbd67726dbe37261fbd');
INSERT INTO `sessions` VALUES (44, 'test', 'test@test.com', 'c6a1a7507feea75bfdc55623ab5c7681077fa496');
INSERT INTO `sessions` VALUES (46, 'test', 'test@test.com', '053c74eebbb1fff823daeee9b29b0138f13e1193');
INSERT INTO `sessions` VALUES (48, 'test', 'test@test.com', 'a629daf3c87b1fdd703bfa0f5c8bc49a75bbe038');

SET FOREIGN_KEY_CHECKS = 1;

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

 Date: 14/04/2020 14:48:34
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
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gebruikers
-- ----------------------------
INSERT INTO `gebruikers` VALUES (8, 'test@test.com', 'test', '$2y$10$ehQhg.wd3vC1u8LU7iFHsuQkqf82S5lO20BzFA.HaSMLsl0LdwKxy', '1');
INSERT INTO `gebruikers` VALUES (9, 'ton@koppers.com', 'Ton Koppers', '$2y$10$qujERX1Jw.pGXDAyn1FiFuG2za2baeHSzHlODWKK./MQemPtIfv8S', '0');

-- ----------------------------
-- Table structure for licenties
-- ----------------------------
DROP TABLE IF EXISTS `licenties`;
CREATE TABLE `licenties`  (
  `licentieid` int(11) NOT NULL AUTO_INCREMENT,
  `licentiecode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `licentienaam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `licentiebeschrijving` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hoofdgebruiker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `vervaldatum` date NULL DEFAULT NULL,
  `doelgroep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `installatieuitleg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `verlenguitleg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`licentieid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of licenties
-- ----------------------------
INSERT INTO `licenties` VALUES (2, '2', 'Facebook', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (5, '5', 'MySpace', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (8, '8', 'Google Agenda', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (9, '9', 'PHPStorm', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (10, '10', 'XAMPP', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (11, '11', 'CMD', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (12, '12', 'Microsoft Word', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (13, '13', 'Microsoft Teams', 'beschrijving 1', 'afdeling ict', '2020-06-10', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (23, '86', 'Google', 'beschrijving 1', 'afdeling ict', '2020-04-15', 'Toegepaste Psychologie', 'installatieuitleg1', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (24, '0', 'Github', '', '', '2020-04-14', '', '', '');
INSERT INTO `licenties` VALUES (25, '0', 'Gitlab', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (26, '0', 'Nux', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (27, '0', 'Node.js', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (28, '0', 'Excel', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (29, '0', 'Word', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (30, '0', 'Spreadsheets', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (31, '0', 'HTML5', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (32, '0', 'CSS', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (33, '0', 'asdfasdffsad', '', '', '0000-00-00', '', '', '');
INSERT INTO `licenties` VALUES (34, '0', 'Twitch', '', '', '2020-04-16', 'Random', '', '');
INSERT INTO `licenties` VALUES (35, '0', 'lorem', 'lorem', 'lorem', '2020-04-16', 'lorem', 'lorem', 'lorem');

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
) ENGINE = InnoDB AUTO_INCREMENT = 98 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES (97, 'test', 'test@test.com', '9f754ab8d02183c4ecb54632d7a7c4cf9e5dfd66');

SET FOREIGN_KEY_CHECKS = 1;

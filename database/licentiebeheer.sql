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

 Date: 05/04/2020 14:53:47
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
INSERT INTO `gebruikers` VALUES (1, 'test@test.com', 'test', 'test', '0');

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
  `licentiebeschrijving` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `installatieuitleg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `doelgroep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `verlenguitleg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`licentieid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of licenties
-- ----------------------------
INSERT INTO `licenties` VALUES (1, 1, '0000-00-00', 'afdeling ict', 'Google', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (2, 2, '0000-00-00', 'afdeling ict', 'Facebook', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (3, 3, '0000-00-00', 'afdeling ict', 'Tumblr', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (4, 4, '0000-00-00', 'afdeling ict', 'LinkedIn', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (5, 5, '0000-00-00', 'afdeling ict', 'MySpace', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (6, 6, '0000-00-00', 'afdeling ict', 'Hyves', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (7, 7, '0000-00-00', 'afdeling ict', 'Habbo', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (8, 8, '0000-00-00', 'afdeling ict', 'Google Agenda', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (9, 9, '0000-00-00', 'afdeling ict', 'PHPStorm', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (10, 10, '0000-00-00', 'afdeling ict', 'XAMPP', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (11, 11, '0000-00-00', 'afdeling ict', 'CMD', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (12, 12, '0000-00-00', 'afdeling ict', 'Microsoft Word', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (23, 86, '0000-00-00', 'afdeling ict', 'Google', 'beschrijving 1', 'installatieuitleg1', 'Toegepaste Psychologie', 'dit is een verlenguitleg');
INSERT INTO `licenties` VALUES (24, 0, '0000-00-00', 'Julian', 'Julian', 'Julian', 'Julian', 'Toegepaste Psychologie', 'dit is een verlenguitleg');

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
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES (18, '', 'test@test.com', '508c72f08a09c4c1d3439642cdf95c9895948eb1');
INSERT INTO `sessions` VALUES (19, '', 'test@test.com', '3e90886657942387410c38091d5b46ffb287c216');

SET FOREIGN_KEY_CHECKS = 1;

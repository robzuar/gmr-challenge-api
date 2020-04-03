/*
 Navicat Premium Data Transfer

 Source Server         : heroku
 Source Server Type    : MySQL
 Source Server Version : 50562
 Source Host           : us-cdbr-iron-east-01.cleardb.net:3306
 Source Schema         : heroku_783e348a1bd943b

 Target Server Type    : MySQL
 Target Server Version : 50562
 File Encoding         : 65001

 Date: 01/04/2020 22:14:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for job
-- ----------------------------
DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processor` int(11) DEFAULT NULL,
  `submitter` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `command` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FBD8E0F829C04650` (`processor`),
  KEY `IDX_FBD8E0F8E6D2588B` (`submitter`),
  CONSTRAINT `FK_FBD8E0F829C04650` FOREIGN KEY (`processor`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_FBD8E0F8E6D2588B` FOREIGN KEY (`submitter`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1051 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job
-- ----------------------------
BEGIN;
INSERT INTO `job` VALUES (1, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:00:59', NULL, NULL);
INSERT INTO `job` VALUES (11, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:00', NULL, NULL);
INSERT INTO `job` VALUES (21, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:00', NULL, NULL);
INSERT INTO `job` VALUES (31, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:00', NULL, NULL);
INSERT INTO `job` VALUES (41, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:01', NULL, NULL);
INSERT INTO `job` VALUES (51, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:01', NULL, NULL);
INSERT INTO `job` VALUES (61, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:01', NULL, NULL);
INSERT INTO `job` VALUES (71, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:02', NULL, NULL);
INSERT INTO `job` VALUES (81, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:02', NULL, NULL);
INSERT INTO `job` VALUES (91, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:03', NULL, NULL);
INSERT INTO `job` VALUES (101, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:03', NULL, NULL);
INSERT INTO `job` VALUES (111, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:03', NULL, NULL);
INSERT INTO `job` VALUES (121, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:04', NULL, NULL);
INSERT INTO `job` VALUES (131, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:04', NULL, NULL);
INSERT INTO `job` VALUES (141, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:04', NULL, NULL);
INSERT INTO `job` VALUES (151, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:05', NULL, NULL);
INSERT INTO `job` VALUES (161, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:05', NULL, NULL);
INSERT INTO `job` VALUES (171, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:05', NULL, NULL);
INSERT INTO `job` VALUES (181, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:05', NULL, NULL);
INSERT INTO `job` VALUES (191, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:06', NULL, NULL);
INSERT INTO `job` VALUES (201, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:06', NULL, NULL);
INSERT INTO `job` VALUES (211, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:06', NULL, NULL);
INSERT INTO `job` VALUES (221, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:07', NULL, NULL);
INSERT INTO `job` VALUES (231, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:07', NULL, NULL);
INSERT INTO `job` VALUES (241, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:07', NULL, NULL);
INSERT INTO `job` VALUES (251, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:08', NULL, NULL);
INSERT INTO `job` VALUES (261, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:08', NULL, NULL);
INSERT INTO `job` VALUES (271, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:08', NULL, NULL);
INSERT INTO `job` VALUES (281, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:09', NULL, NULL);
INSERT INTO `job` VALUES (291, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:09', NULL, NULL);
INSERT INTO `job` VALUES (301, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:10', NULL, NULL);
INSERT INTO `job` VALUES (311, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:10', NULL, NULL);
INSERT INTO `job` VALUES (321, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:10', NULL, NULL);
INSERT INTO `job` VALUES (331, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:11', NULL, NULL);
INSERT INTO `job` VALUES (341, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:11', NULL, NULL);
INSERT INTO `job` VALUES (351, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:11', NULL, NULL);
INSERT INTO `job` VALUES (361, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:12', NULL, NULL);
INSERT INTO `job` VALUES (371, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:12', NULL, NULL);
INSERT INTO `job` VALUES (381, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:12', NULL, NULL);
INSERT INTO `job` VALUES (391, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:13', NULL, NULL);
INSERT INTO `job` VALUES (401, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:13', NULL, NULL);
INSERT INTO `job` VALUES (411, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:13', NULL, NULL);
INSERT INTO `job` VALUES (421, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:14', NULL, NULL);
INSERT INTO `job` VALUES (431, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:14', NULL, NULL);
INSERT INTO `job` VALUES (441, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:14', NULL, NULL);
INSERT INTO `job` VALUES (451, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:15', NULL, NULL);
INSERT INTO `job` VALUES (461, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:15', NULL, NULL);
INSERT INTO `job` VALUES (471, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:16', NULL, NULL);
INSERT INTO `job` VALUES (481, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:16', NULL, NULL);
INSERT INTO `job` VALUES (491, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:16', NULL, NULL);
INSERT INTO `job` VALUES (501, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:17', NULL, NULL);
INSERT INTO `job` VALUES (511, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:17', NULL, NULL);
INSERT INTO `job` VALUES (521, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:17', NULL, NULL);
INSERT INTO `job` VALUES (531, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:18', NULL, NULL);
INSERT INTO `job` VALUES (541, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:18', NULL, NULL);
INSERT INTO `job` VALUES (551, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:19', NULL, NULL);
INSERT INTO `job` VALUES (561, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:19', NULL, NULL);
INSERT INTO `job` VALUES (571, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:19', NULL, NULL);
INSERT INTO `job` VALUES (581, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:20', NULL, NULL);
INSERT INTO `job` VALUES (591, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:20', NULL, NULL);
INSERT INTO `job` VALUES (601, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:20', NULL, NULL);
INSERT INTO `job` VALUES (611, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:21', NULL, NULL);
INSERT INTO `job` VALUES (621, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:21', NULL, NULL);
INSERT INTO `job` VALUES (631, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:21', NULL, NULL);
INSERT INTO `job` VALUES (641, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:22', NULL, NULL);
INSERT INTO `job` VALUES (651, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:22', NULL, NULL);
INSERT INTO `job` VALUES (661, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:22', NULL, NULL);
INSERT INTO `job` VALUES (671, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:23', NULL, NULL);
INSERT INTO `job` VALUES (681, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:23', NULL, NULL);
INSERT INTO `job` VALUES (691, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:23', NULL, NULL);
INSERT INTO `job` VALUES (701, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:24', NULL, NULL);
INSERT INTO `job` VALUES (711, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:24', NULL, NULL);
INSERT INTO `job` VALUES (721, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:24', NULL, NULL);
INSERT INTO `job` VALUES (731, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:25', NULL, NULL);
INSERT INTO `job` VALUES (741, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:25', NULL, NULL);
INSERT INTO `job` VALUES (751, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:25', NULL, NULL);
INSERT INTO `job` VALUES (761, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:26', NULL, NULL);
INSERT INTO `job` VALUES (771, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:26', NULL, NULL);
INSERT INTO `job` VALUES (781, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:26', NULL, NULL);
INSERT INTO `job` VALUES (791, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:27', NULL, NULL);
INSERT INTO `job` VALUES (801, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:27', NULL, NULL);
INSERT INTO `job` VALUES (811, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:27', NULL, NULL);
INSERT INTO `job` VALUES (821, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:28', NULL, NULL);
INSERT INTO `job` VALUES (831, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:28', NULL, NULL);
INSERT INTO `job` VALUES (841, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:28', NULL, NULL);
INSERT INTO `job` VALUES (851, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:29', NULL, NULL);
INSERT INTO `job` VALUES (861, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:29', NULL, NULL);
INSERT INTO `job` VALUES (871, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:29', NULL, NULL);
INSERT INTO `job` VALUES (881, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:30', NULL, NULL);
INSERT INTO `job` VALUES (891, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:30', NULL, NULL);
INSERT INTO `job` VALUES (901, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:30', NULL, NULL);
INSERT INTO `job` VALUES (911, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:31', NULL, NULL);
INSERT INTO `job` VALUES (921, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:31', NULL, NULL);
INSERT INTO `job` VALUES (931, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:31', NULL, NULL);
INSERT INTO `job` VALUES (941, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:32', NULL, NULL);
INSERT INTO `job` VALUES (951, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:32', NULL, NULL);
INSERT INTO `job` VALUES (961, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:32', NULL, NULL);
INSERT INTO `job` VALUES (971, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:33', NULL, NULL);
INSERT INTO `job` VALUES (981, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:33', NULL, NULL);
INSERT INTO `job` VALUES (991, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:33', NULL, NULL);
INSERT INTO `job` VALUES (1001, NULL, 421, 'PENDING', 'Execute a command 1', '2020-04-01 23:01:34', NULL, NULL);
INSERT INTO `job` VALUES (1011, NULL, 421, 'PENDING', 'Execute a command 2', '2020-04-01 23:01:34', NULL, NULL);
INSERT INTO `job` VALUES (1021, NULL, 431, 'PENDING', 'Execute a command 3', '2020-04-01 23:01:35', NULL, NULL);
INSERT INTO `job` VALUES (1031, NULL, 431, 'PENDING', 'Execute a command 4', '2020-04-01 23:01:35', NULL, NULL);
INSERT INTO `job` VALUES (1041, NULL, 421, 'PENDING', 'Execute a command 5', '2020-04-01 23:01:35', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=631 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (421, 'User1', 'user1@api.com', '79a39070-4708-4007-9f01-0c4641d552b6');
INSERT INTO `user` VALUES (431, 'User2', 'user2@api.com', '40cead41-f3a2-4954-9232-6152c5f6a958');
INSERT INTO `user` VALUES (441, 'User3', 'user3@api.com', '7f3354f9-08d7-4035-a048-08989f0e244b');
INSERT INTO `user` VALUES (451, 'User4', 'user4@api.com', 'b1aafcd8-2465-4c07-b433-141c861c9707');
INSERT INTO `user` VALUES (461, 'User5', 'user5@api.com', 'b4faaa8a-ac5e-40df-b4b6-d411f51b5516');
INSERT INTO `user` VALUES (471, 'User6', 'user6@api.com', '1b89f62e-c3f1-4c32-8ab9-20b19e77c8f0');
INSERT INTO `user` VALUES (481, 'User7', 'user7@api.com', '9ac972a1-7d1b-4e8a-825b-58147e3e4598');
INSERT INTO `user` VALUES (491, 'User8', 'user8@api.com', '25879985-09be-46a3-b227-e117f19c1d8e');
INSERT INTO `user` VALUES (501, 'User9', 'user9@api.com', 'd9eeafaf-397b-430a-88ef-811eb72ef7a9');
INSERT INTO `user` VALUES (511, 'User10', 'user10@api.com', '57053992-9250-40da-a6e8-77ce559188d2');
INSERT INTO `user` VALUES (521, 'User11', 'user11@api.com', '9b4d435d-94ce-4749-9b82-c36f8232e0c3');
INSERT INTO `user` VALUES (531, 'User12', 'user2@api.com', '6a4dd424-257e-45da-b377-ec1efe71f608');
INSERT INTO `user` VALUES (541, 'User13', 'user3@api.com', 'fa94855c-9968-41b6-9bfb-545d5ab7712c');
INSERT INTO `user` VALUES (551, 'User14', 'user4@api.com', '702d0839-28c4-46ba-98ff-6d81e7e512dd');
INSERT INTO `user` VALUES (561, 'User15', 'user5@api.com', '242628e0-4f2a-4e0a-be5e-5b2e62149da9');
INSERT INTO `user` VALUES (571, 'User16', 'user6@api.com', '9da563f1-63ee-4020-9434-b561faad403a');
INSERT INTO `user` VALUES (581, 'User17', 'user7@api.com', '385d7a4a-9964-4772-ada9-33def066749a');
INSERT INTO `user` VALUES (591, 'User18', 'user8@api.com', '67e10a07-4fec-425a-9911-bd8d2fd22377');
INSERT INTO `user` VALUES (601, 'User19', 'user9@api.com', 'db3c3ab3-2ed5-450e-a754-29847d8010ed');
INSERT INTO `user` VALUES (611, 'User20', 'user10@api.com', '5ec5ad68-794a-4dd6-b70e-d987d486cc33');
INSERT INTO `user` VALUES (621, 'User21', 'user11@api.com', 'e8957490-42ec-4564-8ad3-2bda16d8fd6b');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

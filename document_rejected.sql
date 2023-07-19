/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : dokling

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 20/07/2023 06:24:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for document_rejected
-- ----------------------------
DROP TABLE IF EXISTS `document_rejected`;
CREATE TABLE `document_rejected`  (
  `doc_rejected_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NULL DEFAULT NULL,
  `file_type_id` int(11) NULL DEFAULT NULL,
  `doc_file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `doc_rejected_by` int(11) NULL DEFAULT NULL,
  `doc_rejected_at` datetime NULL DEFAULT NULL,
  `doc_rejected_note` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`doc_rejected_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of document_rejected
-- ----------------------------
INSERT INTO `document_rejected` VALUES (1, 70, 6, 'dokumen_230718041839098736.pdf', 1, '2023-07-19 14:40:24', 'Tes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasanTes alasan');

SET FOREIGN_KEY_CHECKS = 1;

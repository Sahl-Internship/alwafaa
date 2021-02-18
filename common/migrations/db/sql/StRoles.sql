

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `booking_rbac_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_item`;
CREATE TABLE `rbac_auth_item` (
                                          `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                                          `type` smallint(6) NOT NULL,
                                          `description` text COLLATE utf8_unicode_ci,
                                          `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
                                          `data` blob,
                                          `created_at` int(11) DEFAULT NULL,
                                          `updated_at` int(11) DEFAULT NULL,
                                          PRIMARY KEY (`name`),
                                          KEY `rule_name` (`rule_name`),
                                          KEY `idx-auth_item-type` (`type`),
                                          CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of booking_rbac_auth_item
-- ----------------------------
INSERT INTO `rbac_auth_item` VALUES ('administrator', '1', 'super admin', null, null, '1541928282', '1541928282');
INSERT INTO `rbac_auth_item` VALUES ('editOwnModel', '2', null, 'ownModelRule', null, '1541928284', '1541928284');
INSERT INTO `rbac_auth_item` VALUES ('loginToBackend', '2', null, null, null, '1541928283', '1541928283');
INSERT INTO `rbac_auth_item` VALUES ('manager', '1', 'مدير المدرسة', null, null, '1541928281', '1541928281');
INSERT INTO `rbac_auth_item` VALUES ('teacher', '1', 'معلم', null, null, '1541928281', '1541928281');
INSERT INTO `rbac_auth_item` VALUES ('student', '1', 'متعلم', null, null, '1541928281', '1541928281');

-- ----------------------------
-- Table structure for `booking_rbac_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_item_child`;
CREATE TABLE `rbac_auth_item_child` (
                                                `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                                                `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                                                PRIMARY KEY (`parent`,`child`),
                                                KEY `child` (`child`),
                                                CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
                                                CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of booking_rbac_auth_item_child
-- ----------------------------
INSERT INTO `rbac_auth_item_child` VALUES ('student', 'editOwnModel');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` VALUES ('manager', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` VALUES ('teacher', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'manager');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'teacher');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'student');
INSERT INTO `rbac_auth_item_child` VALUES ('manager', 'student');

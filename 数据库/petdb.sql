/*
Navicat MySQL Data Transfer

Source Server         : cySQL
Source Server Version : 50557
Source Host           : 192.168.9.90:3306
Source Database       : petdb

Target Server Type    : MYSQL
Target Server Version : 50557
File Encoding         : 65001

Date: 2017-11-07 18:31:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for manager
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` varchar(50) NOT NULL,
  `TrueName` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('c63d9206-c109-11e7-b633-14dda97c32c8', 'manager', '666666');

-- ----------------------------
-- Table structure for menudetail
-- ----------------------------
DROP TABLE IF EXISTS `menudetail`;
CREATE TABLE `menudetail` (
  `Id` varchar(255) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `MenuId` varchar(255) NOT NULL,
  `Price` float(20,0) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Menu_Detail_id` (`MenuId`),
  CONSTRAINT `FK_Menu_Detail_id` FOREIGN KEY (`menuId`) REFERENCES `menus` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menudetail
-- ----------------------------
INSERT INTO `menudetail` VALUES ('17569237-be33-11e7-99bc-14dda97c32c8', '宠物宝贝体验拍摄', '340234f4-be06-11e7-99bc-14dda97c32c8', '178', 'sheying05.jpg', '改摄影套餐有精品拍摄精修16张，但不提供人宠合影，并且宠物服装自备，我们会在指定的摄影棚摆设道具进行摄影。');
INSERT INTO `menudetail` VALUES ('1756950c-be33-11e7-99bc-14dda97c32c8', '时尚杂志册套餐', '340234f4-be06-11e7-99bc-14dda97c32c8', '258', 'sheying04.jpg', '我们提供8寸精美杂志册时尚杂志册套餐一本（20张照片），附带10寸欧式版画一副，钱包卡两张，高精度光碟一张，我们会提供三套宠物服装以及饰品，棚拍698、外景798。');
INSERT INTO `menudetail` VALUES ('17569596-be33-11e7-99bc-14dda97c32c8', '豪华宠爱套餐', '340234f4-be06-11e7-99bc-14dda97c32c8', '398', 'sheying06.jpg', '我们提供12寸精美豪华水晶相册（30张照片），附带24寸油画框一幅，20寸欧式版画一幅，高精度精修光碟一张，宠物服装不限使用，拍摄地点外拍加棚拍。');
INSERT INTO `menudetail` VALUES ('1756961d-be33-11e7-99bc-14dda97c32c8', '宠爱全家福外景套餐', '340234f4-be06-11e7-99bc-14dda97c32c8', '598', 'sheying07.jpg', '我们提供宠物主人3套服装，与宠物一同拍摄，专业化妆师全程跟随，15寸精美豪华水晶相册（40张照片），8寸精美圣经相册，附带30寸油画框一幅，24寸欧式版画一幅，高精度精修光碟一张，宠物服装不限使用，全程抓拍，地点尽可能由客户选取。');
INSERT INTO `menudetail` VALUES ('35240a7e-be32-11e7-99bc-14dda97c32c8', '宠物皮肤病治疗', '340234c7-be06-11e7-99bc-14dda97c32c8', '200', 'yiliao01.jpg', '宠物皮肤有多种皮肤病，比如说：真菌，狗感染的局部皮肤脱毛、断毛，一块一块的皮肤发红；过敏引起的皮肤病，来得比较突然，面积大，皮肤发红等等，我们会通过宠物反馈的症状来进行对症下药，花最少的钱来治疗我们的宝贝。');
INSERT INTO `menudetail` VALUES ('35240b1e-be32-11e7-99bc-14dda97c32c8', '宠物内科病', '340234c7-be06-11e7-99bc-14dda97c32c8', '300', 'yiliao03.jpg', '宠物的内科病通常有这样几种，口炎、咽炎、食管梗塞、胃炎、胃内异物、胃扩张等，我们相关的医生会对应不同的症状，提供不同种类的治疗方法，从而让我们的宠物们更快的痊愈。');
INSERT INTO `menudetail` VALUES ('35240b8f-be32-11e7-99bc-14dda97c32c8', '宠物绝育', '340234c7-be06-11e7-99bc-14dda97c32c8', '300', 'yiliao02.jpg', '首先告知宠物手术前注意事项：术前8小时，禁食。术前四小时，尽量禁水，或少喝水。术后一个月内不得洗澡。麻醉有两种形式，注射式的便宜，吸入式的贵，但效果都一样。术后通常不会让宠物马上离开，会继续输液，等其基本苏醒后，确定无异常情况，方可离开。');
INSERT INTO `menudetail` VALUES ('500c5404-be2f-11e7-99bc-14dda97c32c8', '家庭式寄养', '3402349a-be06-11e7-99bc-14dda97c32c8', '500', 'jiyang02.jpg', '我们寻找的寄养家庭是像用户你一样爱它，我们会帮预约用户照顾宠物，散养在温馨的家庭环境。每天可以按照你的要求遛狗喂猫，及时让你了解宠物的情况。在寄养期间，保证宠物的安全和身心健康，让寄养用户真正的放心。');
INSERT INTO `menudetail` VALUES ('500c577a-be2f-11e7-99bc-14dda97c32c8', '宠物店寄养', '3402349a-be06-11e7-99bc-14dda97c32c8', '200', 'jiyang01.jpg', '宠物店有着非常专业的照顾宠物的能力，每天都为宠物们准备丰盛的食物，定期为宠物进行清理，即便宠物在寄养期间发生一些突发情况，宠物店都能及时的为您解决问题，不给客户带来不必要的担心。');
INSERT INTO `menudetail` VALUES ('500c57fa-be2f-11e7-99bc-14dda97c32c8', '大型宠物寄养乐园', '3402349a-be06-11e7-99bc-14dda97c32c8', '1888', 'jiyang03.jpg', '大型宠物寄养乐园是升级版的宠物店寄养，这里的活动空间很大，宠物们不用拘束在小小的笼子里，它们有自己的活动空间，而且可以和同类接触，生活环境很安全，我们每天也会准时根据用户的要求喂食，及时向用户汇报宠物们的生活情况。');
INSERT INTO `menudetail` VALUES ('84a43fd8-be2e-11e7-99bc-14dda97c32c8', '宠物洗漱', '34023286-be06-11e7-99bc-14dda97c32c8', '180', 'meirong14.jpg', '首先在洗漱地点放一块防滑垫，在采用一款让狗狗喜欢,并且安全的浴液对宠物全身的清洗，用一块可以完全把宠物包起来的大毛巾给其擦干，取掉狗狗耳朵里面的棉条，擦净耳朵。以毛巾先行擦拭，再用吹风机吹干，最后梳理其毛发。');
INSERT INTO `menudetail` VALUES ('84aea0bc-be2e-11e7-99bc-14dda97c32c8', '宠物修剪', '34023286-be06-11e7-99bc-14dda97c32c8', '120', 'meirong09.jpg', '我们有最专业的技师为宠物服务，剪毛之前，先用密齿梳将全身的毛梳顺梳齐、用酒精棉清理眼部残留污垢、修剪眼部多余毛发、清洗耳道和拔耳毛、修剪腹部以及脚掌的毛、修剪肛门腺周围、挤肛门腺以及修剪前后脚掌指甲。');
INSERT INTO `menudetail` VALUES ('84aea206-be2e-11e7-99bc-14dda97c32c8', '精洗修剪+全身造型', '34023286-be06-11e7-99bc-14dda97c32c8', '320', 'meirong06.jpg', '梳理毛发、清理眼部、修剪眼部、清洗耳道、拔耳毛、修剪腹底毛、修剪脚底毛、修剪肛门腺周围、挤肛门腺、修剪指甲、洗澡去污、吹风拉毛、SPA精油护理，我们有专业的造型师根据宠物主人的喜好为宠物设计造型。');
INSERT INTO `menudetail` VALUES ('cf30d720-c2e9-11e7-8db5-14dda97c32c8', '赵氏摄影', '340234f4-be06-11e7-99bc-14dda97c32c8', '445', 'a21f1008c2ad41d536808b5a3543201e.jpg', '赵氏摄影，针对想要开自己摄影工作室的学员，重点培养前期拍摄，人像拍摄精讲，影楼管理，环境，选址，，服务宗旨');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `Id` varchar(255) NOT NULL,
  `Name` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('34023286-be06-11e7-99bc-14dda97c32c8', '美容');
INSERT INTO `menus` VALUES ('3402349a-be06-11e7-99bc-14dda97c32c8', '寄养');
INSERT INTO `menus` VALUES ('340234c7-be06-11e7-99bc-14dda97c32c8', '医疗');
INSERT INTO `menus` VALUES ('340234f4-be06-11e7-99bc-14dda97c32c8', '摄影');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `Id` varchar(255) NOT NULL,
  `Message` varchar(250) DEFAULT NULL,
  `UserId` varchar(255) NOT NULL,
  `MenuId` varchar(255) DEFAULT NULL,
  `PetId` varchar(255) NOT NULL,
  `State` enum('3','2','1','0') NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_users_orders_UserId` (`UserId`),
  KEY `FK_pets_orders_PetId` (`PetId`),
  KEY `FK_menuDetail_orders_id` (`MenuId`),
  CONSTRAINT `FK_menuDetail_orders_id` FOREIGN KEY (`MenuId`) REFERENCES `menudetail` (`id`),
  CONSTRAINT `FK_users_orders_UserId` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('4d723dbb-be2a-11e7-99bc-14dda97c32c8', '两天之后请再与我联系', 'b23257ed-d769-11dd-a6ec-14dda97c5667', '1756961d-be33-11e7-99bc-14dda97c32c8', '45fabd4d-be0b-11e7-99bc-14dda97c32c8', '2', '2017-10-10 00:00:00');
INSERT INTO `orders` VALUES ('59979f99-c35c-11e7-9b53-14dda97c32c8', '上门服务', 'b23257ed-d769-11dd-a6ec-14dda97c5667', '35240b8f-be32-11e7-99bc-14dda97c32c8', 'e3952045-c107-11e7-b633-14dda97c32c8', '3', '2017-11-02 00:00:00');
INSERT INTO `orders` VALUES ('b75bb112-c12a-11e7-b633-14dda97c32c8', '今天下午', 'b23257ed-d769-11dd-a6ec-14dda97c5667', '1756950c-be33-11e7-99bc-14dda97c32c8', '45fabd4d-be0b-11e7-99bc-14dda97c32c8', '2', '2017-11-04 14:38:00');

-- ----------------------------
-- Table structure for petcategories
-- ----------------------------
DROP TABLE IF EXISTS `petcategories`;
CREATE TABLE `petcategories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of petcategories
-- ----------------------------
INSERT INTO `petcategories` VALUES ('1', '猫');
INSERT INTO `petcategories` VALUES ('2', '狗');
INSERT INTO `petcategories` VALUES ('3', '香猪');
INSERT INTO `petcategories` VALUES ('4', '龙猫');
INSERT INTO `petcategories` VALUES ('32', '鳄龟');

-- ----------------------------
-- Table structure for pets
-- ----------------------------
DROP TABLE IF EXISTS `pets`;
CREATE TABLE `pets` (
  `Id` varchar(255) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `Sex` enum('雌','雄') NOT NULL DEFAULT '雄',
  `Age` int(11) NOT NULL,
  `UserId` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_users_pets_MasterId` (`UserId`),
  KEY `FK_petcategories_pets` (`CategoryId`),
  CONSTRAINT `FK_petcategories_pets` FOREIGN KEY (`CategoryId`) REFERENCES `petcategories` (`Id`),
  CONSTRAINT `FK_user_pets_id` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pets
-- ----------------------------
INSERT INTO `pets` VALUES ('10fa56bf-c129-11e7-b633-14dda97c32c8', '阿瑟', '2', '雄', '8', '7c47fc3b-bfc3-11e7-808c-14dda97c32c8');
INSERT INTO `pets` VALUES ('3b2167a4-c100-11e7-b633-14dda97c32c8', '白', '2', '雄', '4', 'b35bcc62-c0fd-11e7-b633-14dda97c32c8');
INSERT INTO `pets` VALUES ('45fabd4d-be0b-11e7-99bc-14dda97c32c8', '咪咪', '1', '雌', '5', 'b23257ed-d769-11dd-a6ec-14dda97c5667');
INSERT INTO `pets` VALUES ('953bfbb5-bf98-11e7-808c-14dda97c32c8', '花花', '2', '雄', '1', '26af4a12-be0c-11e7-99bc-14dda97c32c8');
INSERT INTO `pets` VALUES ('bf452209-be0c-11e7-99bc-14dda97c32c8', '二哈', '2', '雄', '1', '26af4c13-be0c-11e7-99bc-14dda97c32c8');
INSERT INTO `pets` VALUES ('bf45251a-be0c-11e7-99bc-14dda97c32c8', '萌萌', '4', '雌', '1', '26af4a12-be0c-11e7-99bc-14dda97c32c8');
INSERT INTO `pets` VALUES ('e3952045-c107-11e7-b633-14dda97c32c8', '徐海涛', '2', '雌', '6', 'b23257ed-d769-11dd-a6ec-14dda97c5667');

-- ----------------------------
-- Table structure for userdetils
-- ----------------------------
DROP TABLE IF EXISTS `userdetils`;
CREATE TABLE `userdetils` (
  `Id` varchar(255) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `TrueName` varchar(20) NOT NULL,
  `CardId` varchar(20) NOT NULL,
  `Sex` enum('女','男') NOT NULL DEFAULT '男',
  `Phone` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`),
  CONSTRAINT `FK_users_userdetils_Id` FOREIGN KEY (`Id`) REFERENCES `users` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userdetils
-- ----------------------------
INSERT INTO `userdetils` VALUES ('1816d945-becc-11e7-a366-14dda97c32c8', '江苏省苏州市吴中区', '马六', '44132419950518031X', '男', '18852675790');
INSERT INTO `userdetils` VALUES ('23efeb27-bf9f-11e7-808c-14dda97c32c8', 'as发顺丰', '撒的', '44132419950518031X', '女', '18852675793');
INSERT INTO `userdetils` VALUES ('26af4a12-be0c-11e7-99bc-14dda97c32c8', '江苏省苏州市相城区', '张三', '320162199501562421', '男', '15895033000');
INSERT INTO `userdetils` VALUES ('26af4c13-be0c-11e7-99bc-14dda97c32c8', '江苏省苏州市吴中区', '李四', '320162198704256521', '女', '15895033698');
INSERT INTO `userdetils` VALUES ('52b69e4c-bf9f-11e7-808c-14dda97c32c8', '噶法规', '找爷爷', '321323199510043625', '男', '18852676613');
INSERT INTO `userdetils` VALUES ('7c47fc3b-bfc3-11e7-808c-14dda97c32c8', '江苏盐城', '赵正业', '320902199609187512', '男', '18851647547');
INSERT INTO `userdetils` VALUES ('9f1beb7d-c0fe-11e7-b633-14dda97c32c8', '还是不告诉你', '就不说', '320901145800147', '女', '18852675909');
INSERT INTO `userdetils` VALUES ('b23257ed-d769-11dd-a6ec-14dda97c5667', '江苏省苏州市姑苏区', '王六', '320621199704280012', '男', '15123645985');
INSERT INTO `userdetils` VALUES ('b35bcc62-c0fd-11e7-b633-14dda97c32c8', '苏州NIIT', '徐爱涛', '320902199609187512', '男', '18852675790');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` varchar(255) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `LoginName` varchar(20) NOT NULL,
  `State` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UQ_loginName` (`LoginName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1816d945-becc-11e7-a366-14dda97c32c8', '111111', 'a123456', '1');
INSERT INTO `users` VALUES ('23efeb27-bf9f-11e7-808c-14dda97c32c8', '123456', 'b123456', '1');
INSERT INTO `users` VALUES ('26af4a12-be0c-11e7-99bc-14dda97c32c8', '123456', 'manager', '1');
INSERT INTO `users` VALUES ('26af4c13-be0c-11e7-99bc-14dda97c32c8', '000000', 'abc', '1');
INSERT INTO `users` VALUES ('52b69e4c-bf9f-11e7-808c-14dda97c32c8', '1234567', 'abcdefg', '0');
INSERT INTO `users` VALUES ('7c47fc3b-bfc3-11e7-808c-14dda97c32c8', '123456', '735060518', '0');
INSERT INTO `users` VALUES ('9f1beb7d-c0fe-11e7-b633-14dda97c32c8', '666666', 'ajsfdf', '0');
INSERT INTO `users` VALUES ('b23257ed-d769-11dd-a6ec-14dda97c5667', 'zzzzzz', 'admin', '1');
INSERT INTO `users` VALUES ('b35bcc62-c0fd-11e7-b633-14dda97c32c8', 'abc7758258', 'a1685924962', '1');

/*
Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : crudpdo

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `usuariosId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`usuariosId`),
  UNIQUE KEY `usuarios_usuariosId_uindex` (`usuariosId`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

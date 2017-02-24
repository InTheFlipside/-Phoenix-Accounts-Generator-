/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `dumps` */

DROP TABLE IF EXISTS `dumps`;

CREATE TABLE `dumps` (
  `DumpID` int(244) NOT NULL AUTO_INCREMENT,
  `DumpAlt` blob NOT NULL,
  `DumpCategory` blob NOT NULL,
  `DumpAddedDate` int(244) NOT NULL,
  PRIMARY KEY (`DumpID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `merchant`;

CREATE TABLE `merchant` (
  `PaypalEmail` blob NOT NULL,
  `WebsiteDomain` blob NOT NULL,
  `WebsiteName` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `NewsID` int(244) NOT NULL AUTO_INCREMENT,
  `NewsTitle` blob NOT NULL,
  `NewsNew` blob NOT NULL,
  `NewsAuthor` blob NOT NULL,
  `NewsDate` int(244) NOT NULL,
  PRIMARY KEY (`NewsID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `plans`;

CREATE TABLE `plans` (
  `PlanID` int(244) NOT NULL AUTO_INCREMENT,
  `PlanName` blob NOT NULL,
  `PlanDesc` blob NOT NULL,
  `PlanPrice` blob NOT NULL,
  `PlanLength` enum('Daily','Weekly','Monthly','Lifetime') CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`PlanID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `support`;

CREATE TABLE `support` (
  `SupportID` int(244) NOT NULL AUTO_INCREMENT,
  `SupportUserID` int(244) NOT NULL,
  `SupportTitle` blob NOT NULL,
  `SupportMessage` blob NOT NULL,
  `SupportTicketReply` blob NOT NULL,
  `SupportTicketStatus` tinyint(1) NOT NULL DEFAULT '0',
  `SupportDate` int(244) NOT NULL,
  PRIMARY KEY (`SupportID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `TransactionID` int(244) NOT NULL AUTO_INCREMENT,
  `TransactionAmount` int(244) NOT NULL,
  `TransactionVerifySign` blob NOT NULL,
  `TransactionUserID` int(244) NOT NULL,
  `TransactionPlanID` int(244) NOT NULL,
  `TransactionDate` int(244) NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `transuserid` (`TransactionUserID`),
  KEY `transplanid` (`TransactionPlanID`),
  CONSTRAINT `transplanid` FOREIGN KEY (`TransactionPlanID`) REFERENCES `plans` (`PlanID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transuserid` FOREIGN KEY (`TransactionUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `UserID` int(244) NOT NULL AUTO_INCREMENT,
  `UserName` blob NOT NULL,
  `UserPassword` blob NOT NULL,
  `UserEmail` blob NOT NULL,
  `UserAdmin` int(1) NOT NULL DEFAULT '0',
  `UserBanned` int(1) NOT NULL DEFAULT '0',
  `UserExpire` int(244) NOT NULL DEFAULT '0',
  `UserMembership` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `UserIP` blob NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

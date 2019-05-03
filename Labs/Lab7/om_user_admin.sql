--
-- Table structure for table `om_user_admin`
--

DROP TABLE IF EXISTS `om_user_admin`;
CREATE TABLE `om_user_admin` (
  `om_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `om_user_email` varchar(128) NOT NULL,
  `om_user_password` varchar(512) NOT NULL,
  `om_user_is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`om_user_id`),
  UNIQUE KEY `om_user_email` (`om_user_email`),
  KEY `om_user_email_2` (`om_user_email`),
  KEY `om_user_id` (`om_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--
-- s3cr3t => $2y$11$OzsRNS8.6u7wxkNFhHdFBOKrT0hvETHTV9twkG8ZhS.94hWSOrivu
INSERT INTO `om_user_admin` VALUES (1,'admin','$2y$11$OzsRNS8.6u7wxkNFhHdFBOKrT0hvETHTV9twkG8ZhS.94hWSOrivu',0);
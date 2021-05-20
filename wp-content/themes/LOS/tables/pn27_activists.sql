CREATE TABLE IF NOT EXISTS `pn27_activists` (
  `activist_ID` int(11) NOT NULL AUTO_INCREMENT,
  `activist_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `activist_UUID` varchar(100) NOT NULL,
  `activist_support_type` varchar(255) NOT NULL,
  `activist_support_type_other` text NOT NULL,
  `activist_places` varchar(255) NOT NULL,
  `activist_fname` varchar(100) NOT NULL,
  `activist_lname` varchar(100) NOT NULL,
  `activist_email` varchar(100) NOT NULL,
  `activist_phone` int(100) NOT NULL,
  PRIMARY KEY `activist_ID` (`activist_ID`),
  UNIQUE KEY `activist_UUID` (`activist_UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
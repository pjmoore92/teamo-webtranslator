-- --------------------------------------------------------
-- USE TO CREATE A FRESH SET OF TABLES 
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `claddach_igni348`
--

-- --------------------------------------------------------
--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customerID` int(11) NOT NULL auto_increment,
  `fullName` text NOT NULL,
  `title` enum('Mr','Mrs','Ms') NOT NULL,
  `email` text NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  `referenceStr` varchar(8) NOT NULL,
  PRIMARY KEY  (`customerID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `documentID` int(11) NOT NULL auto_increment,
  `filePath` varchar(256) NOT NULL,
  PRIMARY KEY  (`documentID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `jobID` int(11) NOT NULL auto_increment,
  `customerID` int(11) NOT NULL,
  `status` enum('QuoteReq','QuoteSent','QuoteAccept','QuoteDeclined','Paid','Translated','Complete') NOT NULL,
  `quote` int(10) NOT NULL,
  `dateRequested` date NOT NULL,
  `dateDue` date NOT NULL,
  `fromLanguage` text NOT NULL,
  `toLanguage` text NOT NULL,
  `urgent` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`jobID`),
  KEY `idx_jobs` (`customerID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE jobs
ADD FOREIGN KEY (customerID) REFERENCES customer(customerID);

-- --------------------------------------------------------
--
-- Table structure for table `translation`
--

CREATE TABLE IF NOT EXISTS `translation` (
  `translationID` int(11) NOT NULL auto_increment,
  `jobID` int(11) NOT NULL,
  `origDoc` int(11) NOT NULL,
  `translatedDoc` int(11) NOT NULL,
  PRIMARY KEY  (`translationID`),
  KEY `idx_translation` (`jobID`),
  KEY `idx_translation_1` (`origDoc`),
  KEY `idx_translation_2` (`translatedDoc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE translation 
ADD FOREIGN KEY (jobID) REFERENCES jobs(jobID);

-- --------------------------------------------------------
--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `note` (
  `noteID` int(11) NOT NULL auto_increment,
  `jobID` int(11) NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  PRIMARY KEY (`noteID`),
  KEY `idx_note` (`jobID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE note
ADD FOREIGN KEY (jobID) REFERENCES jobs(jobID);

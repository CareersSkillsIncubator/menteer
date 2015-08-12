# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 50.57.219.49 (MySQL 5.1.61-log)
# Database: 936640_menteer
# Generation Time: 2015-02-25 10:07:16 -0500
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(80) DEFAULT NULL,
  `description` text,
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `event` text,
  `position` int(11) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table matches_ended
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matches_ended`;

CREATE TABLE `matches_ended` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mentee_id` int(11) DEFAULT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table matches_revoked
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matches_revoked`;

CREATE TABLE `matches_revoked` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mentee_id` int(11) DEFAULT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table meetings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meetings`;

CREATE TABLE `meetings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `meeting_subject` varchar(200) NOT NULL DEFAULT '',
  `meeting_desc` text NOT NULL,
  `month` varchar(80) NOT NULL DEFAULT '',
  `day` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `start_time` varchar(20) NOT NULL DEFAULT '',
  `start_ampm` varchar(2) NOT NULL DEFAULT '',
  `end_time` varchar(20) NOT NULL DEFAULT '',
  `end_ampm` varchar(2) NOT NULL DEFAULT '',
  `stamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table questionnaire
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questionnaire`;

CREATE TABLE `questionnaire` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` text,
  `type` varchar(60) DEFAULT NULL,
  `position` int(11) DEFAULT '0',
  `importance` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table questionnaire_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questionnaire_answers`;

CREATE TABLE `questionnaire_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(11) DEFAULT NULL,
  `answer` text,
  `position` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`,`ip_address`,`user_agent`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table survey
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey`;

CREATE TABLE `survey` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` text,
  `is_active` int(11) DEFAULT '0',
  `survey_parent` int(11) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table survey_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_answers`;

CREATE TABLE `survey_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `question` text,
  `answer` text,
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `task` text,
  `position` int(11) DEFAULT '0',
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `frm_data` text,
  `is_setup` int(11) DEFAULT '0',
  `agree` int(11) DEFAULT '0',
  `menteer_type` int(11) DEFAULT NULL,
  `is_matched` int(11) DEFAULT '0',
  `match_status` varchar(80) DEFAULT 'pending',
  `match_status_stamp` datetime DEFAULT NULL,
  `privacy_settings` varchar(200) DEFAULT '1,1,1',
  `location` varchar(200) DEFAULT NULL,
  `career_status` text,
  `career_goals` text,
  `education` text,
  `experience` text,
  `skills` text,
  `passion` text,
  `picture` text,
  `enabled` int(11) DEFAULT '1',
  `num_messages_sent` int(11) DEFAULT '0',
  `hidden` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_answers`;

CREATE TABLE `users_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `questionnaire_id` int(11) DEFAULT NULL,
  `questionnaire_answer_id` int(11) DEFAULT NULL,
  `questionnaire_answer_text` text,
  `enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Stored procedures
# ------------------------------------------------------------
DROP PROCEDURE IF EXISTS `User_GetUserInfoToExport`;

CREATE PROCEDURE `User_GetUserInfoToExport`(pUser_id int)
BEGIN
  SELECT  u.id,
    first_name,
    last_name,
    active,
    email,
    CASE menteer_type WHEN 38 THEN "Mentee" WHEN 37 THEN "Mentor" END as menteer_type ,
    is_matched ,
    match_status,
    career_status,
    education,
    experience,
    skills,
    passion,
    u.enabled,    
    q.question,
    if( qa.id is null, ua.questionnaire_answer_text, qa.answer) as answer
FROM users u
inner join users_answers ua on u.id = ua.user_id
left JOIN questionnaire q on ua.questionnaire_id = q.id
left JOIN questionnaire_answers qa on qa.id = ua.questionnaire_answer_id
WHERE u.id = pUser_id ;

END;

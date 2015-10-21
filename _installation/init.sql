CREATE DATABASE IF NOT EXISTS `sw_portal`;

USE `sw_portal`;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `swp_user_id` varchar(67) COLLATE utf8_unicode_ci NOT NULL COMMENT 'snow watch portal user''s id, unique',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `swp_user_id` (`swp_user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';


CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `photo_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'snow watch photo''s id reference',
  `review_comment` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'review''s comment text',
  `review_rating` tinyint(4) NOT NULL COMMENT 'reviews''s rating stars',
  `user_id` int(11) NOT NULL COMMENT 'user''s id reference',
  `review_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'reviews''s createion date',
  PRIMARY KEY (`review_id`),
  KEY `fk_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='comment data';
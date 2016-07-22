# PHP-Track-Code-Louisville
Blog Project for PHP track.

The following thre sql table must get added to mysql in order for this sites functionality to work properly:

CREATE TABLE `pos_blog` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `blog_comments` varchar(220) DEFAULT NULL,
 `reply` varchar(220) DEFAULT NULL,
 `approve` tinyint(5) NOT NULL,
 `user_id` int(11) NOT NULL,
 UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1

CREATE TABLE `pos_member` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(50) NOT NULL,
 `last_name` varchar(100) NOT NULL,
 `email` varchar(150) NOT NULL,
 `comments` text,
 `username` varchar(120) NOT NULL DEFAULT 'username',
 `approve` tinyint(5) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1

CREATE TABLE `pos_response` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `blog_id` int(11) NOT NULL,
 `name` varchar(255) NOT NULL,
 `response` text NOT NULL,
 `resp` varchar(255) NOT NULL,
 `user_id` int(11) NOT NULL,
 `username` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1



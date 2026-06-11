-- Overhill Junior School DB Backup
-- Generated: 2026-06-11 22:06:18

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `full_name` varchar(120) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` VALUES('1','kakyobridgetkim@gmail.com','NABULYA BRIDGET','$2y$10$tR2EJfFSyZtNTiaEOswn1.y3tJFK95Q/JS9FzRwaJePWvnGNUs..S','2026-06-11 21:32:34','2026-06-11 12:06:00','2026-06-11 21:32:34');

DROP TABLE IF EXISTS `admissions`;
CREATE TABLE `admissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(150) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `parent_name` varchar(150) NOT NULL,
  `parent_contact` varchar(40) NOT NULL,
  `parent_email` varchar(150) DEFAULT NULL,
  `previous_school` varchar(200) DEFAULT NULL,
  `desired_class` varchar(80) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `status` enum('pending','reviewing','accepted','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `downloads`;
CREATE TABLE `downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `category` varchar(120) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `email_logs`;
CREATE TABLE `email_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  `status` enum('sent','failed') NOT NULL,
  `error_message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `event_date` date NOT NULL,
  `event_time` time DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `gallery_albums`;
CREATE TABLE `gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gallery_albums` VALUES('1','Just','just-87eb','My arms','uploads/images/7e4f4bef9a54e4a2_1781177575.jpg','2026-06-11 14:32:55','2026-06-11 15:55:31');

DROP TABLE IF EXISTS `gallery_images`;
CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_gallery_album` (`album_id`),
  CONSTRAINT `fk_gallery_album` FOREIGN KEY (`album_id`) REFERENCES `gallery_albums` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gallery_images` VALUES('1','1','uploads/images/57c793bd871d6b63_1781177608.webp','Enough is Enough','2026-06-11 14:33:28');

DROP TABLE IF EXISTS `hero_slides`;
CREATE TABLE `hero_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `heading` varchar(200) DEFAULT NULL,
  `subheading` varchar(300) DEFAULT NULL,
  `button_text` varchar(80) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hero_slides` VALUES('1','images/hero1.jpg','Welcome to Overhill Junior School','Nurturing confident, curious learners for a bright future.','Apply for Admission','admission-information.html','1','1','2026-06-11 21:59:49','2026-06-11 21:59:49');
INSERT INTO `hero_slides` VALUES('2','images/hero2.jpg','Quality Education','Providing the best foundation for your child.','Our Facilities','facilities.html','2','1','2026-06-11 21:59:49','2026-06-11 21:59:49');
INSERT INTO `hero_slides` VALUES('3','images/hero3.jpg','Extracurricular Excellence','Developing talents beyond the classroom.','Learn More','special-programmes.html','3','1','2026-06-11 21:59:49','2026-06-11 21:59:49');

DROP TABLE IF EXISTS `leadership`;
CREATE TABLE `leadership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `excerpt` varchar(400) DEFAULT NULL,
  `body` mediumtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `site_settings` VALUES('1','school_name','Overhill Junior School','2026-06-11 11:49:16');
INSERT INTO `site_settings` VALUES('2','phone','+256 752 913759','2026-06-11 11:49:16');
INSERT INTO `site_settings` VALUES('3','email','info@overhilljunior.ac.ug','2026-06-11 11:49:16');
INSERT INTO `site_settings` VALUES('4','address','Wakiso, Uganda','2026-06-11 11:49:16');
INSERT INTO `site_settings` VALUES('5','motto','Education for Life','2026-06-11 11:49:16');
INSERT INTO `site_settings` VALUES('6','site_logo','images/logo.png','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('7','facebook_url','#','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('8','twitter_url','#','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('9','instagram_url','#','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('10','youtube_url','#','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('11','office_hours','Mon - Fri: 8:00 AM - 5:00 PM','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('12','welcome_message','Overhill Junior School is a private primary and nursery school founded in 2024...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('13','history','Overhill Junior School was officially opened in 2024...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('14','vision','To be a leading center of excellence...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('15','mission','To provide quality, affordable education...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('16','core_values','Integrity, Excellence, Innovation...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('17','proprietor_name','Mdm. Nabulya Bridget','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('18','proprietor_message','Welcome to Overhill...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('19','chairman_name','Mr. John Doe','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('20','chairman_message','We are committed...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('21','headteacher_name','Ms. Jane Smith','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('22','headteacher_message','Education is the key...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('23','years_count','1','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('24','pupils_count','200','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('25','teachers_count','15','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('26','clubs_count','5','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('27','school_anthem','The Overhill Anthem...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('28','anthem_verse_1','Verse 1 text...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('29','anthem_verse_2','Verse 2 text...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('30','anthem_chorus','Chorus text...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('31','school_prayer','Our Father...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('32','prayer_text','School prayer text...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('33','school_rules','Respect everyone...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('34','parent_guidelines','Attend meetings...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('35','communication_policy','Letters, emails...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('36','student_leadership','Prefects body...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('37','student_welfare','Health and safety...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('38','student_articles','Write for us...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('39','why_overhill_intro','Discover what makes Overhill...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('40','facilities_intro','Modern facilities...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('41','parents_intro','Information for parents...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('42','students_intro','Information for students...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('43','programmes_intro','Special programmes...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('44','news_events_intro','Stay updated...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('45','facility_nursery_content','Nursery section details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('46','facility_primary_content','Primary section details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('47','facility_library_content','Library details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('48','facility_computer_lab_content','Computer lab details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('49','facility_science_lab_content','Science lab details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('50','facility_hall_content','Multipurpose hall details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('51','facility_sick_bay_content','Sick bay details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('52','facility_kitchen_content','Kitchen details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('53','facility_transport_content','Transport details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('54','facility_sports_content','Sports details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('55','facility_washrooms_content','Washroom details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('56','programme_computer_content','Computer lessons details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('57','programme_reading_content','Reading programme details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('58','programme_handwriting_content','Handwriting programme details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('59','programme_games_content','Games and sports details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('60','programme_vocational_content','Vocational skills details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('61','programme_daycare_content','Day care details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('62','programme_cocurricular_content','Co-curricular details...','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('63','quick_card_1_title','Admissions Open','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('64','quick_card_1_text','Enrol your child for Nursery and Primary. Simple steps, friendly process.','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('65','quick_card_2_title','Our Curriculum','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('66','quick_card_2_text','A holistic, child-centred curriculum building strong foundations.','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('67','quick_card_3_title','Co-Curricular','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('68','quick_card_3_text','Sports, clubs, music and vocational skills for well-rounded learners.','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('69','quick_card_4_title','Visit Our Campus','2026-06-11 21:59:49');
INSERT INTO `site_settings` VALUES('70','quick_card_4_text','Located in Wakiso. Come and experience Overhill for yourself.','2026-06-11 21:59:49');

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `department` varchar(120) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


SET FOREIGN_KEY_CHECKS=1;

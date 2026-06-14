-- =====================================================================
-- Overhill Junior School - MySQL schema
-- Run this in phpMyAdmin or:  mysql -u root -p < config/schema.sql
-- =====================================================================
CREATE DATABASE IF NOT EXISTS `overhill_school`
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `overhill_school`;

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) NOT NULL UNIQUE,
  full_name VARCHAR(120) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  last_login DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(220) NOT NULL UNIQUE,
  excerpt VARCHAR(400) NULL,
  body MEDIUMTEXT NOT NULL,
  image VARCHAR(255) NULL,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  published_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  description TEXT NULL,
  location VARCHAR(200) NULL,
  event_date DATE NOT NULL,
  event_time TIME NULL,
  image VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(150) NOT NULL,
  date_of_birth DATE NULL,
  gender ENUM('Male','Female','Other') NULL,
  parent_name VARCHAR(150) NOT NULL,
  parent_contact VARCHAR(40) NOT NULL,
  parent_email VARCHAR(150) NULL,
  previous_school VARCHAR(200) NULL,
  desired_class VARCHAR(80) NOT NULL,
  document VARCHAR(255) NULL,
  status ENUM('pending','reviewing','accepted','rejected') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS staff (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  position VARCHAR(150) NOT NULL,
  department VARCHAR(120) NULL,
  bio TEXT NULL,
  photo VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS leadership (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  title VARCHAR(150) NOT NULL,
  message TEXT NULL,
  photo VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS gallery_albums (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(220) NOT NULL UNIQUE,
  description TEXT NULL,
  cover_image VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS gallery_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  album_id INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  caption VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_gallery_album FOREIGN KEY (album_id)
    REFERENCES gallery_albums(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS downloads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  category VARCHAR(120) NULL,
  file VARCHAR(255) NOT NULL,
  file_size INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(40) NULL,
  subject VARCHAR(200) NULL,
  message TEXT NOT NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS hero_slides (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) NOT NULL,
  heading VARCHAR(200) NULL,
  subheading VARCHAR(300) NULL,
  button_text VARCHAR(80) NULL,
  button_link VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS announcements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  body TEXT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS site_settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(100) NOT NULL UNIQUE,
  setting_value TEXT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS email_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  recipient VARCHAR(255) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  body MEDIUMTEXT NOT NULL,
  status ENUM('sent', 'failed') NOT NULL,
  error_message TEXT NULL,
  sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT IGNORE INTO site_settings (setting_key, setting_value) VALUES
  ('school_name', 'Overhill Junior School'),
  ('site_logo', 'images/logo.jpeg'),
  ('phone', '+256 752 913 759'),
  ('email', 'overhilljuniorschool@gmail.com'),
  ('address', 'Wakiso, Uganda'),
  ('motto', 'Knowledge Is Power'),
  ('facebook_url', '#'),
  ('twitter_url', '#'),
  ('instagram_url', '#'),
  ('youtube_url', '#'),
  ('office_hours', 'Mon - Fri: 8:00 AM - 5:00 PM'),
  ('welcome_message', 'Overhill Junior School is a private primary and nursery school founded in 2024...'),
  ('history', 'Overhill Junior School was officially opened in 2024...'),
  ('vision', 'To be a leading center of excellence...'),
  ('mission', 'To provide quality, affordable education...'),
  ('core_values', 'Integrity, Excellence, Innovation...'),
  ('proprietor_name', 'Mdm. Nabulya Bridget'),
  ('proprietor_message', 'Welcome to Overhill...'),
  ('chairman_name', 'Mr. John Doe'),
  ('chairman_message', 'We are committed...'),
  ('headteacher_name', 'Ms. Jane Smith'),
  ('headteacher_message', 'Education is the key...'),
  ('years_count', '1'),
  ('pupils_count', '200'),
  ('teachers_count', '15'),
  ('clubs_count', '5'),
  ('school_anthem', 'The Overhill Anthem...'),
  ('anthem_verse_1', 'Verse 1 text...'),
  ('anthem_verse_2', 'Verse 2 text...'),
  ('anthem_chorus', 'Chorus text...'),
  ('school_prayer', 'Our Father...'),
  ('prayer_text', 'School prayer text...'),
  ('school_rules', 'Respect everyone...'),
  ('parent_guidelines', 'Attend meetings...'),
  ('communication_policy', 'Letters, emails...'),
  ('student_leadership', 'Prefects body...'),
  ('student_welfare', 'Health and safety...'),
  ('student_articles', 'Write for us...'),
  ('why_overhill_intro', 'Discover what makes Overhill...'),
  ('facilities_intro', 'Modern facilities...'),
  ('parents_intro', 'Information for parents...'),
  ('students_intro', 'Information for students...'),
  ('programmes_intro', 'Special programmes...'),
  ('news_events_intro', 'Stay updated...'),
  ('facility_nursery_content', 'Nursery section details...'),
  ('facility_primary_content', 'Primary section details...'),
  ('facility_library_content', 'Library details...'),
  ('facility_computer_lab_content', 'Computer lab details...'),
  ('facility_science_lab_content', 'Science lab details...'),
  ('facility_hall_content', 'Multipurpose hall details...'),
  ('facility_sick_bay_content', 'Sick bay details...'),
  ('facility_kitchen_content', 'Kitchen details...'),
  ('facility_transport_content', 'Transport details...'),
  ('facility_sports_content', 'Sports details...'),
  ('facility_washrooms_content', 'Washroom details...'),
  ('programme_computer_content', 'Computer lessons details...'),
  ('programme_reading_content', 'Reading programme details...'),
  ('programme_handwriting_content', 'Handwriting programme details...'),
  ('programme_games_content', 'Games and sports details...'),
  ('programme_vocational_content', 'Vocational skills details...'),
  ('programme_daycare_content', 'Day care details...'),
  ('programme_cocurricular_content', 'Co-curricular details...'),
  ('quick_card_1_title', 'Admissions Open'),
  ('quick_card_1_text', 'Enrol your child for Nursery and Primary. Simple steps, friendly process.'),
  ('quick_card_2_title', 'Our Curriculum'),
  ('quick_card_2_text', 'A holistic, child-centred curriculum building strong foundations.'),
  ('quick_card_3_title', 'Co-Curricular'),
  ('quick_card_3_text', 'Sports, clubs, music and vocational skills for well-rounded learners.'),
  ('quick_card_4_title', 'Visit Our Campus'),
  ('quick_card_4_text', 'Located in Wakiso. Come and experience Overhill for yourself.');

-- Default Hero Slides
INSERT IGNORE INTO hero_slides (image, heading, subheading, button_text, button_link, sort_order) VALUES
  ('images/hero1.jpg', 'Welcome to Overhill Junior School', 'Nurturing confident, curious learners for a bright future.', 'Apply for Admission', 'admission-information.php', 1),
  ('images/hero2.jpg', 'Quality Education', 'Providing the best foundation for your child.', 'Our Facilities', 'facilities.php', 2),
  ('images/hero3.jpg', 'Extracurricular Excellence', 'Developing talents beyond the classroom.', 'Learn More', 'special-programmes.php', 3);

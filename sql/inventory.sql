CREATE DATABASE inventory

CREATE TABLE users (
   user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
   user_name VARCHAR(255) NOT NULL,
   user_email VARCHAR(255) NOT NULL,
   user_pwd VARCHAR(255) NOT NULL,
   user_type ENUM('', 'Admin', 'Other') NOT NULL,
   register_date DATE NOT NULL,
   last_login DATE NOT NULL,
   notes VARCHAR(255) NOT NULL
 );
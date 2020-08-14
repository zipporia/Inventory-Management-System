CREATE DATABASE inventory

CREATE TABLE users (
   user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
   user_name VARCHAR(255) NOT NULL,
   user_email VARCHAR(255) UNIQUE NOT NULL,
   user_pwd VARCHAR(255) NOT NULL,
   user_type ENUM('Admin', 'Other') NOT NULL,
   register_date DATE NOT NULL,
   last_login DATE NOT NULL,
   notes VARCHAR(255) NOT NULL
 );

 CREATE TABLE categories(
   cid int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   parent_cat int(11) NOT NULL,
   category_name VARCHAR(255) UNIQUE NOT NULL,
   status ENUM('1','0') NOT NULL
 );

 CREATE TABLE brands(
   bid int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   brand_name VARCHAR(255) UNIQUE NOT NULL,
   status ENUM('1', '0') NOT NULL
 );

 CREATE TABLE products(
   pid int(11) AUTO_INCREMENT NOT NULL,
   pcid int(11) NOT NULL,
   pbid int(11) NOT NULL,
   product_name VARCHAR(255) NOT NULL,
   product_price DOUBLE NOT NULL,
   product_stock INT(11) NOT NULL,
   added_date DATE NOT NULL,
   p_status ENUM('1', '0') NOT NULL,
   PRIMARY KEY(pid),
   UNIQUE KEY(product_name),
   FOREIGN KEY(pcid) REFERENCES categories(cid),
   FOREIGN KEY(pbid) REFERENCES brands(bid)
 );
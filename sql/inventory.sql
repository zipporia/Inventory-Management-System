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


CREATE TABLE invoice(
  invoice_no INT(11) PRIMARY KEY AUTO_INCREMENT,
  customer_name VARCHAR(100) NOT NULL,
  order_date DATE NOT NULL,
  sub_total DOUBLE NOT NULL,
  gst DOUBLE NOT NULL,
  discount DOUBLE NOT NULL,
  net_total DOUBLE NOT NULL,
  paid DOUBLE NOT NULL,
  due DOUBLE NOT NULL,
  payment_type TEXT(20) NOT NULL
);

CREATE TABLE invoice_details(
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  invoice_no INT(11) NOT NULL,
  product_name VARCHAR(100) NOT NULL,
  price DOUBLE NOT NULL,
  qty INT(11) NOT NULL,
  FOREIGN KEY (invoice_no) REFERENCES invoice(invoice_no)
);

 SELECT 
 p.category_name as Parent, 
 c.category_name as Child, 
 p.status 
 FROM categories p 
 LEFT JOIN categories c 
 ON p.parent_cat=c.cid

 
 SELECT p.product_name, c.category_name, b.brand_name, p.product_price, p.product_stock, p.added_date, p.p_status 
 FROM products p, brands b, categories c 
 WHERE p.pid = b.bid AND p.pcid = c.cid
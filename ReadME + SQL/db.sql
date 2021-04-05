CREATE TABLE `account` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `account_fname` varchar(30) NULL,
  `account_lname` varchar(30) NULL,
  `account_address` varchar(50) NULL,
  `account_phone` char(10) NULL,
  `account_role` int(1) NOT NULL,
  PRIMARY KEY (username)
);

CREATE TABLE `category` (
  `category_id` int(5) AUTO_INCREMENT NOT NULL,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (category_id)
);

CREATE TABLE `book` (
  `book_id` int(15) AUTO_INCREMENT NOT NULL,
  `book_type` int(5) NOT NULL,
  `book_name` varchar(30) NOT NULL,
  `book_author` varchar(30) NOT NULL,
  `book_pic` mediumblob NOT NULL,
  `book_price` int(5) NOT NULL,
  `book_des` varchar(1000) NULL,
  `book_stock` int(10) NULL,
  PRIMARY KEY (book_id),
  FOREIGN KEY (book_type) REFERENCES category(category_id)
);

CREATE TABLE `transection` (
  `sell_id` int(15) AUTO_INCREMENT NOT NULL,
  `sender` varchar(30) NOT NULL,
  `transection_status` varchar(30) NOT NULL,
  `pracel_id` varchar(20) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `transection_slip` mediumblob DEFAULT NULL,
  `book_id` int(15),
  `username` varchar(15) NOT NULL,
  PRIMARY KEY (sell_id),
  FOREIGN KEY (book_id) REFERENCES book(book_id),
  FOREIGN KEY (username) REFERENCES account(username)
);

CREATE TABLE `promotion` (
  `promotion_id` int(15) AUTO_INCREMENT NOT NULL,
  `promotion_pic` mediumblob NOT NULL,
  `promotion_name` varchar(30) NOT NULL,
   PRIMARY KEY (promotion_id)
);

INSERT INTO `account` (`username`, `password`, `account_fname`, `account_lname`, `account_address`, `account_phone`, `account_role`) VALUES
('admin', 'admin', 'chai', 'chan', '196/1', '0999999999', '0'),
('as', 'as', 'as', 'as', 'as', 'as', '1');

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'การ์ตูน'),
(2, 'บันเทิง'),
(3, 'นิยาย'),
(4, 'แรงบันดาลใจ');



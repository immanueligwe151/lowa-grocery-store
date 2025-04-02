USE x6g22;

CREATE TABLE `Customers` (
    customer_id VARCHAR(8) PRIMARY KEY,
	customer_name VARCHAR(100) NOT NULL,
	customer_email VARCHAR(100) UNIQUE NOT NULL,
	customer_phone VARCHAR(13) NOT NULL,
	customer_password VARCHAR(255) NOT NULL
);

CREATE TABLE `Orders` (
	order_id VARCHAR(8) PRIMARY KEY,
    customer_id VARCHAR(8) NOT NULL,
	date_of_order DATE NOT NULL,
	time_of_order TIME NOT NULL,
	total_price FLOAT NOT NULL,
	pickup BOOLEAN,
	delivery_address VARCHAR(50),
	postcode VARCHAR(10),
    FOREIGN KEY (customer_id) REFERENCES `Customers`(customer_id)
);

CREATE TABLE `Category` (
	category_name VARCHAR(20) PRIMARY KEY,
    category_imagelink VARCHAR(200) NOT NULL
);

CREATE TABLE `CategoryItems` (
	item_name VARCHAR(20) PRIMARY KEY,
    category_name VARCHAR(20) NOT NULL,
	item_imagelink VARCHAR(200) NOT NULL,
	item_price FLOAT NOT NULL,
    FOREIGN KEY (category_name) REFERENCES `Category`(category_name)
);

CREATE TABLE `OrderItems` (
	item_id int PRIMARY KEY AUTO_INCREMENT,
    order_id VARCHAR(8) NOT NULL,
	item_name VARCHAR(20) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES `Orders`(order_id),
    FOREIGN KEY (item_name) REFERENCES `CategoryItems`(item_name)
);

INSERT INTO `Category` VALUES (
	'Vegetables',
    'https://i.postimg.cc/9FVvwmQn/vegetables-photo.jpg'
);

INSERT INTO `Category` VALUES (
	'Meat',
    'https://i.postimg.cc/zDTsfb8h/meat-photo.jpg'
);

INSERT INTO `CategoryItems` VALUES (
	'Carrot',
    'Vegetables',
    'https://i.postimg.cc/8cgxHDBs/carrot-photo.jpg',
    1.65
);

INSERT INTO `CategoryItems` VALUES (
	'Corn on the cob',
    'Vegetables',
    'https://i.postimg.cc/FsZwjMfs/corn-on-the-cob.jpg',
    2.45
);

INSERT INTO `CategoryItems` VALUES (
	'Cucumber',
    'Vegetables',
    'https://i.postimg.cc/5y5TKGng/cucumber-photo.jpg',
    1.99
);

INSERT INTO `CategoryItems` VALUES (
	'Lamb chops',
    'Meat',
    'https://i.postimg.cc/N0V3KRK6/lamb-photo.jpg',
    3.19
);

INSERT INTO `CategoryItems` VALUES (
	'Chicken',
    'Meat',
    'https://i.postimg.cc/3RvPmWGP/chicken-photo.jpg',
    3.99
);

INSERT INTO `CategoryItems` VALUES (
	'Steak',
    'Meat',
    'https://i.postimg.cc/R0NrCgZC/steak-photo.jpg',
    3.99
);
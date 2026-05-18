CREATE DATABASE IF NOT EXISTS clothing_store;

USE clothing_store;

DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255),
    role ENUM('admin','customer') DEFAULT 'customer'
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    size_chart TEXT,
    category VARCHAR(50),
    gender VARCHAR(20),
    price DOUBLE,
    stock INT,
    image VARCHAR(255)
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT
);

INSERT INTO products
(name, description, size_chart, category, gender, price, stock, image)
VALUES
('Casual Shirt', 'Comfortable cotton shirt', 'M,L,XL', 'Shirts', 'Men', 1200, 10, 'shirt.jpg'),
('Blue Jeans', 'Stylish denim jeans', '30,32,34', 'Jeans', 'Men', 1800, 8, 'jeans.jpg'),
('Women Salwar', 'Elegant salwar suit', 'S,M,L', 'Salwar', 'Women', 2200, 5, 'salwar.jpg');
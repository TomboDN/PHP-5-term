CREATE DATABASE IF NOT EXISTS appDB default charset utf8;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT, UPDATE, INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
SET NAMES utf8;
CREATE TABLE IF NOT EXISTS users
(
    id       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name     VARCHAR(100)    NOT NULL,
    password VARCHAR(100)    NOT NULL,
    role     VARCHAR(10)     NOT NULL
);
CREATE TABLE IF NOT EXISTS products
(
    id          INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name        VARCHAR(100)    NOT NULL,
    volume      VARCHAR(100)    NOT NULL,
    description VARCHAR(100),
    price       INT             NOT NULL,
    created     DATETIME
);


INSERT INTO users (name, password, role)
VALUES ('Daniil', '12345', 'user'),
       ('User', 'qwerty', 'user');

INSERT INTO products (name, volume, price)
VALUES ('Американо', '250 мл', 100),
       ('Латте', '250 мл', 120),
       ('Капучино', '250 мл', 140),
       ('Айс Кофе', '250 мл', 160),
       ('Фильтр-кофе', '250 мл', 180),
       ('Эспрессо', '150 мл', 100),
       ('Фраппе', '250 мл', 200),
       ('Гляссе', '200 мл', 220);
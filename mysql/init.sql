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
CREATE TABLE IF NOT EXISTS menu
(
    id     INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name   VARCHAR(100)    NOT NULL,
    weight VARCHAR(100)    NOT NULL,
    cost   INT             NOT NULL
);


INSERT INTO users (name, password, role)
VALUES ('Daniil', '12345', 'admin'),
       ('Ivan', 'qwerty', 'user');

INSERT INTO menu (name, weight, cost)
VALUES ('Американо', '150 мл', 100),
       ('Латте', '150 мл', 120),
       ('Капучино', '200 мл', 170),
       ('Раф классический', '300 мл', 200),
       ('Латте Соленая карамель', '300 мл', 250),
       ('Эспрессо', '30 мл', 75),
       ('Миндальный фраппе', '450 мл', 300),
       ('Латте "Клубника-персик"', '300 мл', 270);
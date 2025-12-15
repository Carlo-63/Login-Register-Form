CREATE DATABASE social;

CREATE TABLE accounts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(40) NOT NULL,
    lname VARCHAR(40) NOT NULL,
    username VARCHAR(40) NOT NULL UNIQUE,
    passwd VARCHAR(255) NOT NULL,
    accountType ENUM('User', 'Admin') NOT NULL DEFAULT 'User'
);
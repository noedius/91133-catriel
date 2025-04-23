create database estoque;

use estoque;

CREATE TABLE produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    produto VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    quantidade INT NOT NULL
);
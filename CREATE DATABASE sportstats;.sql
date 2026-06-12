CREATE DATABASE sportstats;

USE sportstats;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    password VARCHAR(255),
    rol VARCHAR(20)
);

CREATE TABLE jugadores(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    deporte VARCHAR(50),
    equipo VARCHAR(100),
    estadistica VARCHAR(100)
);
CREATE DATABASE IF NOT EXISTS conekta
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;



CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    usuario VARCHAR(50) NOT NULL UNIQUE,

    correo VARCHAR(150) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    foto_perfil VARCHAR(255) DEFAULT NULL,

    biografia VARCHAR(255) DEFAULT NULL,

    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    estado ENUM('activo','bloqueado')
        DEFAULT 'activo'
);
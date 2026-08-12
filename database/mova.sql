CREATE DATABASE IF NOT EXISTS mova
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE mova;

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    usuario VARCHAR(50) NOT NULL UNIQUE,

    correo VARCHAR(150) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    foto_perfil VARCHAR(255) DEFAULT NULL,

    biografia VARCHAR(255) DEFAULT NULL,

    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    estado ENUM('activo', 'bloqueado') DEFAULT 'activo'
) ENGINE=InnoDB;

CREATE TABLE publicaciones (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT UNSIGNED NOT NULL,

    contenido TEXT NOT NULL,

    imagen VARCHAR(255) DEFAULT NULL,

    tipo ENUM(
        'texto',
        'imagen',
        'evento',
        'encuesta'
    ) NOT NULL DEFAULT 'texto',

    fecha_publicacion TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    fecha_actualizacion TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    estado ENUM(
        'publicada',
        'oculta',
        'eliminada'
    ) NOT NULL DEFAULT 'publicada',

    CONSTRAINT fk_publicacion_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
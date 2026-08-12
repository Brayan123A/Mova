<?php

$host = "localhost";
$usuario_db = "root";
$password_db = "";
$nombre_db = "mova";

$conexion = new mysqli(
    $host,
    $usuario_db,
    $password_db,
    $nombre_db
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");
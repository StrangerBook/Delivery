<?php
$usuario = 'root';
$senha = '';
$database = 'cadastro';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar ao MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    // echo "Conexão bem-sucedida!";
}
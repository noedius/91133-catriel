<?php

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    header("Location: http://localhost/app/index.html");
    exit;
}

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'estoque';

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}
?>



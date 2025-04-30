<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redireciona para a página inicial se for acesso direto
    header("Location: http://localhost:8081/app/index.html");
    exit;
}

include 'conexao.php';

$produto = $_POST['produto'];
$tipo = $_POST['tipo'];
$quantidade = $_POST['quantidade'];

$sql = "INSERT INTO produtos (produto, tipo, quantidade) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $produto, $tipo, $quantidade);

$stmt->execute();
$stmt->close();

?>
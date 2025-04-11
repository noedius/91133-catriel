<?php

$conn = new mysqli("localhost", "root", "", "contatos");
$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];


$sql = "INSERT INTO contatos (nome, telefone, email) VALUES ('$nome', '$telefone', '$email')";
if (mysqli_query($conn, $sql)) {
    echo "<script> alert('Contato adicionado com sucesso!'); window.location.href='cad_usuario.html'; </script>";
}else{
    echo "Erro ao cadastrar";
}

mysqli_close($conn);
?>
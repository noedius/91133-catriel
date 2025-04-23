<?php

session_start();
include 'conexao.php';

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {

    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']); 

    if (empty($usuario) || empty($senha)){
        echo "<script>
                alert('Por favor, preencha todos os campos.');
                window.location.href ='index.html';
            </script>";
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = password(?)");
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $_SESSION ['usuario'] = $usuario;
        echo "<script>
                alert('Login Realizado.');
                window.location.href = 'http://localhost/app/cad.html';
            </script>";
    } else {
        echo "<script>
                alert('Usuário ou senha incorretos.')
                ; window.location.href ='http://localhost/app';
            </script>";
    }

    $stmt->close();
    $conn->close();
    exit;
}else{
    header('Location: http://localhost/app/index.html');
    exit;
}
?>
    
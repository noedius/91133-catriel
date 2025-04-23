<?php

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){

    header("Location: http://localhost/app/index.html");
    exit;
}

include 'autenticar.php';

include 'conexao.php';

include 'insere.php';

include '/view/conecta.php';


echo "<script>
    alert('Cadastro realizado');
    window.location.href = 'http://localhost/app/index.html';
</script>";
?>
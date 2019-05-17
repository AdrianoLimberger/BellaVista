<?php

error_reporting(0);

session_start();

if ($_SESSION['logado'] !== true) {
    if (!isset($_GET['cadastrarCliente']))
        header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <link rel="stylesheet" href="menu.css">
</head>

<body>

    <header class="header-menu">
        <ul>
            <li><a href="consultas.php">Consultas</a></li>
            <li><a href="dadosPessoais.php">Dados pessoais</a></li>
            <li class="li-sair"><a href="sair.php">Sair</a></li>
        </ul>
    </header>

</body>

</html>
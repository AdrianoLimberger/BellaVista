<?php

include_once 'model/cliente.php';
include_once 'model/planoSaude.php';
include_once 'dao/conexao.php';
include_once 'dao/clienteDAO.php';

$cliente = ClienteDAO::login($_POST['cpf'], $_POST['senha']);

if ($cliente == null) {

    echo '<script>window.history.back();</script>';
} else {

    session_start();
    $_SESSION['logado'] = true;
    $_SESSION['cpf'] = $cliente->getCpf();
    $_SESSION['nome'] = $cliente->getNome();
    $_SESSION['idade'] = $cliente->getIdade();
    $_SESSION['planoSaude'] = $cliente->getPlanoSaude()->getNome();

    header("Location: consultas.php");
}

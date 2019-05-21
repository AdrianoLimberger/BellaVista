<?php

include_once '../model/senhaPadrao.php';
include_once 'conexao.php';

class SenhaPadraoDAO {

    public static function getSenha() {

        $sql = "SELECT senha FROM senhapadrao";

        $result = Conexao::consultar($sql);

        $dados = mysqli_fetch_assoc($result);

        return $dados['senha'];

    }

}
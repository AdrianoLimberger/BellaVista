<?php

include_once '../model/cliente.php';
include_once '../model/planoSaude.php';
include_once 'conexao.php';

class ClienteDAO
{

    public static function inserir($cliente)
    {
        $sql = "INSERT INTO clientes (cpf, nome, idade, senha, fkPlanoSaude)"
            . "VALUES"
            . "("
            . "'" . $cliente->getCpf() . "', "
            . "'" . $cliente->getNome() . "', "
            . $cliente->getIdade() . ", "
            . "'" . $cliente->getSenha() . "', "
            . "'" . $cliente->getPlanoSaude()->getNome() . "'"
            . ")";

        Conexao::executar($sql);
    }

    public static function editar($cliente)
    {
        $sql = "UPDATE clientes SET"
            . " nome = '" . $cliente->getNome() . "',"
            . " cpf = '" . $cliente->getCpf() . "',"
            . " idade = '" . $cliente->getIdade() . "',"
            . " fkPlanoSaude = '" . $cliente->getPlanoSaude()->getNome() . "'"
            . " WHERE cpf = '" . $cliente->getCpf() . "'";

        Conexao::executar($sql);
    }

    public static function login($cpf, $senha)
    {
        $sql = "SELECT * FROM clientes c"
            . " INNER JOIN planossaude p ON c.fkPlanoSaude = p.nome"
            . " WHERE c.cpf = '" . $cpf . "'"
            . " AND c.senha = '" . $senha . "'";

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) == 0) {
            return null;
        } else {

            list($cpf, $nome, $idade, $senha, $fkPlanoSaude, $nome2) = mysqli_fetch_row($result);

            $cliente = new Cliente();
            $cliente->setCpf($cpf);
            $cliente->setNome($nome);
            $cliente->setIdade($idade);

            $planoSaude = new PlanoSaude();
            $planoSaude->setNome($nome2);

            $cliente->setPlanoSaude($planoSaude);

            return $cliente;
        }
    }

    public static function getClienteByCpf($cpf)
    {

        $sql = "SELECT * FROM clientes c"
            . " INNER JOIN planossaude p ON c.fkPlanoSaude = p.nome"
            . " WHERE c.cpf = '" . $cpf . "'";

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) <= 0) {
            return null;
        } else {

            list($cpf, $nome, $idade, $senha, $fkPlanoSaude, $nome2) = mysqli_fetch_row($result);

            $cliente = new Cliente();
            $cliente->setCpf($cpf);
            $cliente->setNome($nome);
            $cliente->setIdade($idade);

            $planoSaude = new PlanoSaude();
            $planoSaude->setNome($nome2);

            $cliente->setPlanoSaude($planoSaude);

            return $cliente;
        }
    }

    public static function getPlanoSaude($cpf)
    {

        $sql = "SELECT fkPlanoSaude FROM clientes c"
            . " WHERE c.cpf = '" . $cpf . "'";

        $result = Conexao::consultar($sql);

        $dados = mysqli_fetch_assoc($result);

        return $dados['fkPlanoSaude'];

    }
}

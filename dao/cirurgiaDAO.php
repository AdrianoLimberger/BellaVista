<?php

include_once '../model/cirurgia.php';
include_once 'conexao.php';

class cirurgiaDAO
{

    public static function inserir($cirurgia)
    {

        $sql = "INSERT INTO cirurgias (nome, preco) VALUES"
            . "("
            . "'" . $cirurgia->getNome() . "',"
            . $cirurgia->getPreco()
            . ")";

        Conexao::executar($sql);
    }

    public static function editar($cirurgia)
    {

        $sql = "UPDATE cirurgias SET"
            . " nome = '" . $cirurgia->getNome() . "',"
            . " preco = " . $cirurgia->getPreco()
            . " WHERE nome = '" . $cirurgia->getNome() . "'";

        Conexao::executar($sql);
    }

    public static function getCirurgias()
    {

        $sql = "SELECT * FROM cirurgias";

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) == 0) {
            return null;
        } else {

            $lista = new ArrayObject();

            while (list($nome, $preco) = mysqli_fetch_row($result)) {

                $cirurgia = new Cirurgia();
                $cirurgia->setNome($nome);
                $cirurgia->setPreco($preco);

                $lista->append($cirurgia);
            }

            return $lista;
        }
    }

    public static function getCirurgiaByNome($nome)
    {

        $sql = "SELECT * FROM cirurgias WHERE nome = '" . $nome . "'";

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) == 0) {
            return null;
        } else {

            list($nome, $preco) = mysqli_fetch_row($result);

            $cirurgia = new Cirurgia();
            $cirurgia->setNome($nome);
            $cirurgia->setPreco($preco);

            return $cirurgia;
        }
    }
}

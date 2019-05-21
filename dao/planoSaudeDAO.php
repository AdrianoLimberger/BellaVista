<?php

error_reporting(0);

include_once '../model/planoSaude.php';
include_once 'conexao.php';

class planoSaudeDAO
{

    public static function inserir($planoSaude)
    {
        $sql = "INSERT INTO planosSaude (nome) VALUES"
            . " ("
            . "'" . $planoSaude->getNome() . "'"
            . ")";

        Conexao::executar($sql);
    }

    public static function getPlanosSaude()
    {
        $sql = "SELECT * FROM planossaude";

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) > 0) {

            $lista = new ArrayObject();

            while (list($nome) = mysqli_fetch_row($result)) {

                if ($nome == 'SUS' || $nome == 'Particular')
                    continue;
                else {
                    $planoSaude = new PlanoSaude();
                    $planoSaude->setNome($nome);

                    $lista->append($planoSaude);
                }
            }
            return $lista;
        } else {

            return null;
        }
    }
}

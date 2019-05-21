<?php

include_once '../model/planoSaude.php';
include_once '../model/cirurgia.php';
include_once '../model/cliente.php';
include_once '../model/consulta.php';
include_once 'conexao.php';

class consultaDAO
{

    public static function inserir($consulta)
    {

        $sql = "INSERT INTO consultas (data, horario, pagamento, fkPlanoSaude, fkCirurgia, fkCliente) VALUES"
            . " ("
            . "'" . $consulta->getData() . "',"
            . "'" . $consulta->getHorario() . "',"
            . " '" . $consulta->getPagamento() . "',"
            . " '" . $consulta->getPlanoSaude()->getNome() . "',"
            . " '" . $consulta->getCirurgia()->getNome() . "',"
            . " '" . $consulta->getCliente()->getCpf() . "'"
            . ")";

        Conexao::executar($sql);
    }

    public static function editar($consulta)
    {

        $sql = "UPDATE consultas SET"
            . " data = '" . $consulta->getData() . "',"
            . " horario = '" . $consulta->getHorario() . "',"
            . " pagamento = '" . $consulta->getPagamento() . "',"
            . " fkPlanoSaude = '" . $consulta->getPlanoSaude()->getNome() . "',"
            . " fkCirurgia = '" . $consulta->getCirurgia()->getNome() . "',"
            . " fkCliente = '" . $consulta->getCliente()->getCpf() . "'"
            . " WHERE codigo = " . $consulta->getCodigo();

        Conexao::executar($sql);
    }

    public static function getConsultasByCpf($cpf)
    {

        $sql = "SELECT * FROM consultas con"
            . " INNER JOIN planossaude p ON con.fkPlanoSaude = p.nome"
            . " INNER JOIN cirurgias cir ON con.fkCirurgia = cir.nome"
            . " INNER JOIN clientes cli ON con.fkCliente = cli.cpf"
            . " WHERE cli.cpf = '" . $cpf . "'";

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) == 0) {
            return null;
        } else {

            $lista = new ArrayObject();

            while (list(
                $conCodigo, $conData, $conHorario, $conPagamento, $conFkPlanoSaude, $conFkCirurgia, $conFkCliente,
                $pNome, $cirNome, $cirPreco, $cliCpf, $cliNome, $cliIdade, $cliSenha, $cliFkPlanoSaude
            )
                = mysqli_fetch_row($result)
            ) {

                $consulta = new Consulta();
                $consulta->setCodigo($conCodigo);
                $consulta->setData($conData);
                $consulta->setHorario($conHorario);
                $consulta->setPagamento($conPagamento);

                $planoSaude = new PlanoSaude();
                $planoSaude->setNome($pNome);

                $consulta->setPlanoSaude($planoSaude);

                $cirurgia = new Cirurgia();
                $cirurgia->setNome($cirNome);
                $cirurgia->setPreco($cirPreco);

                $consulta->setCirurgia($cirurgia);

                $cliente = new Cliente();
                $cliente->setCpf($cliCpf);
                $cliente->setNome($cliNome);
                $cliente->setIdade($cliIdade);

                $planoSaude = new PlanoSaude();
                $planoSaude->setNome($cliFkPlanoSaude);

                $cliente->setPlanoSaude($planoSaude);

                $consulta->setCliente($cliente);

                $lista->append($consulta);
            }

            return $lista;
        }
    }

    public static function getConsultaByCodigo($codigo)
    {

        $sql = "SELECT * FROM consultas con"
            . " INNER JOIN planossaude p ON con.fkPlanoSaude = p.nome"
            . " INNER JOIN cirurgias cir ON con.fkCirurgia = cir.nome"
            . " INNER JOIN clientes cli ON con.fkCliente = cli.cpf"
            . " WHERE con.codigo = " . $codigo;

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) == 0) {
            return null;
        } else {

            list(
                $conCodigo, $conData, $conHorario, $conPagamento, $conFkPlanoSaude, $conFkCirurgia, $conFkCliente,
                $pNome, $cirNome, $cirPreco, $cliCpf, $cliNome, $cliIdade, $cliSenha, $cliFkPlanoSaude
            )
                = mysqli_fetch_row($result);

            $consulta = new Consulta();
            $consulta->setCodigo($conCodigo);
            $consulta->setData($conData);
            $consulta->setHorario($conHorario);
            $consulta->setPagamento($conPagamento);

            $planoSaude = new PlanoSaude();
            $planoSaude->setNome($conFkPlanoSaude);

            $consulta->setPlanoSaude($planoSaude);

            $cirurgia = new Cirurgia();
            $cirurgia->setNome($cirNome);
            $cirurgia->setPreco($cirPreco);

            $consulta->setCirurgia($cirurgia);

            return $consulta;
        }
    }

    public static function verificar($data, $horario) {

        $sql = "SELECT * FROM consultas WHERE"
            . " data = '" . $data . "'"
            . " AND horario = '" . $horario . "'";

        $result = Conexao::consultar($sql);

        if (mysqli_num_rows($result) == 0)
            return false;
        else
            return true;
    }
}

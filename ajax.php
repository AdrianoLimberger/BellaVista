<?php

include_once 'model/planoSaude.php';
include_once 'model/cirurgia.php';
include_once 'model/cliente.php';
include_once 'model/consulta.php';
include_once 'dao/conexao.php';
include_once 'dao/planoSaudeDAO.php';
include_once 'dao/cirurgiaDAO.php';
include_once 'dao/clienteDAO.php';
include_once 'dao/consultaDAO.php';

if (isset($_GET['getConsultas'])) {

    $consultas = consultaDAO::getConsultasByCpf($_POST['cpf']);

    $lista = [];

    $i = 0;

    if ($consultas == null) {
        $lista = null;
    } else {
        foreach ($consultas as $consulta) {

            $lista['codigo' . $i] = $consulta->getCodigo();
            $lista['data' . $i] = $consulta->getData();
            $lista['horario' . $i] = $consulta->getHorario();
            $lista['pagamento' . $i] = $consulta->getPagamento();

            $lista['planoSaudeNome' . $i] = $consulta->getPlanoSaude()->getNome();
            $lista['cirurgiaNome' . $i] = $consulta->getCirurgia()->getNome();
            $lista['cirurgiaPreco' . $i] = $consulta->getCirurgia()->getPreco();

            $lista['clienteCpf' . $i] = $consulta->getCliente()->getCpf();
            $lista['clienteNome' . $i] = $consulta->getCliente()->getNome();
            $lista['clienteIdade' . $i] = $consulta->getCliente()->getIdade();

            $i++;
        }

        $lista['contador'] = $consultas->count();
    }

    echo json_encode($lista);
} else if (isset($_GET['verificarAgendarConsulta'])) {

    $verificar = consultaDAO::verificar($_POST['data'], $_POST['horario']);

    echo json_encode($verificar);

}

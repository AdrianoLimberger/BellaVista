<?php

error_reporting(0);

session_start();

if ($_SESSION['logado'] === true && !isset($_GET['editar']))
    header("Location: dadosPessoais.php");
else if ($_SESSION['logado'] !== true && isset($_GET['editar']))
    header("Location: login.php");
else if ($_GET['cpf'] != $_SESSION['cpf'])
    header("Location: dadosPessoais.php");
else {

    error_reporting(0);

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="cadastrarCliente.css">

        <title>Cadastrar cliente</title>
    </head>

    <body>

        <?php

        include_once 'model/cliente.php';
        include_once 'model/planoSaude.php';
        include_once 'dao/conexao.php';
        include_once 'dao/clienteDAO.php';
        include_once 'dao/planoSaudeDAO.php';

        if ($_SESSION['logado'] === true)
            require_once 'menu.php';

        $nome = '';
        $cpf = '';
        $idade = '';
        $planoSaude = '';
        $action = 'inserir';

        if (isset($_GET['editar']) && $_GET['cpf'] == $_SESSION['cpf']) {

            if ($_SESSION['logado'] === true) {

                $cliente = ClienteDAO::getClienteByCpf($_GET['cpf']);

                $nome = $cliente->getNome();
                $cpf = $cliente->getCpf();
                $idade = $cliente->getIdade();
                $planoSaude = $cliente->getPlanoSaude()->getNome();

                $action = "editar&cpf=" . $cpf;
            } else {
                header("Location: index.php");
            }
        }

        ?>

        <div class="div-form">
            <h1>Clínica Bella Vista</h1>

            <form action="controller/salvarCliente.php?<?php echo $action; ?>" method="POST">
                <div class="div-text-align-center">
                    <input type="text" name="nome" value="<?php echo $nome; ?>" id="input-nome-completo" class="form-input-text" required>
                    <label for="input-nome-completo" class="form-label">Nome completo</label>
                </div>

                <div class="div-text-align-center">
                    <input type="text" name="cpf" value="<?php echo $cpf; ?>" id="input-cpf" class="form-input-text" required>
                    <label for="input-cpf" class="form-label">CPF</label>
                </div>

                <div class="div-text-align-center">
                    <input type="text" name="idade" value="<?php echo $idade; ?>" id="input-idade" class="form-input-text" required>
                    <label for="input-idade" class="form-label">Idade</label>
                </div>

                <div class="div-plano-saude">

                    <?php

                    $checkedSus = '';
                    $checkedConvenio = '';
                    $checkedParticular = '';

                    if ($planoSaude == 'SUS')
                        $checkedSus = 'checked';
                    else if ($planoSaude == 'Convênio')
                        $checkedConvenio = 'checked';
                    else if ($planoSaude != '')
                        $checkedParticular = 'checked';

                    ?>

                    <label>
                        <input type="radio" name="tipo" <?php echo $checkedSus; ?> value="SUS">
                        SUS
                        <span></span>
                    </label>

                    <label>
                        <input type="radio" name="tipo" <?php echo $checkedConvenio; ?> value="Convênio">
                        Convênio
                        <span></span>
                    </label>

                    <label>
                        <input type="radio" name="tipo" <?php echo $checkedParticular; ?> value="Particular">
                        Particular
                        <span></span>
                    </label>
                </div>

                <div class="div-select">
                    <h2>Plano</h2>
                    <select name="plano">
                        <?php

                        $lista = planoSaudeDAO::getPlanosSaude();

                        if ($lista->count() == 0) {
                            echo '<option>Nenhum plano cadastrado</option>';
                        } else {
                            echo '<option>Selecione...</option>';

                            foreach ($lista as $plano) {

                                $selected = '';

                                if ($plano->getNome() == $planoSaude)
                                    $selected = 'selected';

                                echo '<option value="' . $plano->getNome() . '" ' . $selected . '>' . $plano->getNome() . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="div-text-align-center">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
        </div>

        <script src="jquery-3.3.1.js"></script>
        <script src="jquery.mask.min.js"></script>
        <script src="cadastrarCliente.js"></script>

        <?php if ($planoSaude != '') { ?>

            <script>
                setPlanoSaude("<?php echo $planoSaude; ?>");
            </script>

        <?php } ?>

        <?php if ($planoSaude != '' && $planoSaude != 'SUS' && $planoSaude != 'Particular') { ?>

            <script>
                showPlanosSaude();
            </script>

        <?php } ?>

    </body>

    </html>

<?php

}

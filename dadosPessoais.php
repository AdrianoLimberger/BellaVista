<?php

session_start();

if ($_SESSION['logado'] !== true) {
    header("Location: login.php");
} else {

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dados pessoais</title>

        <link rel="stylesheet" href="dadosPessoais.css">
    </head>

    <body>

        <?php

        require_once 'menu.php';

        ?>

        <div class="div-container">
            <a href="cadastrarCliente.php?editar&cpf=<?php echo $_SESSION['cpf']; ?>">
                <img src="img/icones/editar.png" alt="">
            </a>

            <div class="div-dados-pessoais">
                <div class="div-dados-pessoais">
                    <h2>Nome</h2>
                    <p><?php echo $_SESSION['nome']; ?></p>
                </div>
            </div>

            <div class="div-dados-pessoais">
                <div class="div-dados-pessoais">
                    <h2>CPF</h2>
                    <p><?php echo $_SESSION['cpf']; ?></p>
                </div>
            </div>

            <div class="div-dados-pessoais">
                <div class="div-dados-pessoais">
                    <h2>Idade</h2>
                    <p><?php echo $_SESSION['idade']; ?></p>
                </div>
            </div>

            <div class="div-dados-pessoais">
                <div class="div-dados-pessoais">
                    <h2>Plano de saúde</h2>
                    <p><?php echo $_SESSION['planoSaude']; ?></p>
                </div>
            </div>
        </div>

    </body>

    </html>

<?php

}

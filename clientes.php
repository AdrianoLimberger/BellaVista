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
        <title>Clientes</title>

        <link rel="stylesheet" href="clientes.css">
    </head>

    <body>

        <?php

        require_once 'menu.php';

        ?>

        <div>
            <a href="cadastrarCliente.php" class="btn-cadastrar">
                Cadastrar cliente
            </a>
        </div>

    </body>

    </html>

<?php

}

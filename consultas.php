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
        <title>Consultas</title>

        <link rel="stylesheet" href="consultas.css">
    </head>

    <body>

        <?php

        require_once 'menu.php';

        ?>

        <div>
            <a href="agendarConsulta.php" class="btn-agendar">
                Agendar consulta
            </a>
        </div>

        <div id="div-container"></div>

        <script src="jquery-3.3.1.js"></script>
        <script src="consultas.js"></script>

        <script>
            setCpf("<?php echo $_SESSION['cpf']; ?>");
        </script>

    </body>

    </html>

<?php

}

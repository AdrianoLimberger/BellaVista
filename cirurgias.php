<?php

session_start();

if ($_SESSION['logado'] !== true) {
    header("Location: index.php");
} else {

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cirurgias</title>

        <link rel="stylesheet" href="cirurgias.css">
    </head>

    <body>

        <?php

        require_once 'menu.php';

        ?>


    </body>

    </html>

<?php

}

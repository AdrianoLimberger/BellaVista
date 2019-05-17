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
        <title>Cadastrar plano de saúde</title>

        <link rel="stylesheet" href="cadastrarPlanoSaude.css">
    </head>

    <body>

        <div class="div-form">

            <h1>Cadastro de plano de saúde</h1>

            <form action="controller/salvarPlanoSaude.php?inserir" method="POST">
                <div>
                    <label for="input-nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="input-nome" class="form-input-text">
                </div>
                <input type="submit" value="Entrar">
            </form>
        </div>

        <script src="jquery-3.3.1.js"></script>
    </body>

    </html>

<?php

}

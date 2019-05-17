<?php

error_reporting(0);

session_start();

if ($_SESSION['logado'] === true) {
    header("Location: consultas.php");
} else {

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="index.css">

        <title>Login</title>
    </head>

    <body>

        <div class="div-form">

            <h1>Bella Vista</h1>

            <form action="entrar.php" method="POST">
                <div>
                    <label for="input-cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="input-cpf" class="form-input-text">
                </div>

                <div>
                    <label for="input-senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="input-senha" class="form-input-text">
                </div>

                <input type="submit" value="Entrar">

                <h6>Não é cliente ainda? <a href="cadastrarCliente.php">Cadastre-se</a> agora!</h6>
            </form>
        </div>

        <script src="jquery-3.3.1.js"></script>
        <script src="jquery.mask.min.js"></script>
        <script src="index.js"></script>
    </body>

    </html>

<?php

}

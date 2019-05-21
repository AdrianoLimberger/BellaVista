<?php

session_start();

unset($_SESSION['logado']);
unset($_SESSION['cpf']);
unset($_SESSION['nome']);
unset($_SESSION['idade']);
unset($_SESSION['planoSaude']);

session_destroy();

header("Location: login.php");
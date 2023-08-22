<?php
// Função para verificar se o usuário está logado
function verificarLogin() {
    // Inicia a sessão
    session_start();

    // Verifica se a variável de sessão 'loggedin' está definida e é verdadeira
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        // O usuário não está logado, redireciona para a página de login
        header("Location: /login.php");
        exit();
    }
}


function exibirNome() {
    // Exibe o nome do usuário que está logado
    if (isset($_SESSION["username"])) {
        echo "<br>Bem-vindo, " . $_SESSION["username"] . "!";
    } else {
        echo "Erro: Nome de usuário não definido na sessão.";
    }
}

?>
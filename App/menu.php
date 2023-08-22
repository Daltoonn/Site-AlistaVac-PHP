<?php
require_once "Back-End/config.php";
require_once "Back-End/func-menulogin.php";
require_once "padrao_projeto/Observer.php"; //arquivo com a implementação do padrão Observer

// Verifica se a sessão já foi iniciada, se não, inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado antes de permitir o acesso
verificarLogin();

//exibir o nome do usuario
exibirNome();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Front-End/css/menu.css">
    <title>Menu</title>
</head>
<body>

   
    <nav>   
        <div class="retangulo">
            <div class="texto-nav">AlistaVac</div>
        </div>
    </nav>

    
</div>

    <div class="nixo1"> <p class="item-nixo1"><a href="historico-vac.php">Historico de Vacinações</a></p></div></div>
    <div class="nixo2"> <p class="item-nixo2"><a href="registra-vac.php">Registrar Vacina</a></p></div></div>
    <div class="nixo3"> <p class="item-nixo3"><a href="posto-saude.php">Localização Postos <br> de Saude</a></p></div></div>
    <div class="nixo4"> <p class="item-nixo4"><a href="./Back-End/func-logout.php">Sair</a></div></div></div>


    <div class="quadrado">  Última vacina registrada/tomada
    <?php
    // Verifica se há alguma notificação disponível para exibir
    if (isset($_SESSION['notification'])) {
        echo '<div class="bloco-notificacao">';
        echo '<img src="Front-End/img/vacinado.png" alt="Vacina">';
        echo $_SESSION['notification'];
        //unset($_SESSION['notification']); // Limpa a notificação após exibir
    }
    ?>
</body>
</html>


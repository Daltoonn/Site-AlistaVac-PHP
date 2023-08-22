<?php
// Inicia a sessão. é bao fazer isso para evitar que de problema, dessa forma vamos garantir que vai pegar todos os dados e sair
session_start();

// Destruir a sessão
session_destroy();

// Redirecionar o usuário para a página de login após o logout
header("Location:  /index.php");
exit();
?>
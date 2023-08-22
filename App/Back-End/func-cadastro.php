<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtem os dados enviados pelo formulário
    $usuario = $_POST["username"];
    $senha = $_POST["password"];

    // Validação básica 
    if (empty($usuario) || empty($senha)) {
        die("Preencha todos os campos.");
    }

    // Inclui o arquivo com as configurações do banco de dados
    require_once "config.php";

    // Cria a conexão com o banco de dados
    $conexao = Database::getInstance();
    $conexao = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Verifica se o usuário já está registrado
    $consulta = "SELECT * FROM usuarios WHERE username = '$usuario'";
    $resultado = mysqli_query($conexao, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        mysqli_close($conexao);
        die("Este usuário já está registrado. Escolha outro nome de usuário.");
    }

    // Insere o novo usuário no banco de dados
    $inserir = "INSERT INTO usuarios (username, password) VALUES ('$usuario', '$senha')";
    if (mysqli_query($conexao, $inserir)) {
        mysqli_close($conexao);
        echo "Registro bem-sucedido. Faça o login <a href='/login.php'>aqui</a>.";
        exit();
    } else {
        mysqli_close($conexao);
        die("Erro ao registrar o usuário: " . mysqli_error($conexao));
    }
}
?>
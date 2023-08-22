<?php
// Função para fazer login
function conectarAoBancoDeDados() {
    require_once "config.php";
    $conexao = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }
    return $conexao;
}

function fazerLogin($usuario, $senha, $conexao) {
    $consulta = "SELECT * FROM usuarios WHERE username = '$usuario'";
    $resultado = mysqli_query($conexao, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuarioInfo = mysqli_fetch_assoc($resultado);
        if ($senha === $usuarioInfo['password']) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $usuarioInfo["username"];
            mysqli_close($conexao);
            return true;
        }
    }

    mysqli_close($conexao);
    return false;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtem os dados enviados pelo formulário
    $usuario = $_POST["username"];
    $senha = $_POST["password"];

    // Validação básica (você pode adicionar mais validações conforme necessário)
    if (empty($usuario) || empty($senha)) {
        die("Preencha todos os campos.");
    }

    // Chama a função para fazer login
    if (fazerLogin($usuario, $senha, conectarAoBancoDeDados())) {
        session_start();
        $_SESSION['loggedin'] = true;
        header("Location: /menu.php");
        exit(); // Certifique-se de encerrar o script após o redirecionamento
    } else {
        echo "Usuário ou senha incorretos. Tente novamente.";
    }
}
?>


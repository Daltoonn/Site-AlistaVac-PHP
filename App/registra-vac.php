<?php
require_once "Back-End/config.php";
require_once "padrao_projeto/Observer.php";
require_once "Back-End/func-menulogin.php";

// Verifica se a sessão já foi iniciada, se não, inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
verificarLogin();

// Classe RegistroVacinaObservable
class RegistroVacinaObservable {
    private $observers = array();

    public function addObserver(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function notifyObservers(string $fabricante, string $nome_vacina, int $dose) {
        foreach ($this->observers as $observer) {
            $observer->update($fabricante, $nome_vacina, $dose);
        }
    }
}

// Criando uma instância do observer (menu)
$menuObserver = new MenuObserver();
// Criando uma instância do sujeito observado (RegistroVacinaObservable)
$registroVacinaObservable = new RegistroVacinaObservable();
// Adiciona o observer (menu) ao sujeito observado
$registroVacinaObservable->addObserver($menuObserver);

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtem os dados enviados pelo formulário
    $conexao = Database::getInstance()->db_connect(); // Obtém a conexão do Database

    $fabricante = $conexao->real_escape_string($_POST["fabricante"]);
    $nome_vacina = $conexao->real_escape_string($_POST["nome_vacina"]);
    $dose = $conexao->real_escape_string($_POST["dose"]);
    $data = $conexao->real_escape_string(date("Y-m-d", strtotime($_POST["data"])));

    // Verifica se a variável "username" está definida na sessão
    if (!isset($_SESSION["username"])) {
        // Caso a sessão "username" não esteja definida, redireciona para a página de login
        header("Location: /login.php");
        exit();
    }

    $username = $_SESSION["username"];

    // Consulta SQL para inserir os dados na tabela vacinas
    $consulta = "INSERT INTO vacinas (fabricante, nome_vacina, dose, data, username) 
                 VALUES ('$fabricante', '$nome_vacina', $dose, '$data', '$username')";

    // Executa a consulta
    $resultado = $conexao->query($consulta);

    /// Verifica se a inserção foi bem-sucedida
    if ($resultado) {
        // Notifica o observer (menu) com a mensagem das últimas vacinas registradas
        $registroVacinaObservable->notifyObservers($fabricante, $nome_vacina, $dose);
        $_SESSION['notification'] = "Fabricante: $fabricante<br>Nome da Vacina: $nome_vacina<br>Dose: $dose";

        header("Location: menu.php");
        exit();
    } else {
        echo "Erro ao registrar a vacina. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Registro de Vacina</title>
    <link rel="stylesheet" href="/Front-End/css/registro-vac.css">
</head>
<body>

    <nav>   
        <div class="retangulo">
            <div class="texto-nav">AlistaVac</div>
        </div>
    </nav>

    <h2>Formulário de Registro de Vacina</h2>
    <form action="registra-vac.php" method="post">
        <label class="fabricante"  for="fabricante">Fabricante:</label>
        <input class="fabricante-input" type="text" name="fabricante" required><br>

        <label class="nome_vacina" for="nome_vacina">Nome da Vacina:</label>
        <input class="nome_vacina-input" type="text" name="nome_vacina" required><br>

        <label class="dose" for="dose">Dose:</label>
        <input class="dose-input" type="number" name="dose" required><br>

        <label class="data" for="data">Data da Vacinação:</label>
        <input class="data-input" type="date" name="data" required><br>

        <input class="Botao" type="submit" value="Registrar">
    </form>
    <p><a href="menu.php">Voltar para o Menu</a></p>
</body>
</html>

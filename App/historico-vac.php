<?php
require_once "Back-End/func-menulogin.php";
require_once "Back-End/config.php";

// Verifica se o usuário está logado antes de permitir o acesso
verificarLogin();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Front-End/css/historico.css">
    <title>Historico</title>
</head>
<body>

    <nav>   
        <div class="retangulo">
            <div class="texto-nav">AlistaVac</div>
        </div>
    </nav>

    <div> <h1>Historico de vacinação!</h1></div>

    <p><a href="menu.php">Voltar para o Menu</a></p>
    
    

    
<?php
    
    // Recupere o nome do usuário logado
    $username = $_SESSION['username'];

    // Cria a conexão com o banco de dados
    $conexao = Database::getInstance();
    $conexao = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Consulta para obter o histórico de vacinação do usuário
    $sql = "SELECT fabricante, nome_vacina, dose, data FROM vacinas WHERE username = '$username'";

    //funcao do filtro aquiiii
    if (isset($_POST['limpar'])) {
        // Se o usuário clicou no botão "Limpar", remove qualquer filtro de ano
        $sql = "SELECT fabricante, nome_vacina, dose, data FROM vacinas WHERE username = '$username'";
    } elseif (isset($_POST['buscar'])) {
        $anoEscolhido = $_POST['ano'];
        $sql .= " AND YEAR(data) = $anoEscolhido";
    }



    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        // Exibir os dados do histórico de vacinação em uma tabela
        echo '<table>';
        echo '<tr><th>Fabricante</th><th>Nome da Vacina</th><th>Dose</th><th>Data</th><th>Editar</th><th>Excluir</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['fabricante'] . '</td>';
            echo '<td>' . $row['nome_vacina'] . '</td>';
            echo '<td>' . $row['dose'] . '</td>';
            echo '<td>' . $row['data'] . '</td>';
            echo '<td>' . 'Editar' . '</td>';
            echo '<td>' . 'Excluir' . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p><br><br><br><br><br><br><br><br><br><br><br><br>Nenhum registro encontrado no histórico de vacinação.</p>';
    }



    $conexao->close();

    
?>


    <div> 
    <form method="post">
        <label for="ano"></label>
        <select name="ano" id="ano">
        <option value="" disabled selected>Escolha um ano</option>
            <option value="1998">1998</option>
            <option value="1999">1999</option>
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
            <option value="2003">2003</option>
            <option value="2004">2004</option>
            <option value="2005">2005</option>
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>
        <button class="botao-buscar" type="submit" name="buscar">Buscar</button>
        <button class="botao-limpar" type="submit" name="limpar">Limpar</button> 

    </form>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/Front-End/css/cadastro.css">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>

    
    <nav>   
        <div class="retangulo"></div>
    </nav>

    <h1 class="Titulo-cadastro">CADASTRO</h1>



    <form action="/Back-End/func-cadastro.php" method="post">
        <label class="Nome" for="username">Usuário:</label>
        <input class="input-nome" type="text" name="username" required><br><br>

        <label class="Senha" for="password">Senha:</label>
        <input class="input-Senha" type="password" name="password" required><br><br>

        <input class="botao-eviar" type="submit" value="Registrar">
    </form>
</body>
</html>
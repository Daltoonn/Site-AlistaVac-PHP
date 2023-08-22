<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Front-End/css/loginEstilo.css">
    <title>Login</title>
</head>
<body>
    
    <nav>   
        <div class="retangulo"></div>
    </nav>
  

    <div class="Retangulo-login">
    <form action="Back-End/func-login.php" method="post">

        <h1 class="Titulo-login">LOGIN</h1>
        <label class="login" for="username">Usuário:</label>
        <input  class="input-login" type="text" name="username" required><br><br>

        <label  class="Senha" for="password">Senha:</label>
        <input  class="input-senha" type="password" name="password" required><br><br>

        <input class="Botao" type="submit" value="Entrar">
    </form>
        <br> 
        <h3><a href="cadastro.php">Não tem Uma Conta? Inscrever-se</a></h3>
        

    </div>


    
   




</body>
</html>
<?php
require_once "Back-End/func-cadastro.php";

use PHPUnit\Framework\TestCase;

class TestCadastroUsuario extends TestCase
{

    public function testUsuarioExistente()
    {
        // Inicializar a conexão com o banco de dados
        $conexao = mysqli_connect("localhost", "root", "", "bancoalistavac");
        $this->assertTrue($conexao !== false, "Não foi possível conectar ao banco de dados.");

        // Inserir um usuário de teste para simular o usuário já registrado
        $usuario = "usuario_teste";
        $senha = "senha_teste";
        $inserir = "INSERT INTO usuarios (username, password) VALUES ('$usuario', '$senha')";
        mysqli_query($conexao, $inserir);

        // Simular uma tentativa de registro com o mesmo usuário
        $_POST["username"] = $usuario;
        $_POST["password"] = "outra_senha";

        ob_start();
        require "Back-End/func-cadastro.php";
        $output = ob_get_clean();

        $this->assertEquals("Este usuário já está registrado. Escolha outro nome de usuário.", $output);

        // Limpar o usuário de teste
        $excluir = "DELETE FROM usuarios WHERE username = '$usuario'";
        mysqli_query($conexao, $excluir);

        // Fechar a conexão com o banco de dados
        mysqli_close($conexao);
    }
    

}
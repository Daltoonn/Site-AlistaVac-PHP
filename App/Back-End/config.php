<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "";
$DB_NAME = "bancoalistavac";



class Database {
    private static $instance;

    //garantimos que nao ha conflito e so exista uma so conexao com bd
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    // Função para realizar a conexão com o banco de dados
    function db_connect() {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME;
        $conexao = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
        if (!$conexao) {
            die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
        }
        return $conexao;
    }
}




?>
<?php
abstract class Conexao {
    private static $conexaoDB;

    public static function conecta_db()
    {
        $host  = "mysql:host=localhost;dbname=bd_cadastropessoa;charset=UTF8";
        $user  = "root";
        $senha = "";

        try
        {
            if (!isset(self::$conexaoDB))
            {
                self::$conexaoDB = new PDO($host, $user, $senha);
                self::$conexaoDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$conexaoDB;
        }
        catch (PDOException $exc)
        {
            echo "Erro ao conectar o banco de dados :" . $exc->getMessage();
        }
    }
}
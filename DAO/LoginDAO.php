<?php
//conexao com banco de dados
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/conexao/conexao.php';
//classe de regra de negocio
class LoginDAO
{
    public $pdo = null;

    //chamando a conexao para dentro de pdo
    public function __construct()
    {
        $this->pdo = Conexao::conecta_db();
    }

    //busca um usuario no banco de dados
    function buscaUsuario(PessoaDTO $pessoaDTO)
    {
        try {
            //busca um usuario para comparar a senha
            $sql = "select id_pessoa, login, senha from pessoa where login = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $pessoaDTO->getLogin());
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }
}
<?php
//conexao com banco de dados
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/conexao/conexao.php';
//classe de regra de negocio
class CursoDAO
{
    public $pdo = null;

    //chamando a conexao para dentro de pdo
    public function __construct()
    {
        $this->pdo = Conexao::conecta_db();
    }

    //busca todos os cursos cadastrados no banco de dados
    function buscaCurso()
    {
        try {
            $sql = "select * from curso";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $curso = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $curso;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }

    //
}
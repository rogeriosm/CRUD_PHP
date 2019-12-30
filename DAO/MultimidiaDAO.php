<?php
//conexao com banco de dados
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/conexao/conexao.php';

//configurando horario local sem horario de verao
date_default_timezone_set('America/Sao_Paulo');

class multimidiaDAO
{
    public $pdo = null;

    //chamando a conexao para dentro de pdo
    public function __construct()
    {
        $this->pdo = Conexao::conecta_db();
    }

    //inserindo uma uma imagem
    function insereImagem(MultimidiaDTO $multimidiaDTO){
        try{

        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }

    //buscando uma imagem

    //deletando uma imagem

}
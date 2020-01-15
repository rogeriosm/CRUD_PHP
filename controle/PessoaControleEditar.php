<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/PessoaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/PessoaDAO.php';
//criando uma classe pessoa
$pessoaDto = new PessoaDTO();

//recebendo os valores do post
$pessoaDto->setValores($_POST);

//ligação com o banco de dados
$pessoaDao = new PessoaDAO();

$sucesso = $pessoaDao->editarPessoa($pessoaDto);

if($sucesso){
    //redireciona para pagina principal
    header("location: /crud_php/view/paginasRestritas/Home.php?msgEdit=1");
    exit();
}else{
    //redireciona para pagina principal com mensagem de erro
    header("location: /crud_php/view/paginasRestritas/Home.php");
    exit();
}

<?php
//inicia uma sessão
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/PessoaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/LoginDAO.php';

$pessoaDTO = new PessoaDTO();

//passando os valores recebidos pelo post
$pessoaDTO->setValores($_POST);

$loginDAO = new LoginDAO();

$login = $loginDAO->buscaUsuario($pessoaDTO);

if(password_verify($_POST['senha'], $login['senha'])){
    $_SESSION['login'] = $login['login'];
    $_SESSION['tipo']  = $login['tipo_usuario_id_tipo_usuario'];
    header('location: /crud_php/view/paginasRestritas/Home.php?msglog=1');
}else{
    header('location: /crud_php/view/login.php?msgErrlog=1');
}



<?php
//inicia uma sessão
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/PessoaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/LoginDAO.php';

$login = $_POST['login'];
$senha = $_POST['senha'];

$loginDTO = new PessoaDTO();

$loginDTO->setLogin($login);
$loginDTO->setSenha($senha);

$usuario = new LoginDAO();

$usuarioSenha = $usuario->buscaUsuario($loginDTO);

if(password_verify($senha, $usuarioSenha['senha'])){
    $_SESSION['login'] = $usuarioSenha['login'];
    header('location: /crud_php/view/paginasRestritas/Home.php?msglog=1');
}else{
    header('location: /crud_php/view/login.php?msgErrlog=1');
}



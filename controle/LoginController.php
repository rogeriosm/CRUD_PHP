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

$usuariologado = $usuario->buscaUsuarioLogado($loginDTO);

if(password_verify($senha, $usuariologado['senha'])){

    $_SESSION['login'] = $usuariologado['login'];
    $_SESSION['tipo'] = $usuariologado['tipo_usuario_id_tipo_usuario'];
    header('location: /crud_php/view/paginasRestritas/Home.php?msglog=1');
}else{
    header('location: /crud_php/view/login.php?msgErrlog=1');
}



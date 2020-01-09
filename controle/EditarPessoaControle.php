<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/PessoaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/PessoaDAO.php';

//recebendo os valores do post
$idPessoa           = $_POST['idPessoa'];
$paginaForm         = $_POST['form'];
$nome               = $_POST['nome'];
$apelido            = $_POST['apelido'];
$cpf                = $_POST['cpf'];
$rg                 = $_POST['rg'];
$login              = $_POST['login'];
//senha gerada com a api do php
//se a senha estiver vazia ela nao e alterada no banco de dados
$senha              = (!empty($_POST['senha']))?password_hash($_POST['senha'], PASSWORD_BCRYPT):"";
$telefoneNumero     = $_POST['telefone'];
//cadrastros que nao tenham um usuario logado sao do tipo usuario
$tipoUsuario        = (!isset($_POST['tipoUsuario']))? "1" : $_POST['tipoUsuario'];
$enResidencia       = $_POST['enResidencia'];
$enTrabalho         = $_POST['enTrabalho'];
$email              = $_POST['email'];
$emailSenha         = $_POST['emailSenha'];
$curso              = $_POST['curso'];

//criando uma classe pessoa
$pessoaDto = new PessoaDTO();

$pessoaDto->setIdPessoa($idPessoa);
$pessoaDto->setNome($nome);
$pessoaDto->setApelido($apelido);
$pessoaDto->setCpf($cpf);
$pessoaDto->setRg($rg);
$pessoaDto->setLogin($login);
$pessoaDto->setSenha($senha);
$pessoaDto->setTelefone($telefoneNumero);
$pessoaDto->setTipoUsuario($tipoUsuario);
$pessoaDto->setEnResidencia($enResidencia);
$pessoaDto->setEnTrabalho($enTrabalho);
$pessoaDto->setEmail($email);
$pessoaDto->setEmailSenha($emailSenha);
$pessoaDto->setCurso($curso);

$pessoaDao = new PessoaDAO();

$sucesso = $pessoaDao->editarPessoa($pessoaDto);

if($sucesso){
    //redireciona para pagina principal
    header("location: /crud_php/view/paginasRestritas/Home.php?msgEdit=1");
    exit();
}else{
    //redireciona para pagina edite com mensagem de erro
    header("location: /crud_php/view/paginasRestritas/Home.php");
    exit();
}
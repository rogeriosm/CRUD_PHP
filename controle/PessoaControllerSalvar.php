<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/PessoaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/PessoaDAO.php';

//formulario
$paginaForm = $_POST['form'];

//criando uma pessoa
$pessoaDto = new PessoaDTO();

//setando os dados do formulario
$pessoaDto->setValores($_POST);

//criando uma ligação com o banco de dados
$pessoaDao = new PessoaDAO();

//verifica se o campo login foi preenchido
if (!empty($pessoaDto->getLogin()))
{
    //verifica se ja existe o login no bando de dados para que nao tenha repetição
    $retorno = $pessoaDao->buscarLogin($pessoaDto->getLogin());
    //verifica se retorno login foi setado e redireciona para form com erro
    if (isset($retorno['login'])) {
        header("location: /crud_php/view/FormPessoa.php?form={$paginaForm}&msgErrLogEx=1");
        exit();
    }
}
else
{
    //caso campo login nao tenha sido prenchido redireciona para pagina de formulario
    header("location: /crud_php/view/FormPessoa.php?errFormLog=1&form={$paginaForm}");
    exit();
}

$sucesso = $pessoaDao->salvarPessoa($pessoaDto);

//retorna mensagem de sucesso se cadastrado corretament
if ($sucesso) {

    //se o usuario estiver logado redireciona para pagina de cadastro se nao para home
    switch ($paginaForm) {
        case '1':
            //inicia uma sessão
            session_start();
            $_SESSION['login'] = $pessoaDto->getLogin($login);
            //redireciona para pagina principal
            header("location: /crud_php/view/paginasRestritas/Home.php?msglog=1");
            exit();
            break;
        case '2':
            header("location: /crud_php/view/FormPessoa.php?form={$paginaForm}&msgCadSuc=1");
            exit();
            break;
        case '3':
            header("location: /crud_php/view/paginasRestritas/Home.php?msgEdit=1");
            exit("erro salvarpessoacontrole");
            break;
        default:
            header("location: /crud_php/index.php?erroUrl=1");
            exit();
            break;
    }
} else {
    header("location: /crud_php/view/FormPessoa.php?msgCadErr=1");
    exit();
}

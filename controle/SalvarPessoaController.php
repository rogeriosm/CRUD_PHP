<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/PessoaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/PessoaDAO.php';

//recebendo os valores do post
$paginaForm         = $_POST['form'];
$nome               = $_POST['nome'];
$apelido            = $_POST['apelido'];
$cpf                = $_POST['cpf'];
$rg                 = $_POST['rg'];
$login              = $_POST['login'];
//senha gerada com a api do php
$senha              = password_hash($_POST['senha'], PASSWORD_BCRYPT);
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

//verifica se ja existe o login no bando de dados para que nao tenha repetição
if (!empty($pessoaDto->getLogin($login))) {
    $retorno = $pessoaDao->buscarLogin($pessoaDto);
    if (!empty($retorno['login'])) {
        header("location: /crud_php/view/FormPessoa.php?form={$paginaForm}&msgErrLogEx=1");
        exit();
    }
}else{
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
        default:
            header("location: /crud_php/index.php?erroUrl=1");
            exit();
            break;
    }
} else {
    header("location: /crud_php/view/FormPessoa.php?msgCadErr=1");
    exit();
}


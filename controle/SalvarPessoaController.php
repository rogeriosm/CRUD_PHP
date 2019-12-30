<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/PessoaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/PessoaDAO.php';

//identifica de qual pagina esta vindo o formulario
if(empty($_POST['form'])) {
    //se form estiver vazio precisa ser indicado qual e o formulario
    header("location: /crud_php/index.php?errForm=1");
    exit();
}else{
    $paginaForm = $_POST['form'];
}


$nome               = $_POST['nome'];
$apelido            = $_POST['apelido'];
$cpf                = $_POST['cpf'];
$rg                 = $_POST['rg'];
$login              = $_POST['login'];
//senha gerada com a api do php
$senha              = password_hash($_POST['senha'],PASSWORD_BCRYPT);
$telefoneNumero     = $_POST['telefone'];
//é usado um operador ternario para dizer qual sera o tipo de usuario cadastrado
//se null sera cadastrado usuario padrao outros valores
//so sao recebidos do formulario do administrador
$tipoUsuario        = !isset($_POST['tipoUsuario'])? "1" : $_POST['tipoUsuario'];
$enResidencia       = $_POST['enResidencia'];
$enTrabalho         = $_POST['enTrabalho'];
$email              = $_POST['email'];
$emailSenha         = $_POST['emailSenha'];
$curso              = $_POST['curso'];

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
if (!empty($pessoaDto->getLogin($login)))
{
    $retorno = $pessoaDao->buscarLogin($pessoaDto);
    if (!empty($retorno['login'])){
        header("location: /crud_php/view/FormPessoa.php?form=1&msgErrLogEx=1");
        exit();
    }

}

$sucesso = $pessoaDao->salvarPessoa($pessoaDto);//rever procedure

//retorna mensagem de sucesso se cadastrado corretament
if ($sucesso)
{
    //se o cadastro vinher da pagina principal e um novo cadastro
    //então levar para home direto
    //se o formulario vinher do cadastrar de um usuario logado então
    //ele volta para a pagina de formulario novamente

    switch ($paginaForm){
    case '1':
        //inicia uma sessão
        session_start();
        $_SESSION['login'] = $pessoaDto->getLogin($login);
        //redireciona para pagina principal
        header("location: /crud_php/view/paginasRestritas/Home.php?msglog=1");
        exit();
        break;
    case '2':
        header("location: /crud_php/view/FormPessoa.php?msgCadSuc=1");
        exit();
        break;
    default:
        //se alguem tentar acessar  pagina atraves da url com um valor que nao seja
        //o padrão volta para pagina inicial com o erro
        header("location: /crud_php/index.php?erroUrl=1");
        exit();
    }
}
else
{
    header("location: /crud_php/view/FormPessoa.php?msgCadErr=1");
    exit();
}


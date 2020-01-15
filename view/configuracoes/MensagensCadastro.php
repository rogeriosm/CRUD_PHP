<?php
$arrayMsg = array();
//mensagem de erro: login existente no banco de dados
if (!empty($_GET["msgErrLogEx"]))
{
    echo "<div id='errorCadastro' class='erroMsg'>Login existente!</div>";
}
//mensagem de sucesso ao cadastrar novo usuário
if (!empty($_GET["msgCadSuc"]))
{
    echo "<div id='casdastroSucess' class='sucMsg'>Cadastrado com sucesso!</div>";
}
//mensagem de erro ao cadastrar novo usuário
if (!empty($_GET["msgCadErr"]))
{
    echo "<div id='casdastroErro' class='erroMsg'>Cadastrado com sucesso!</div>";
}
//mensagem de deslogado do sistema
if (!empty($_GET["msgDesl"]))
{
    echo "<div id='logoff' class='sucMsg'> Usuario deslogado com sucesso! </div>";
}
//mensagem de bem vindo ao sistema depois de logado
if (!empty($_GET["msglog"]))
{
    echo "<div id='login' class='sucMsg'> BEM VINDO! </div>";
}
//mensagem de login digitado errado ou inexitente
if (!empty($_GET["msgErrlog"]))
{
    echo "<div id='msgErrlog' class='erroMsg'> senha ou login errado! </div>";
}
//erro por nao ter sido passado um valor 0 ou 1 para pagina SalvarPessoaController
//indentificando de qual formulario esta vindo o cadastro
if (!empty($_GET["errForm"]))
{
    echo "<div id='errForm' class='erroMsg'> não foi possível cadastrar usuário!<br>entre em contato com o administrador do site!</div>";
}
//verifica pagina acessadas por url
if (!empty($_GET["erroUrl"]))
{
    echo "<script> alert('Essas pagina não pode ser acessada!');</script>";
    //echo "<div id='errorlogin' class='erroMsg'> Essas pagina não pode ser acessada!</div>";
}
//retorna um erro por nao conseguir criar uma pasta, pode ser compatibilidade com sistemas do servidor
if (!empty($_GET["errForm"]))
{
    echo "<div id='errForm' class='erroMsg'>Não foi possivel criar a pasta de midia do usuário</div>";
}
//retorna um erro por nao conseguir fazer o upload da imagem ou tentar fazer upload sem imagem
if(!empty($_GET["errUplImg"]))
{
    echo "<div id='errUplImg' class='erroMsg'>Erro no upload de media<br>entre em contato com o administrador do site!</div>";
}
//retorna um erro por nao conseguir fazer o upload da imagem ou tentar fazer upload sem imagem
if(!empty($_GET["errFormAcess"]))
{
    echo "<div id='errFormAcess' class='erroMsg'>Não foi possível cadastrar esse usuário!<br>Informe o administrador!</div>";
}
//retorna um erro por nao conseguir fazer o upload da imagem ou tentar fazer upload sem imagem
if(!empty($_GET["errFormLog"]))
{
    echo "<div id='errFormLog' class='erroMsg'>Não foi possível cadastrar esse usuário!<br>Login obrigatorio!</div>";
}
//retorna um erro por nao conseguir fazer o upload da imagem ou tentar fazer upload sem imagem
if(!empty($_GET["msgExSuc"]))
{
    echo "<div id='excluidoSucesso' class='sucMsg'>Excluido com sucesso.</div>";
}
//retorna sucesso ao alterar cadastro
if(!empty($_GET["msgEdit"]))
{
    echo "<div id='msgEdit' class='sucMsg'>Cadastro alterado com sucesso.</div>";
}
//retorna um erro por nao conseguir fazer o upload da imagem ou tentar fazer upload sem imagem
if(!empty($_GET["msgExErr"]))
{
    echo "<div id='excluidoErro' class='erroMsg'>Erro ao excluir usuário.</div>";
}




//mostrando todas as mensagens que estao dentro do array
//foreach ($arrayMsg as $msg)
//{
//    echo $msg;
//}

?>

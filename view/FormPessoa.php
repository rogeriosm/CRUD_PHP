<!--verifica se o formulario esta sendo chamado de alaguma pagina ou url-->
<!--se for url ele redireciona para index-->
<?php
session_start();
//so permite o cadastro de usuarios nao logados com o tipo usuario
if (!isset($_SESSION['login']) && $_GET['form'] != 1) {
    //form com valores maiores que 1 so podem ser acessados com usuario logado
    //valores negativos caem no defalt da pagina salvar pessoas
    header("location: /crud_php/index.php?erroUrl=1");
    exit("Erro FormPessoa");
}

//importando o controlador responsavel por chamar as funcoes de listar
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/controle/ListarControle.php';
//criando um novo controlador
$controleListar = new ListarControle();

//usa a mesma pagina para editar ou cadastrar um usuario
if (isset($_SESSION['login']) && $_GET['form'] == 3) {
    //se for para editar muda o caminho do post
    $page = "/crud_php/controle/PessoaControleEditar.php";
    //busca um usuario
    $usuarioEdite = $controleListar->buscaUsuario($_GET['idPessoa']);
} else {
    $page = "/crud_php/controle/PessoaControllerSalvar.php";
}

//chamando cursos
$cursos = $controleListar->buscarCursos();
//chamando tipos de usuario
$tipoUsuario = $controleListar->buscarTipoUsuario();

//setando as variaveis vazias se nao tiver valor
$nome           = (empty($usuarioEdite['nome']))            ?""                 :$usuarioEdite['nome'];
$apelido        = (empty($usuarioEdite['apelido']))         ?""                 :$usuarioEdite['apelido'];
$cpf            = (empty($usuarioEdite['cpf']))             ?""                 :$usuarioEdite['cpf'];
$rg             = (empty($usuarioEdite['rg']))              ?""                 :$usuarioEdite['rg'];
$login          = (empty($usuarioEdite['login']))           ?""                 :$usuarioEdite['login'];
$numero         = (empty($usuarioEdite['numero']))          ?""                 :$usuarioEdite['numero'];
$residencial    = (empty($usuarioEdite['residencial']))     ?""                 :$usuarioEdite['residencial'];
$trabalho       = (empty($usuarioEdite['trabalho']))        ?""                 :$usuarioEdite['trabalho'];
$email          = (empty($usuarioEdite['email']))           ?""                 :$usuarioEdite['email'];
$email_senha    = (empty($usuarioEdite['email_senha']))     ?""                 :$usuarioEdite['email_senha'];
$disciplina     = (empty($usuarioEdite['disciplina']))      ?"Ecolha uma opção" :$usuarioEdite['disciplina'];
$id_curso       = (empty($usuarioEdite['id_curso']))        ?""                 :$usuarioEdite['id_curso'];
$descricao      = (empty($usuarioEdite['descricao']))       ?"Ecolha uma opção" :$usuarioEdite['descricao'];
$id_tipoUsuario = (empty($usuarioEdite['id_tipo_usuario'])) ?""                 :$usuarioEdite['id_tipo_usuario'];

?>

<!doctype html>
<html lang="pt-br">
<head>
    <!--configuracoes da pagina-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Crud-PHP</title>
</head>
<body>
<!--mostra mensagens na tela-->
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
    <main>
        <h1>formulario cadastro de pessoa</h1>

        <form action="<?= $page ?>" method="post">

            nome<br>
            <input type="text" name="nome" id="nome" class="input" value="<?=$nome?>"><br>
            apelido <br>
            <input type="text" name="apelido" id="apelido" class="input" value="<?=$apelido?>"><br>
            cpf<br>
            <input type="text" name="cpf" id="cpf" class="input" value="<?=$cpf?>"><br>
            rg<br>
            <input type="text" name="rg" id="rg" class="input" value="<?=$rg?>"><br>
            login<br>
            <input type="text" name="login" id="login" class="input" value="<?=$login?>"><br>
            senha<br>
            <input type="text" name="senha" id="senha" class="input" ><br>
            telefone-numero<br>
            <input type="text" name="telefone" id="telefone" class="input" value="<?=$numero?>"><br>
            Endereço Residencia<br>
            <input type="text" name="enResidencia" id="enResidencia" class="input" value="<?=$residencial?>"><br>
            Endereço trabalho<br>
            <input type="text" name="enTrabalho" id="enTrabalho" class="input" value="<?=$trabalho?>"><br>
            e-mail<br>
            <input type="email" name="email" id="email" class="input" value="<?=$email?>"><br>
            e-mail senha<br>
            <input type="text" name="emailSenha" id="emailSenha" class="input" value="<?=$email_senha?>"><br>
            Curso<br>
            <select name="curso" id="curso" class="input">
                <option value='<?=$id_curso?>'><?=$disciplina?></option>
                <?php
                    foreach ($cursos as $value){
                        echo "<option value='{$value['id_curso']}'>{$value['disciplina']}</option>";
                    }
                ?>
            </select><br>

            <label for='tipoUsuario'> Tipo de usuario </label><br>
            <select class='input' name='tipoUsuario' id='tipoUsuario'>
                <option value='<?=$id_tipoUsuario?>'><?=$descricao?></option>
                <?php
                //opção de cadastrar um usuario ou administrador so aparece quando
                //tiver um usuario logado, por ser so demonstração o cadastro de adm sera
                //liberado para qualquer usuario logado
                    foreach ($tipoUsuario as $value){
                        if (isset($_SESSION['login'])) {
                            echo "<option value='{$value['id_tipo_usuario']}'>{$value['descricao']}</option>";
                        }else if($value['id_tipo_usuario'] == 1){
                            echo "<option value='{$value['id_tipo_usuario']}'>{$value['descricao']}</option>";
                        }
                    }
                    echo "
                </select><br>";
                //mostrando o campo com id do usuario a ser editado somento quando for clicado em editar
                if(isset($_GET['idPessoa']) && $_GET['form'] == 3){
                    echo "<input type='hidden' class='input' name='idPessoa' id='idPessoa' value='{$_GET['idPessoa']}'><br>";
                }
                ?>

            <input type="hidden" class="input" name="form" id="form" value="<?= $_GET['form']; ?>"><br>
            <input type="submit" class="btn btn btn-primary btn-lg" value="Enviar">
        </form>
    </main>
    <footer>
        <a href="/crud_php/view/paginasRestritas/Home.php"><button class="btn btn btn-secondary btn-lg">Home</button></a><br>
        <a href="/crud_php/index.php"><button class="btn btn btn-secondary btn-lg">Index</button></a><br>
    </footer>
</div>
</body>
</html>

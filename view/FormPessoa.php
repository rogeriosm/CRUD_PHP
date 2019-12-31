<!--verifica se o formulario esta sendo chamado de alaguma pagina ou url-->
<!--se for url ele redireciona para index-->
<?php
session_start();
//so permite o cadastro de usuarios nao logados com o codigo 1
if (empty($_GET['form']) || empty($_SESSION['login']) && $_GET['form'] != 1) {
    //form com valores maiores que 1 so podem ser acessados com usuario logado
    //valores negativos caem no defalt da pagina salvar pessoas
    header("location: /crud_php/index.php?erroUrl=1");
    exit("Erro FormPessoa");
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Crud-PHP</title>
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
<h1>formulario cadastro de pessoa</h1>

arrumar formularoip com os campos que estao faltando!
<div class="container">
    <form action="/crud_php/controle/SalvarPessoaController.php" method="post">
        nome<br>
        <input type="text" name="nome" id="nome" class="input"><br>
        apelido <br>
        <input type="text" name="apelido" id="apelido" class="input"><br>
        cpf<br>
        <input type="text" name="cpf" id="cpf" class="input"><br>
        rg<br>
        <input type="text" name="rg" id="rg" class="input"><br>
        login<br>
        <input type="text" name="login" id="login" class="input"><br>
        senha<br>
        <input type="text" name="senha" id="senha" class="input"><br>
        telefone-numero<br>
        <input type="text" name="telefone" id="telefone" class="input"><br>
        Endereço Residencia<br>
        <input type="text" name="enResidencia" id="enResidencia" class="input"><br>
        Endereço trabalho<br>
        <input type="text" name="enTrabalho" id="enTrabalho" class="input"><br>
        e-mail<br>
        <input type="email" name="email" id="email" class="input"><br>
        e-mail senha<br>
        <input type="text" name="emailSenha" id="emailSenha" class="input"><br>
        Curso<br>
        <input type="text" name="curso" id="curso" class="input"><br>

        <?php
        //opção de cadastrar um usuario ou administrador so aparece quando
        //tiver um usuario logado, por ser so demonstração o cadastro de adm sera
        //liberado para qualquer usuario logado
        if (!empty($_SESSION['login'])) {
            echo "
            <label for='form' > Tipo de usuario </label ><br >
            <input type = 'text' class='input' name = 'tipoUsuario' id = 'tipoUsuario' value='1'><br >";
        }
        ?>
        <input type="hidden" class="input" name="form" id="form" value="<?= $_GET['form']; ?>"><br>
        <input type="submit" class="btn" value="Enviar">
    </form>
</div>


tipo de usuario(automatico em usuario)<br>


email(varios)(criar mais um campo se clicar em mais)ou um formulario que fica cadastrando e voltando para mesma pagina
de cadastro de email

so administrador
tipo de usuario (administrador, usuario)(formulario para cadastrar os tipos de usuario)
curso-disciplina(formulario para cadastrar os tipos de disciplina eles sao chamados por uma lista que e preenchida do
banco)


colocar as listas com paginação para não ficar uma pagina gigante
quando logado mostrar uma pagina com botoes que levam o usuario para mostrar suas informaçoes(varias listas com
informaçoes especifiacas e totais ) e informaçoes salva no bando de dados
podendo alterar ou adicionar novas so dele mesmo mas mostra de todos os cadastrados


paginas de login nao podem ser acessadas por pessoas so com url

criar paginas de erro 400 404 500
</body>
</html>

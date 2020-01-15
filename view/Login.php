<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Login</title>
</head>
<body>
<div class="container">
    <!--mostra mensagens de aviso-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>

    <h1>Tela de login</h1>
    <form action="/crud_php/controle/LoginController.php" method="post">
        login<br>
        <input type="text" name="login" class="input"><br>
        senha<br>
        <input type="text" name="senha" class="input">

        <input type="submit" value="Logar" class="btn">
    </form>
    <br>
    <!--link do formulario cadastrar usuarios-->
    <a href="/crud_php/view/FormPessoa.php?form=1">
        <button class="btn">Cadastrar Usuário</button>
    </a><br>
</div>
</body>
</html>
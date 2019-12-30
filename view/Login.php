<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Login</title>
</head>
<body>
<h1>Tela de login</h1>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
<form action="/crud_php/controle/LoginController.php" method="post">
    login<br>
    <input type="text" name="login" class="input"><br>
    senha<br>
    <input type="text" name="senha" class="input">

    <input type="submit" value="Logar" class="btn">
</form><br>
<!--link do formulario cadastrar usuarios-->
<a href="/crud_php/view/FormPessoa.php?form=1"><button class="btn">cadastrar usuario</button></a><br>
</body>
</html>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Crud-PHP</title>
</head>
<body>
<div class="container">
<!-- recebe todas as mensagens e mostra a correta-->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
inivio
    <a href="/crud_php/view/FormPessoa.php?form=1"><button class="btn">Cadastrar Usuário</button></a><br>
    <a href="/crud_php/view/Login.php"><button class="btn">Login</button></a><br>
    <a href="/crud_php/view/paginasRestritas/Home.php"><button class="btn">Home restrito</button></a><br>
    só entra se estiver logado, mesmo digitando o caminho na url: http://localhost/crud_php/view/paginasRestritas/Home.php
<br>
</div>
</body>
</html>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/VerificaSeEstaLogado.php'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Home</title>
</head>
<body>
<div class="container-fluid">
    <!--ferifica a existencia de mensagens no get e mostra na tela-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
    <h1>Essa pagina so pode ser acessada se estiver logado</h1>

    <!--cabecalho-->
    <header>

    </header>

    <main>

        <!--cadastro de imagens-->
        <form action="/crud_php/controle/MultimidiaControle.php" method="post" enctype="multipart/form-data">
            legenda<br>
            <input type="text" name="legenda" class="input"><br>
            descrição do arquivo<br>
            <textarea class="input" name="descricao_evento" rows="5" cols="50" maxlength="255"></textarea><br>
            <!--botao de upload de imagens para o album-->
            <label for="fotoAlbum" class="btn btn-outline-dark btn-sm">Carregar Imagem</label><br>
            <input type="file" id="fotoAlbum" name="fotoAlbum" class="inputtypefile">

            <input type="submit" value="Salvar" class="btn btn-success btn-sm">
        </form>
        cadastrar
        excluir
        editar
        mostrar
    </main>

    <footer>
        <a href="/crud_php/view/paginasRestritas/Home.php"><button class="btn btn btn-secondary btn-lg">Home</button></a><br>
        <a href="/crud_php/index.php"><button class="btn btn btn-secondary btn-lg">Index</button></a><br>
    </footer>
</div>
</body>
</html>
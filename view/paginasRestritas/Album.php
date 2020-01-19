<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/VerificaSeEstaLogado.php'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Home</title>
</head>
<body>
<div class="container">
    <!--verifica a existencia de mensagens no get e mostra na tela-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
    <h1>Essa pagina so pode ser acessada se estiver logado</h1>

    <!--cabecalho-->
    <header>

    </header>
    <main>

        <!--cadastro de imagens-->
        <form action="/crud_php/controle/MultimidiaControleSalvar.php" method="post" enctype="multipart/form-data">
            <label for="fotoAlbum" class="btn btn-outline-dark btn-sm">Carregar Imagem</label><br>
            legenda<br>
            <input type="text" name="legenda" class="input"><br>
            descrição do arquivo<br>
            <textarea class="input" name="descricao_evento" rows="5" cols="50" maxlength="255"></textarea><br>
            <!--botao de upload de imagens para o album-->
            <input type="file" id="fotoAlbum" name="fotoAlbum" class="inputtypefile">

            <input type="submit" value="Salvar Imagem" class="btn btn-success btn-sm">
        </form>

        <div class="row">
            <?php

            require_once $_SERVER['DOCUMENT_ROOT'] . "/crud_php/controle/ListarControle.php";
            $listarControle = new ListarControle();
            $listaMultimidia = $listarControle->listarMultimidia($_SESSION['idPessoa']);

            if (!empty($listaMultimidia)) {
                foreach ($listaMultimidia as $value) { ?>

                    <div class="card mr-5 mt-5" style="width: 20rem;">
                        <img class="card-img-top" src="<?= $value['path_image'] ?>" alt="Imagem de capa do card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $value['legenda'] ?></h5>
                            <p class="card-text"><?= $value['descricao'] ?></p>
                        </div>
                        <a class="btn"
                           href="/crud_php/controle/MultimidiaControleExcluir.php?idFoto=<?= $value['id_arquivos_multimedia'] ?>">Excluir
                            Imagem</a>
                    </div>

                <?php }
            }else{
                echo "<h2>Album Não Possui Foto</h2>";
            } ?>
        </div>
    </main>

    <footer>
        <h2>Colocar Paginação</h2>
        <a href="/crud_php/view/paginasRestritas/Home.php">
            <button class="btn btn btn-secondary btn-lg">Home</button>
        </a><br>
        <a href="/crud_php/index.php">
            <button class="btn btn btn-secondary btn-lg">Index</button>
        </a><br>
    </footer>

</div>
</body>
</html>
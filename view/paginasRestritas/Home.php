<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/VerificaSeEstaLogado.php'; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>Home</title>
</head>
<body>
<!--ferifica a existencia de mensagens no get e mostra na tela-->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
<div class="container">
    <h1>Essa pagina so pode ser acessada se estiver logado</h1>

    <!--cabecalho-->
    <header>

    </header>

    <div class="row">
        <!--menu principal-->
        <nav class="col-2">
            <!--mostra a foto no perfil-->
            <div class="fotoPerfil">
                <h2>foto perfil</h2>
                <!--mostrando a foto do perfil-->
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/crud_php/view/configuracoes/FotoPerfil.php" ?>
                <!--form para alterar a foto do perfil-->
                <form method="post" action="/crud_php/controle/SalvarFotosPerfil.php" enctype="multipart/form-data">
                    <label for="fotoPerfil" class="btn btn-outline-dark btn-sm">Selecionar Foto</label>
                    <input type="file" name="fotoPerfil" id="fotoPerfil" class="inputtypefile">
                    <input type="submit" value="Alterar" class="btn btn-success btn-sm">
                </form>
            </div>
            <!--botão para deslogar do sistema-->
            <a href="/crud_php/view/configuracoes/deslogar.php" class="link">
                <button type="button" class="btn btn-outline-warning btn-sm">Deslogar</button>
            </a>

        </nav>
        <!--principal-->
        <main class="col-10">
            <a href="/crud_php/view/FormPessoa.php?form=2">Cadastrar uma Pessoa</a>
            <div style="height: 500px; background-color: aqua;">asd</div>
        </main>
    </div>

    <!--rodape-->
    <footer>

    </footer>


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

    <h1>Lista de paginas</h1>
</div>
</body>
</html>

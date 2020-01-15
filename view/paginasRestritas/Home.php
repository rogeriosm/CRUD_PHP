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
                        <label for="fotoPerfil" class="btn btn-outline-dark btn-sm">Selecionar Foto <i
                                    class="fas fa-camera"></i></label>
                        <input type="file" name="fotoPerfil" id="fotoPerfil" class="inputtypefile"><br>
                        <input type="submit" value="Alterar Foto" class="btn btn-success btn-sm">
                    </form>
                </div>

                <!--botão para deslogar do sistema-->
                <a href="/crud_php/view/configuracoes/deslogar.php" class="link">
                    <button type="button" class="btn btn-outline-warning btn-sm">Deslogar</button>
                </a><br>

                <a href="/crud_php/index.php">
                    <button class="btn btn btn-secondary btn-lg">Index</button>
                </a>

            </nav>

            <!--principal-->
            <main class="col-10">

                <!--menu acima do listar-->
                <div class="container-fluid">
                    <div class="row">

                        <!--link para pagina de cadastrar uma pessoa-->
                        <a class="btn btn-outline-dark btn-sm" href="/crud_php/view/FormPessoa.php?form=2">Cadastrar uma
                            Pessoa</a>

                        <!--pesquisa uma pessoa pelo nome ou parte do nome-->
                        <form action="/crud_php/view/paginasRestritas/Pesquisar.php" method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Digite um nome" name="nome"
                                       required aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text cursor" id="basic-addon2">Pesquisar
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <!--listar pessoas cadastradas-->
                <table class="table table-hover table-dark table-sm">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Apelido</th>
                        <th scope="col">Login</th>
                        <th scope="col">RG</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Numero</th>
                        <th scope="col">Residencial</th>
                        <th scope="col">Trabalho</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">E-mail senha</th>
                        <th scope="col">Disciplina</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</i></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/crud_php/controle/ListarControle.php";
                        $listarControle = new ListarControle();

                        //pegando o numero total de tuplas no banco de dados para coloca como contador de paginas
                        $totalTuplas = $listarControle->contadorUsuarios();

                        //pegar paginação atual
                        $paginaAtual = (empty($_GET['pagina'])) ? "1" : $_GET['pagina'];

                        //numero de tuplas mostrado por pagina
                        $itensPorPagina = 10;

                        //limitador de guias da paginação + guia atual
                        $limitePaginação = 2;

                        //inicio da paginação
                        $inicioParametroTupla = ($itensPorPagina * $paginaAtual) - $itensPorPagina;

                        //definindo o numero total de abas da paginação
                        $totalpaginacao = ceil($totalTuplas / $itensPorPagina);

                        //mostra as tuplas retornada com limit
                        $buscaPessoasLimit = $listarControle->buscaUsuariosLimite($inicioParametroTupla, $itensPorPagina);


                        foreach ($buscaPessoasLimit as $c) {
                            echo "<tr>";
                            echo "  <td>" . $c["id_pessoa"] . "-</td>";
                            echo "  <td>" . $c["descricao"] . "</td>";
                            echo "  <td>" . $c["nome"] . "</td>";
                            echo "  <td>" . $c["apelido"] . "</td>";
                            echo "  <td>" . $c["login"] . "</td>";
                            echo "  <td>" . $c["rg"] . "</td>";
                            echo "  <td>" . $c["cpf"] . "</td>";
                            echo "  <td>" . $c["numero"] . "</td>";
                            echo "  <td>" . $c["residencial"] . "</td>";
                            echo "  <td>" . $c["trabalho"] . "</td>";
                            echo "  <td>" . $c["email"] . "</td>";
                            echo "  <td>" . $c["senha"] . "</td>";
                            echo "  <td>" . $c["disciplina"] . "</td>";

                            echo "  <td>" .
                                        "<a href='/crud_php/view/FormPessoa.php?idPessoa={$c["id_pessoa"]}&form=3'><i class='fas fa-edit'></i></a>" .
                                 "</td>";

                            echo "  <td>" .
                                        "<a href='/crud_php/controle/PessoaControleExclui.php?idPessoa=" . $c["id_pessoa"] . "'><i class='fas fa-trash-alt'></i></a>" .
                                 "</td>";


                            echo "</tr>";
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>

                <!--paginação-->
                <nav aria-label="Navegação de página">
                    <ul class="pagination">

                        <?php
                        //so mostra o botao inicio se nao estiver na pagina 1
                        if ($paginaAtual > 1) {
                            //aba primeiro
                            echo '<li class="page-item"><a class="page-link" href="Home.php?pagina=1">Primeiro</a></li>';
                            //guia seta volta
                            echo '<a class="page-link" href="Home.php?pagina=' . ($paginaAtual - 1) . '" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                  </a>';
                        }

                        //mostra as abas da paginacao
                        for ($i = ($paginaAtual - $limitePaginação); $i <= ($paginaAtual + $limitePaginação); $i++) {
                            if ($i >= 1 && $i <= $totalpaginacao) {
                                $ativo = ($i == $paginaAtual) ? "page-item active" : "page-item";
                                echo '<li class="' . $ativo . '">';
                                echo '    <a class="page-link" href="Home.php?pagina=' . $i . ' ">' . $i . '</a>';
                                echo ' </li>';
                            }
                        }

                        //so mostra o botao ultimo se nao estiver na ultima pagina
                        if ($paginaAtual < $totalpaginacao) {
                            //aba seta avança
                            echo '<a class="page-link" href="Home.php?pagina=' . ($paginaAtual + 1) . '" aria-label="Próximo">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                  </a>';
                            echo '<li class="page-item">
                                    <a class="page-link" href="Home.php?pagina=' . $totalpaginacao . '">Última</a>
                                  </li>';
                        }
                        ?>

                    </ul>
                </nav>


            </main>
        </div>

        <!--rodape-->
        <footer>

        </footer>

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

        <h1>Lista de paginas</h1>
    </div>
    </body>
    </html>

    <!--nao mostrar o id do usuario no formulario-->
<?php
//edita um cadastro
function editarPessoa($idPessoa = 0)
{
    if ($idPessoa > 0) {
        header("location: /crud_php/controle/EditeControle.php?idPessoa=" . $idPessoa);
    }
}


?>
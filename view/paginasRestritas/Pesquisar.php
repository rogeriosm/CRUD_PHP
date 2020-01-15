<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/VerificaSeEstaLogado.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/controle/ListarControle.php';

$listarControle = new ListarControle();
//request recebe dados de post, get e cookie
//recebe o nome que sera pesquisado
$nomePesquisa = $_REQUEST['nome'];
?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/link_script.php'; ?>
    <title>buscar por pessoa cadastrada</title>
</head>
<body>
<div class="container">
    <!--ferifica a existencia de mensagens no get e mostra na tela-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/view/configuracoes/MensagensCadastro.php'; ?>
    <main>
        <h1>Resultado Pesquisar</h1>
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
                <th scope="col">Edite</th>
                <th scope="col">Excluir</i></th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <?php
                //total de tuplas retornadas do pesquisar para coloca como contador de paginas
                $totalTuplasPesquisada = $listarControle->contadorPesquisa($nomePesquisa);

                //pegar paginação atual
                $paginaAtual = (empty($_GET['pagina'])) ? "1" : $_GET['pagina'];

                //numero de tuplas mostrado por pagina
                $itensPorPagina = 10;

                //limitador de abas da paginação + aba atual
                $limitePaginação = 2;

                //inicio da paginação
                $inicioParametroTupla = ($itensPorPagina * $paginaAtual) - $itensPorPagina;

                //definindo o numero total de abas da paginação
                $totalpaginacao = ceil($totalTuplasPesquisada / $itensPorPagina);

                //sql para puchar o itens da pagina dentro do limite
                $buscaPessoasLimit = $listarControle->pesquisaUsuarioLimite($nomePesquisa, $itensPorPagina, $inicioParametroTupla);

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
                    echo "  <td>" . $c["email_senha"] . "</td>";
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
                    echo '<li class="page-item"><a class="page-link" href="Pesquisar.php?pagina=1&nome='.$nomePesquisa.'">Primeira</a></li>';
                    //aba seta volta
                    echo '<a class="page-link" href="Pesquisar.php?pagina=' . ($paginaAtual - 1) . '&nome='.$nomePesquisa.'" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Anterior</span>
                          </a>';
                }

                for ($i = ($paginaAtual - $limitePaginação); $i <= ($paginaAtual + $limitePaginação); $i++) {
                    //if so mostra as abas apartir do 1 e finaliza no total
                    if ($i >= 1 && $i <= $totalpaginacao) {
                        //marca em qual aba esta a selecao atual
                        $ativo = ($i == $paginaAtual) ? "page-item active" : "page-item";
                        echo '<li class="' . $ativo . '">';
                        echo '    <a class="page-link" href="Pesquisar.php?pagina=' . $i . '&nome='.$nomePesquisa.' ">' . $i . '</a>';
                        echo ' </li>';
                    }
                }

                //so mostra o botao ultimo se nao estiver na ultima pagina
                if ($paginaAtual < $totalpaginacao) {
                    //aba seta avança
                    echo '<a class="page-link" href="Pesquisar.php?pagina=' . ($paginaAtual + 1) . '&nome='.$nomePesquisa.'" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Próximo</span>
                          </a>';
                    echo '<li class="page-item">
                            <a class="page-link" href="Pesquisar.php?pagina=' . $totalpaginacao . '&nome='.$nomePesquisa.'">Última</a>
                          </li>';
                }
                ?>
            </ul>
        </nav>
    </main>
    <footer>
        <a href="/crud_php/view/paginasRestritas/Home.php"><button class="btn ">Home</button></a><br>
        <a href="/crud_php/view/FormPessoa.php?form=2"><button class="btn">Cadastrar Usuário</button></a><br>
        <a href="/crud_php/index.php"><button class="btn">Index</button></a><br>
    </footer>
</div>
</body>
</html>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] ."/crud_php/view/configuracoes/VerificaSeEstaLogado.php";
//atribuindo o nome de usuario logado a uma variavel
//para criação de pastas para salvar as imagens
$nome_login = $_SESSION['login'];
//recebe o arquivo do formulario
$arquivo = $_FILES['fotoPerfil'];

//criando um array para inserir os erros
//que possam ser gerados ao tentar inserir a media
$error = array();

//definindo limitaçoes para imagens upadas
$mg         = 1;               //20MB diz o tamanho da imagem a ser salva
$largura    = 2280;		        //2280px
$altura     = 1280;		        //1280px
$tamanho    = 1000000 * $mg;	//1 = 1000000
$tipoPermitido  = "(jpg|jpeg|jpe|png)";

//FAZ A VALIDACAO DO ARQUIVO
require_once $_SERVER['DOCUMENT_ROOT'].'/crud_php/controle/ValidacaoImagem.php';

//pathinfo() retorna um array associativo contendo inforamações sobre o caminho em path.
//Você pode especificar quais elementos são retornados com o parâmetro opcional options.
//Ele é composto de PATHINFO_DIRNAME, PATHINFO_BASENAME, PATHINFO_EXTENSION e PATHINFO_FILENAME.
// O padrão é retornar todos os elementos
$extension = pathinfo($arquivo['name'],PATHINFO_EXTENSION);

//cria um nome para o arquivo baseado no dia e hora que foi inserido
//no sistema para nao gerar conflitos na pasta do servidor
$nome_imagem = 'perfil.'.$extension;


//caminho a ser savo a imagem
$caminhoPasta = $caminho_pasta.'/'.$nome_imagem;

//aqui pode ser colocado logica para criar album de fotos
//move_uploaded_file — Move o arquivo do temp para a pasta do usuario
move_uploaded_file($arquivo['tmp_name'], $caminhoPasta);

//colocar caminho no banco de dados

//volta para pagina principal
header('location: /crud_php/view/paginasRestritas/home.php');
exit("erro!");
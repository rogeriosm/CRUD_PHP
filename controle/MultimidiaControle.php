<?php
//chamando os arquivos dto e dao
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/MultimidiaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/MultimidiaDAO.php';

//inicia uma sessão
session_start();

//atribuindo o nome de usuario logado a uma variavel
//para criação de pastas para salvar as imagens
$nome_login = $_SESSION['login'];

//recebendo as informações do form
$legenda            = $_POST['legenda'];
$descricaoEvento    = $_POST['descricao_evento'];
$arquivo            = $_FILES['fotoAlbum'];              //colocando o arquivo completo dentro da variavel
//$tmp_name         = $_FILES['file']['tmp_name'];  //local temporario do arquivo
//$tamanho          = $_FILES['file']['size'];      //tamanho do arquivo
//$tipo             = $_FILES['file']['type'];      //tipo do arquivo(image/jpeg)
//$legenda          = $_FILES['file']['name'];      //nome do arquivo

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
$nome_imagem = date("d-m-Y-H-i-s-a").'.'.$extension;

//caminho a ser savo a imagem
$caminhoPasta = $caminho_pasta.'/'.$nome_imagem;

//aqui pode ser colocado logica para criar album de fotos
//move_uploaded_file — Move o arquivo do temp para a pasta do usuario
move_uploaded_file($arquivo['tmp_name'], $caminhoPasta);

//caminho ate a imagem
$caminhoImagem = '/crud_php/imagensBanco/'.$nome_login.'/'.$nome_imagem;

//CADASTRANDO AS INFORMAÇÕES
$multimidiaDTO = new MultimidiaDTO();

$multimidiaDTO->setNomeArquivo($nome_imagem);
$multimidiaDTO->setDescricao($descricaoEvento);
$multimidiaDTO->setLegenda($legenda);
$multimidiaDTO->setPathImage($caminhoImagem);

$multimidiaDAO = new MultimidiaDAO();




echo '<pre>';
print_r($multimidiaDTO);
echo '</pre>';die();
//        $cst = $this->con->conectar()->prepare("INSERT INTO `aula_upload_arquivos` (`legenda`, `arquivo`) VALUES (:legenda, :arquivo);");
//        $cst->bindParam(':legenda', $this->objfc->tratarCaracter($this->legenda, 1), PDO::PARAM_STR);
//        $cst->bindParam(':arquivo', $nome_imagem, PDO::PARAM_STR);
//
//        if($cst->execute()){
//            header('location: /aulas/upload/');
//        }else{
//            echo '<script type="text/javascript">alert("Erro em armazenar os dados");</script>';
//        }
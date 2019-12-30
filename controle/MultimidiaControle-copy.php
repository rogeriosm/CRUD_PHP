<?php
//configurando horario local sem horario de verao
date_default_timezone_set('America/Sao_Paulo');

session_start();
//atribuindo o nome de usuario logado a uma variavel
//para criação de pastas para salvar as imagens
$nome_login = $_SESSION['login'];
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DTO/MultimidiaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/MultimidiaDAO.php';

$legenda            = $_POST['legenda'];
$descricaoEvento    = $_POST['descricao_evento'];
$arquivo            = $_FILES['file'];              //colocando o arquivo completo dentro da variavel
//$tmp_name         = $_FILES['file']['tmp_name'];  //local temporario do arquivo
//$tamanho          = $_FILES['file']['size'];      //tamanho do arquivo
//$tipo             = $_FILES['file']['type'];      //tipo do arquivo(image/jpeg)
//$legenda          = $_FILES['file']['name'];      //nome do arquivo

//falta mais campos do formulario!//
$error = array();

//definindo limitaçoes para imagens upadas
$largura    = 2280;		//280px
$altura     = 1280;		//180px
$tamanho    = 2000000;	//20MB

//VERIFICANDO A EXISTENCIA DO ARQUIVO E FAZENDO A VALIDACAO DO MESMO COM TRÊS CONDIÇÕES
if(!empty($arquivo['name']))
{
    //VALIDANDO OS TIPO DE IMAGEM PERMITIDAS
    //preg_match valida o tipo da imagem comparando com $arquivo['type']
    //O primeiro parâmetro é a expressão regular ($pattern).
    //O segundo parâmetro é a string onde pesquisaremos a expressão ($subject).
    //O terceiro parâmetro é um array que armazenará o termo que casou ($matches).
    //preg_match($pattern, $subject, $matches); retorna tru ou false
    if(!preg_match('/^(image)\/(jpg|jpeg|jpe|png)$/', $arquivo['type'])){
        $error[] = "Só pode ser enviado imagens (jpg|jpeg|jpe|png).";
    }
    //VALIDANDO AS DIMENSÕES DO ARQUIVO
    $dimensoes = getimagesize($arquivo['tmp_name']);
    if($dimensoes[0] > $largura || $dimensoes[1] > $altura){
        $error[] = "Esta imagem precisa está nessas dimensões 280x180.";
    }
    //VALIDANDO O TAMANHO DO ARQUIVO
    if($arquivo['size'] > $tamanho){
        $error[] = "Esta imagem precisa ser menor que 1MB.";
    }

    //ALTERANDO O NOME DO ARQUIVO E ENVIANDO PARA PASTA QUE LHE FOI DESTINADA
    //verificando se nao hover erro na validação
    if(count($error) == 0){

        //pathinfo mostra o caminho do arquivo
        //parametros
        //dirname
        //basename
        //extension = retorna a extenção
        //filename
        $pathinfo = pathinfo($arquivo['name']);

        //cria um nome para o arquivo baseado no dia e hora que foi inserido
        //no sistema para nao gerar conflitos na pasta do servidor
        $nome_imagem = date("d-m-Y-H-i-s-a").'.'.$pathinfo['extension'];

        //mostra  o caminho da pasta a ser salva ou criada
        $caminho_imagem = $_SERVER['DOCUMENT_ROOT'].'/crud_php/imagensBanco/'.$nome_login;

        //verifica se existe a pasta com o nome do usuario
        //aqui pode ser colocado logica para criar album de fotos
        if(is_dir($caminho_imagem))
        {
            //se a pasta existir ele sava o arquivo dentro dela
            //move_uploaded_file — Move o arquivo do temp para a pasta do usuario
            move_uploaded_file($arquivo['tmp_name'], $caminho_imagem.'/'.$nome_imagem);
        }
        else
        {
            //NÃO ESQUECER DE SETAR PERMIÇÃO NAS PASTA QUE IRÁ RECEBER O UPLOAD.
            //se não existir, cria a pasta com o nome do usuario
            $sucesso = mkdir($caminho_imagem,0777);
            //se a pasta for criada com sucesso ele salvar as imagens dentro
            if($sucesso)
            {
                //move_uploaded_file — Move o arquivo do temp para a pasta do usuario
                move_uploaded_file($arquivo['tmp_name'], $caminho_imagem.'/'.$nome_imagem);
            }
        }

        //CADASTRANDO AS INFORMAÇÕES

//        $cst = $this->con->conectar()->prepare("INSERT INTO `aula_upload_arquivos` (`legenda`, `arquivo`) VALUES (:legenda, :arquivo);");
//        $cst->bindParam(':legenda', $this->objfc->tratarCaracter($this->legenda, 1), PDO::PARAM_STR);
//        $cst->bindParam(':arquivo', $nome_imagem, PDO::PARAM_STR);
//
//        if($cst->execute()){
//            header('location: /aulas/upload/');
//        }else{
//            echo '<script type="text/javascript">alert("Erro em armazenar os dados");</script>';
//        }


    }else{
        foreach($error as $msg){
            //voltar para pagina de cadastrar imagens e passar as mensagens
            echo '<li>'.$msg.'</li>';
        }
    }
}
else
{
    echo '<script>alert("Erro em armazenar os dados");</script>';
}




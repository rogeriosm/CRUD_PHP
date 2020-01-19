<?php
/**
 *Ao enviar um formulário de upload, a variável $_FILES["arquivo"]["error"] poderá conter os seguintes valores:
 *
 *UPLOAD_ERR_OK
 *Valor: 0; não houve erro, o upload foi bem sucedido.
 *
 *UPLOAD_ERR_INI_SIZE
 *Valor 1; O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.
 *
 *UPLOAD_ERR_FORM_SIZE
 *Valor: 2; O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que
 *foi especificado no formulário html.
 *
 *UPLOAD_ERR_PARTIAL
 *Valor: 3; o upload do arquivo foi feito parcialmente.
 *
 *UPLOAD_ERR_NO_FILE
 *Valor: 4; Não foi feito o upload do arquivo.
*/

//se der algum erro no upload voltar para home
if($arquivo['error'] > 0){
    //voltar para pagina de cadastro de imagem caso nao seja enviado imagens
    header('location: /crud_php/view/paginasRestritas/Home.php?errUplImg=2');
    exit();
}

//VERIFICANDO A EXISTENCIA E FAZENDO A VALIDACAO DO ARQUIVO EM TRÊS CONDIÇÕES
if(!empty($arquivo['name']))
{
    //VALIDANDO OS TIPO DE IMAGEM PERMITIDAS
    //preg_match valida o tipo da imagem comparando com $arquivo['type']
    //O primeiro parâmetro é a expressão regular ($pattern).
    //O segundo parâmetro é a string onde pesquisaremos a expressão ($subject).
    //O terceiro parâmetro é um array que armazenará o termo que casou ($matches).
    //preg_match($pattern, $subject, $matches); retorna tru ou false
    if(!preg_match('/^(image)\/'.$tipoPermitido.'$/', $arquivo['type'])){
        $error[] = "Só pode ser enviado imagens com extenção ".$tipoPermitido.".";
    }
    //VALIDANDO AS DIMENSÕES DO ARQUIVO
    $dimensoes = getimagesize($arquivo['tmp_name']);
    if($dimensoes[0] > $largura || $dimensoes[1] > $altura){
        $error[] = "Esta imagem precisa está nessas dimensões ".$largura."x".$altura.".";
    }
    //VALIDANDO O TAMANHO DO ARQUIVO
    if($arquivo['size'] > $tamanho){
        $error[] = "Esta imagem precisa ser menor que ".$mg."MB.";
    }
    //verificando se nao hover erro na validação
    if(count($error) > 0){
        //mudar logica para redirecionar pagina com todas as mensagens de erro
//        foreach($error as $msg){
//            echo '<li>'.$msg.'</li>';
//        }
        //voltar para pagina de cadastro de imagem caso nao seja enviado imagens
        header('location: /crud_php/view/paginasRestritas/Home.php?errUplImg=3');
        exit();
        exit();
    }
}
else
{
    //voltar para pagina de cadastro de imagem caso nao seja enviado imagens
    header('location: /crud_php/view/paginasRestritas/Home.php?errUplImg=1');
    exit();
}

//caminho da pasta para ser criada ou salvar midia
$caminho_pasta = $_SERVER['DOCUMENT_ROOT'].'/crud_php/imagensBanco/'.$nome_login;

//cria a pasta com o nome do usuario se nao existir
if(!file_exists($caminho_pasta))
{
    //NÃO ESQUECER DE SETAR PERMIÇÃO NAS PASTA QUE IRÁ RECEBER O UPLOAD.
    $sucesso = mkdir( $caminho_pasta,0777);
    //se a pasta nao for criada retorna erro e volta para home
    if(!$sucesso)
    {
        //erro ao tentar criar a pasta do usuario
        header('location: /crud_php/view/paginasRestritas/Home.php?errCriaPasta=1');
        exit();
    }
}


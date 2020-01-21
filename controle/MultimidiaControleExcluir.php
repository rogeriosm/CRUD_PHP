<?php
$idImagem =  $_GET['idFoto'];
//buscar dados da imagem no banco para indicar o caminho no servidor
require_once $_SERVER['DOCUMENT_ROOT'] . "/crud_php/DAO/MultimidiaDAO.php";

$multimidiaDAO = new MultimidiaDAO();

//pegando informações da imagem
$listaMultimidia = $multimidiaDAO->imagem($idImagem);
//caminho da pasta
$listaMultimidia['path_image'] = $_SERVER['DOCUMENT_ROOT'] .$listaMultimidia['path_image'];

//apagar foto na pasta
//verifica a existencia da pasta
if(file_exists($listaMultimidia['path_image']))
{
    if(unlink($listaMultimidia['path_image']))
    {
        //apagar foto no servidor
        $sucesso = $multimidiaDAO->excluirImagem($idImagem);
        if($sucesso){
            //voltar para pagina de cadastro de imagem apos sucesso
            header('location: /crud_php/view/paginasRestritas/Album.php');
            exit();
        }else{
            echo "Erro ao apagar foto do banco de dados";
            exit();
        }
    }else{
        echo "Erro ao apagar foto do servidor";
        exit();
    }
}else{
    //voltar para pagina de cadastro de imagem com msg de erro
    header('location: /crud_php/view/paginasRestritas/Album.php?msg=arquivo inexistente');
    exit();
}


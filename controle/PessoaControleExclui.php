<?php
require_once $_SERVER['DOCUMENT_ROOT']."/crud_php/DAO/PessoaDAO.php";
//criando o dao
$pessoaDAO = new PessoaDAO();

//recebendo id pelo get
$idPessoa = $_GET['idPessoa'];

//excluindo registro se nao estiver vazio
if(!empty($idPessoa))
{
    $sucesso = $pessoaDAO->excluirPessoa($idPessoa);
    if($sucesso)
    {
        header("location: /crud_php/view/paginasRestritas/Home.php?msgExSuc=1");
        exit("exit erro ExcluirPessoaControle");
    }
    else
    {
        header("location: /crud_php/view/paginasRestritas/Home.php?msgExErr=1");
        exit("exit erro ExcluirPessoaControle");
    }

}


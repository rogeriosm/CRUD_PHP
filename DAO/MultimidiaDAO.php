<?php
//conexao com banco de dados
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/conexao/conexao.php';

//configurando horario local sem horario de verao
date_default_timezone_set('America/Sao_Paulo');

class multimidiaDAO
{
    public $pdo = null;

    //chamando a conexao para dentro de pdo
    public function __construct()
    {
        $this->pdo = Conexao::conecta_db();
    }

    //inserindo uma uma imagem
    function salvarImagem(MultimidiaDTO $multimidiaDTO){
        try{
            $sql = "insert into arquivos_multimidia (nome_arquivo, descricao, legenda, pessoa_id_pessoa, path_image) 
                    values (?, ?, ?, ?,?)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $multimidiaDTO->getNomeArquivo(), 2);
            $stmt->bindValue(2, $multimidiaDTO->getDescricao(), 2);
            $stmt->bindValue(3, $multimidiaDTO->getLegenda(), 2);
            $stmt->bindValue(4, $multimidiaDTO->getIdPessoa(), 1);
            $stmt->bindValue(5, $multimidiaDTO->getPathImage(), 2);
            $sucesso = $stmt->execute();
            return $sucesso;

        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }

    //buscando todas imagem
    public function buscarImagens($idPessoa)
    {
        try
        {
            $sql = "select id_arquivos_multimedia, nome_arquivo, descricao, legenda, pessoa_id_pessoa, path_image
                    from arquivos_multimidia
                    where pessoa_id_pessoa = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1,$idPessoa);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //buscando caminho da imagem para excluir do servidor
    public function imagem($idImagem)
    {
        try
        {
            $sql = "select path_image
                    from arquivos_multimidia
                    where id_arquivos_multimedia = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1,$idImagem);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //deletando uma imagem
    public function excluirImagem($idImagem)
    {
        try
        {
            $sql = "DELETE FROM arquivos_multimidia WHERE id_arquivos_multimedia = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idImagem, 1);
            $stmt->execute();
            $count = $stmt->rowCount();//retorna a quantidade de linhas alteradas
            if ($count > 0){
                return true;
            }else{
                return false;
            }
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

}
<?php

class MultimidiaDTO
{
    private $nomeArquivo;//nome do arquivo na pasta
    private $descricao;//descrição do usuario sobre a foto "comentario"
    private $legenda;//nome dado a foto sera salva no banco de dados e mostradado quando vinher do banco de dados
    private $pathImage;//caminho da midia na pasta
    private $idPessoa;
    //private $tamanho;//largura e altura do arquivo
    //private $tipo;//extenção da imagem

    /**
     * @return mixed
     */
    public function getNomeArquivo()
    {
        return $this->nomeArquivo;
    }

    /**
     * @param mixed $nomeArquivo
     */
    public function setNomeArquivo($nomeArquivo): void
    {
        $this->nomeArquivo = $nomeArquivo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getLegenda()
    {
        return $this->legenda;
    }

    /**
     * @param mixed $legenda
     */
    public function setLegenda($legenda): void
    {
        $this->legenda = $legenda;
    }

    /**
     * @return mixed
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }

    /**
     * @param mixed $pathImage
     */
    public function setPathImage($pathImage): void
    {
        $this->pathImage = $pathImage;
    }

    /**
     * @return mixed
     */
    public function getIdPessoa()
    {
        return $this->idPessoa;
    }

    /**
     * @param mixed $idPessoa
     */
    public function setIdPessoa($idPessoa): void
    {
        $this->idPessoa = $idPessoa;
    }
}
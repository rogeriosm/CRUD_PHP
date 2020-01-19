<?php
require_once $_SERVER['DOCUMENT_ROOT']."/crud_php/DAO/CursoDAO.php";
require_once $_SERVER['DOCUMENT_ROOT']."/crud_php/DAO/PessoaDAO.php";
require_once $_SERVER['DOCUMENT_ROOT']."/crud_php/DAO/multimidiaDAO.php";

//regra de negocios pagina form.php
class ListarControle{

    public $pessoaDAO = null;
    public $cursoDAO = null;
    public $multimidiaDAO = null;

    public function __construct()
    {
        $this->pessoaDAO = new PessoaDAO();
        $this->cursoDAO = new CursoDAO();
        $this->multimidiaDAO = new MultimidiaDAO();
    }

    //busca todos os cursos cadastrados no banco de dados
    function buscarCursos()
    {
        return $this->cursoDAO->buscaCurso();
    }

    //busca todos os tipos de usuario cadastrado no banco de dados
    function buscarTipoUsuario()
    {
        return $this->pessoaDAO->buscarTipoUsuario();
    }

    //busca um usuario
    function buscaUsuario($idPessoa = 0){
        return $this->pessoaDAO->listarPessoa($idPessoa)  ;
    }

    //retorna total de tuplas cadastradas para paginação
    function contadorUsuarios(){
        return $this->pessoaDAO->countPessoas();
    }

    //mostra as tuplas retornada com limit da paginação
    function buscaUsuariosLimite($inicioParametroTupla, $itensPorPagina){
        return $this->pessoaDAO->listarPessoasLimit($inicioParametroTupla, $itensPorPagina);
    }

    //pesquisar.php
    //retorna total de tuplas pesquisada para paginação
    function contadorPesquisa($nomePost){
        return $this->pessoaDAO->countPessoa($nomePost);
    }

    //mostra as tuplas pesquisadas por nome com limit da paginação
    function pesquisaUsuarioLimite($nomePost, $itensPorPagina, $inicioParametroTupla){
        return $this->pessoaDAO->buscarPessoaLimit($nomePost, $itensPorPagina, $inicioParametroTupla);
    }

    //multimidia.php
    //retorna total de tuplas pesquisada para paginação
    function listarMultimidia($idPessoa){
        return $this->multimidiaDAO->buscarImagens($idPessoa);
    }


}

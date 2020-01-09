<?php
require_once $_SERVER['DOCUMENT_ROOT']."/crud_php/DAO/CursoDAO.php";
require_once $_SERVER['DOCUMENT_ROOT']."/crud_php/DAO/PessoaDAO.php";

//regra de negocios pagina form.php
class ListarFormControle{

    public $pessoaDAO = null;
    public $cursoDAO = null;

    public function __construct()
    {
        $this->pessoaDAO = new PessoaDAO();
        $this->cursoDAO = new CursoDAO();
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


}

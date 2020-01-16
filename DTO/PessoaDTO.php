<?php
class PessoaDTO
{
    private $idPessoa;
    private $nome;
    private $apelido;
    private $cpf;
    private $rg;
    private $login;
    private $senha;
    private $telefone;
    private $tipoUsuario;
    private $enResidencia;
    private $enTrabalho;
    private $email;
    private $emailSenha;
    private $curso;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getApelido()
    {
        return $this->apelido;
    }

    /**
     * @param mixed $apelido
     */
    public function setApelido($apelido): void
    {
        $this->apelido = $apelido;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg): void
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone): void
    {
        $this->telefone = $telefone;
    }

    /**
     * @return mixed
     */
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    /**
     * @param mixed $tipoUsuario
     */
    public function setTipoUsuario($tipoUsuario): void
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    /**
     * @return mixed
     */
    public function getEnResidencia()
    {
        return $this->enResidencia;
    }

    /**
     * @param mixed $enResidencia
     */
    public function setEnResidencia($enResidencia): void
    {
        $this->enResidencia = $enResidencia;
    }

    /**
     * @return mixed
     */
    public function getEnTrabalho()
    {
        return $this->enTrabalho;
    }

    /**
     * @param mixed $enTrabalho
     */
    public function setEnTrabalho($enTrabalho): void
    {
        $this->enTrabalho = $enTrabalho;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmailSenha()
    {
        return $this->emailSenha;
    }

    /**
     * @param mixed $emailSenha
     */
    public function setEmailSenha($emailSenha): void
    {
        $this->emailSenha = $emailSenha;
    }

    /**
     * @return mixed
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param mixed $curso
     */
    public function setCurso($curso): void
    {
        $this->curso = $curso;
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

    //distribuindo os valores
    public function setValores($array = array())
    {
        //senha gerada com a api do php
        $senha       = (isset($array['senha']) 	 	&&!empty($array['senha']))		?password_hash($array['senha'], PASSWORD_BCRYPT):null;
        $id_pessoa   = (isset($array['idPessoa'])	&& !empty($array['idPessoa']))	?$array['idPessoa']:null;
        //cadrastros que nao tenham um usuario definido sao do tipo usuario
        $tipoUsuario = (isset($array['tipoUsuario'])&&!empty($array['tipoUsuario']))? $array['tipoUsuario'] : "1";

        $this->setIdPessoa      ($id_pessoa);//id_pessoa
        $this->setSenha         ($senha);//senha
        $this->setTipoUsuario   ($tipoUsuario);
        $this->setNome          ((isset($array['nome']) 		&& !empty($array['nome']))			?$array['nome']			:null);
        $this->setApelido       ((isset($array['apelido']) 		&& !empty($array['apelido']))		?$array['apelido']		:null);
        $this->setCpf           ((isset($array['cpf']) 			&& !empty($array['cpf']))			?$array['cpf']			:null);
        $this->setRg            ((isset($array['rg']) 			&& !empty($array['rg']))			?$array['rg']			:null);
        $this->setLogin         ((isset($array['login']) 		&& !empty($array['login']))			?$array['login']		:null);
        $this->setTelefone      ((isset($array['telefone']) 	&& !empty($array['telefone']))		?$array['telefone']		:null);
        $this->setEnResidencia  ((isset($array['enResidencia']) && !empty($array['enResidencia']))	?$array['enResidencia']	:null);
        $this->setEnTrabalho    ((isset($array['enTrabalho']) 	&& !empty($array['enTrabalho']))	?$array['enTrabalho']	:null);
        $this->setEmail         ((isset($array['email']) 		&& !empty($array['email']))			?$array['email']		:null);
        $this->setEmailSenha    ((isset($array['emailSenha']) 	&& !empty($array['emailSenha'])) 	?$array['emailSenha']	:null);
        $this->setCurso         ((isset($array['curso']) 		&& !empty($array['curso']))			?$array['curso']		:null);
    }
}
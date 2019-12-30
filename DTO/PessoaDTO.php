<?php


class PessoaDTO
{
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


}
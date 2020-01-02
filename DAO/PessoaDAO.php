<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/conexao/conexao.php';
//$stmt->fetch busca uma tupla e é acessado com o nome['campo']
//$stmt->fetchALL busca varias tupla e é acessado com o nome[indice]['campo']
//classe de regra de negocio
class PessoaDAO
{
    public $pdo = null;

    //chamando a conexao para dentro de pdo
    public function __construct()
    {
        $this->pdo = Conexao::conecta_db();
    }

    //cadastra uma pessoa
    public function salvarPessoa(PessoaDTO $pessoaDTO)
    {
        try
        {
            //CALL `bd_cadastropessoa`.`cadastra_pessoa`('nome', 'apelido', 'login', 'senha', 'cpf', 'rg', 'numero de telefone', tipo de usuario,
            //						                     'endereço residencial', 'endereço trabalho','email', 'senha email', 'nome do curso');
            $sql = "CALL `bd_cadastropessoa`.`cadastra_pessoa`(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,@return)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $pessoaDTO->getNome());
            $stmt->bindValue(2, $pessoaDTO->getApelido());
            $stmt->bindValue(3, $pessoaDTO->getLogin());
            $stmt->bindValue(4, $pessoaDTO->getSenha());
            $stmt->bindValue(5, $pessoaDTO->getCpf());
            $stmt->bindValue(6, $pessoaDTO->getRg());
            $stmt->bindValue(7, $pessoaDTO->getTelefone());
            $stmt->bindValue(8, $pessoaDTO->getTipoUsuario());
            $stmt->bindValue(9, $pessoaDTO->getEnResidencia());
            $stmt->bindValue(10, $pessoaDTO->getEnTrabalho());
            $stmt->bindValue(11, $pessoaDTO->getEmail());
            $stmt->bindValue(12, $pessoaDTO->getEmailSenha());
            $stmt->bindValue(13, $pessoaDTO->getCurso());
            $sucesso = $stmt->execute();
            return $sucesso;

        }
        catch (PDOException $exc)
        {
            //mostra mensagem de erro dizendo que ja existe um usuario cadastrado
            //com o mesmo nome
            if ($exc->getCode() == 23000) {
                $msg = "Usuario Existente crie outro usuario";
                header("location: /Belfort/views/cadastroClienteContrato.php?mensagem=" . $msg);
                exit();
            } else {
                echo $exc->getMessage();
            }
        }
    }

    //lista uma pessoa
    public function listarPessoa(PessoaDTO $pessoaDTO)
    {
        try
        {

        }
        catch (PDOException $exc)
        {

        }
    }
    //lista todas pessoas
    public function listarTodasPessoas()
    {
        try
        {
            $sql = "select pe.id_pessoa, tu.descricao, pe.nome, pe.apelido, pe.login, dc.rg, dc.cpf, tel.numero, en.residencial, ema.email, cs.disciplina  from pessoa pe
                    inner join tipo_usuario tu 	on pe.tipo_usuario_id_tipo_usuario 	= tu.id_tipo_usuario
                    left join documento dc 		on pe.id_pessoa 					= dc.pessoa_id_pessoa
                    left join telefone tel 		on pe.id_pessoa 					= tel.pessoa_id_pessoa
                    left join endereco en 		on pe.id_pessoa 					= en.pessoa_id_pessoa
                    left join email ema 		on ema.endereco_id_endereco			= en.id_endereco
                    left join curso_pessoa cp 	on pe.id_pessoa 					= cp.pessoa_id_pessoa
                    left join curso cs 			on cs.id_curso 						= cp.curso_id_curso";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }
    //lista todas pessoas com limit
    public function listarPessoasLimit($paginaAtual, $itensPorPagina)
    {
        try
        {
            $sql = "select pe.id_pessoa, tu.descricao, pe.nome, pe.apelido, pe.login, dc.rg, dc.cpf, tel.numero, en.residencial, ema.email, cs.disciplina  from pessoa pe
                    inner join tipo_usuario tu 	on pe.tipo_usuario_id_tipo_usuario 	= tu.id_tipo_usuario
                    left join documento dc 		on pe.id_pessoa 					= dc.pessoa_id_pessoa
                    left join telefone tel 		on pe.id_pessoa 					= tel.pessoa_id_pessoa
                    left join endereco en 		on pe.id_pessoa 					= en.pessoa_id_pessoa
                    left join email ema 		on ema.endereco_id_endereco			= en.id_endereco
                    left join curso_pessoa cp 	on pe.id_pessoa 					= cp.pessoa_id_pessoa
                    left join curso cs 			on cs.id_curso 						= cp.curso_id_curso
                    limit {$itensPorPagina} offset {$paginaAtual}";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }



    //edita uma pessoa
    public function editarPessoa(PessoaDTO $pessoaDTO)
    {
        try
        {

        }
        catch (PDOException $exc)
        {

        }
    }
    //exclui uma pessoa
    public function excluirPessoa(PessoaDTO $pessoaDTO)
    {
        try
        {

        }
        catch (PDOException $exc)
        {

        }
    }

    //verifica se o login informado ja existe no banco de dados
    public function buscarLogin (PessoaDTO $pessoaDTO)
    {
        try
        {
            //mudar para quantidade e nao trazer uma registro
            $sql = "select login from pessoa where login = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1,$pessoaDTO->getLogin());
            $stmt->execute();
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }



    //enchendo o banco de dados
    //cadastra uma pessoa
    public function enchendoBanco()
    {
        try
        {
            //CALL `bd_cadastropessoa`.`cadastra_pessoa`('nome', 'apelido', 'login', 'senha', 'cpf', 'rg', 'numero de telefone', tipo de usuario,
            //						                     'endereço residencial', 'endereço trabalho','email', 'senha email', 'nome do curso');
            $sql = "CALL `bd_cadastropessoa`.`cadastra_pessoa`('rogerio', '', 'login', 'senha', 'cpf', 'rg', 'numero de telefone', 1, 
 						'endereço residencial', 'endereço trabalho','email', 'senha email', 'nome do curso', @sucesso)";

            $stmt = $this->pdo->prepare($sql);
            $sucesso = $stmt->execute();
            return $sucesso;

        }
        catch (PDOException $exc)
        {
            //mostra mensagem de erro dizendo que ja existe um usuario cadastrado
            //com o mesmo nome
            if ($exc->getCode() == 23000) {
                $msg = "Usuario Existente crie outro usuario";
                header("location: /Belfort/views/cadastroClienteContrato.php?mensagem=" . $msg);
                exit();
            } else {
                echo $exc->getMessage();
            }
        }
    }

}
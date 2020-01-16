<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/crud_php/DAO/conexao/conexao.php';
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
            $sql = "CALL `bd_cadastropessoa`.`cadastra_pessoa`(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @return)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $pessoaDTO->getNome(), 2);
            $stmt->bindValue(2, $pessoaDTO->getApelido(), 2);
            $stmt->bindValue(3, $pessoaDTO->getLogin(), 2);
            $stmt->bindValue(4, $pessoaDTO->getSenha(), 2);
            $stmt->bindValue(5, $pessoaDTO->getCpf(), 2);
            $stmt->bindValue(6, $pessoaDTO->getRg(), 2);
            $stmt->bindValue(7, $pessoaDTO->getTelefone(), 2);
            $stmt->bindValue(8, $pessoaDTO->getTipoUsuario(), 1);
            $stmt->bindValue(9, $pessoaDTO->getEnResidencia(), 2);
            $stmt->bindValue(10, $pessoaDTO->getEnTrabalho(), 2);
            $stmt->bindValue(11, $pessoaDTO->getEmail(), 2);
            $stmt->bindValue(12, $pessoaDTO->getEmailSenha(), 2);
            $stmt->bindValue(13, $pessoaDTO->getCurso(), 1);
            $sucesso = $stmt->execute();
            return $sucesso;
        }
        catch (PDOException $exc)
        {
            if ($exc->getCode() == 23000) {
                $msg = "Usuario Existente crie outro usuario";
                header("location: /crud_php/index.php?mensagem=" . $msg);
                exit();
            } else {
                echo $exc->getMessage();
            }
        }
    }

    //busca uma pessoa por id para o edite
    public function listarPessoa($idPessoa)
    {
        try
        {
            //mudar para quantidade e nao trazer uma registro
            $sql = "select pe.id_pessoa, tu.descricao, tu.id_tipo_usuario, pe.nome, pe.apelido, pe.login, 
                    dc.rg, dc.cpf, tel.numero, en.residencial, en.trabalho, ema.email, ema.senha as email_senha, 
                    cs.disciplina, cs.id_curso
                    from pessoa pe
                    inner join tipo_usuario tu 	on pe.tipo_usuario_id_tipo_usuario 	= tu.id_tipo_usuario
                    left join documento dc 		on pe.id_pessoa 					= dc.pessoa_id_pessoa
                    left join telefone tel 		on pe.id_pessoa 					= tel.pessoa_id_pessoa
                    left join endereco en 		on pe.id_pessoa 					= en.pessoa_id_pessoa
                    left join email ema 		on ema.endereco_id_endereco			= en.id_endereco
                    left join curso_pessoa cp 	on pe.id_pessoa 					= cp.pessoa_id_pessoa
                    left join curso cs 			on cs.id_curso 						= cp.curso_id_curso
                    where pe.id_pessoa = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1,$idPessoa);
            $stmt->execute();
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //contador para paginacao, pesquisa uma pessoa por nome
    public function countPessoa($nome)
    {
        try
        {
            $sql = "select count(*) as totalPessoa
                    from pessoa
                    where nome like  :nome";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nome','%'.$nome.'%', PDO::PARAM_STR);
            $stmt->execute();
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuarios['totalPessoa'];
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //pesquisa pessoa por nome mais limite da pagina
    public function buscarPessoaLimit($nome,$itensPorPagina, $paginaAtual)
    {
        try
        {
            $sql = "select pe.id_pessoa, tu.descricao, tu.id_tipo_usuario, pe.nome, pe.apelido, pe.login, 
                    dc.rg, dc.cpf, tel.numero, en.residencial, en.trabalho, ema.email, ema.senha as email_senha, 
                    cs.disciplina, cs.id_curso
                    from pessoa pe
                    inner join tipo_usuario tu 	on pe.tipo_usuario_id_tipo_usuario 	= tu.id_tipo_usuario
                    left join documento dc 		on pe.id_pessoa 					= dc.pessoa_id_pessoa
                    left join telefone tel 		on pe.id_pessoa 					= tel.pessoa_id_pessoa
                    left join endereco en 		on pe.id_pessoa 					= en.pessoa_id_pessoa
                    left join email ema 		on ema.endereco_id_endereco			= en.id_endereco
                    left join curso_pessoa cp 	on pe.id_pessoa 					= cp.pessoa_id_pessoa
                    left join curso cs 			on cs.id_curso 						= cp.curso_id_curso
                    where pe.nome like  :nome
                    limit :itenPagina offset :paginaAtual";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nome','%'.$nome.'%', PDO::PARAM_STR);
            $stmt->bindValue(":itenPagina",$itensPorPagina,PDO::PARAM_INT);
            $stmt->bindValue(":paginaAtual",$paginaAtual,PDO::PARAM_INT);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //contador para paginação, mostra quantidade total de pessoas cadastradas
    public function countPessoas()
    {
        try
        {
            $sql = "select count(*) as totalPessoa from pessoa;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuarios['totalPessoa'];
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //lista todas pessoas com limit para paginação
    public function listarPessoasLimit($paginaAtual, $itensPorPagina)
    {
        try
        {
            $sql = "select pe.id_pessoa, tu.descricao, pe.nome, pe.apelido, pe.login, 
                    dc.rg, dc.cpf, tel.numero, en.residencial, en.trabalho, ema.email, ema.senha, cs.disciplina  
                    from pessoa pe
                    inner join tipo_usuario tu 	on pe.tipo_usuario_id_tipo_usuario 	= tu.id_tipo_usuario
                    left join documento dc 		on pe.id_pessoa 					= dc.pessoa_id_pessoa
                    left join telefone tel 		on pe.id_pessoa 					= tel.pessoa_id_pessoa
                    left join endereco en 		on pe.id_pessoa 					= en.pessoa_id_pessoa
                    left join email ema 		on ema.endereco_id_endereco			= en.id_endereco
                    left join curso_pessoa cp 	on pe.id_pessoa 					= cp.pessoa_id_pessoa
                    left join curso cs 			on cs.id_curso 						= cp.curso_id_curso
                    order by id_pessoa limit :itenPagina offset :paginaAtual";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":itenPagina",$itensPorPagina,PDO::PARAM_INT);
            $stmt->bindValue(":paginaAtual",$paginaAtual,PDO::PARAM_INT);
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
            $sql = "CALL `bd_cadastropessoa`.`atualizar_pessoa`(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @return);";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $pessoaDTO->getIdPessoa()       , PDO::PARAM_INT);
            $stmt->bindValue(2, $pessoaDTO->getNome()           , PDO::PARAM_STR);
            $stmt->bindValue(3, $pessoaDTO->getApelido()        , PDO::PARAM_STR);
            $stmt->bindValue(4, $pessoaDTO->getLogin()          , PDO::PARAM_STR);
            $stmt->bindValue(5, $pessoaDTO->getSenha()          , PDO::PARAM_STR);
            $stmt->bindValue(6, $pessoaDTO->getCpf()            , PDO::PARAM_STR);
            $stmt->bindValue(7, $pessoaDTO->getRg()             , PDO::PARAM_STR);
            $stmt->bindValue(8, $pessoaDTO->getTelefone()       , PDO::PARAM_STR);
            $stmt->bindValue(9, $pessoaDTO->getTipoUsuario()    , PDO::PARAM_INT);
            $stmt->bindValue(10, $pessoaDTO->getEnResidencia()  , PDO::PARAM_STR);
            $stmt->bindValue(11, $pessoaDTO->getEnTrabalho()    , PDO::PARAM_STR);
            $stmt->bindValue(12, $pessoaDTO->getEmail()         , PDO::PARAM_STR);
            $stmt->bindValue(13, $pessoaDTO->getEmailSenha()    , PDO::PARAM_STR);
            $stmt->bindValue(14, $pessoaDTO->getCurso()         , PDO::PARAM_INT);
            $sucesso = $stmt->execute();
            return $sucesso;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //exclui uma pessoa
    //por tabela estar usando cascade, update e exclusao serao executados em todas as tabelas
    //com FK
    public function excluirPessoa($idPessoa)
    {
        try
        {
            $sql = "DELETE FROM pessoa WHERE id_pessoa = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idPessoa, 1);
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

    //verifica se o login informado ja existe no banco de dados
    public function buscarLogin ($login)
    {
        try
        {
            $sql = "select login from pessoa where login = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1,$login,2);
            $stmt->execute();
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuarios;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //buscando todos tipos cadastrados de usuario
    public function buscarTipoUsuario ()
    {
        try
        {
            $sql = "select id_tipo_usuario, descricao from tipo_usuario";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $tipoUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tipoUsuario;
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
            //('nome', 'apelido', 'login', 'senha', 'cpf', 'rg', 'numero de telefone', tipo de usuario,
            //'endereço residencial', 'endereço trabalho','email', 'senha email', 'nome do curso');
            $sql = "CALL `bd_cadastropessoa`.`cadastra_pessoa`('rogerio', 'apelido', 'login', 'senha', 'cpf', 'rg', 'numero de telefone', 1, 
 						'endereço residencial', 'endereço trabalho','email', 'senha email', 1, @sucesso)";

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
                header("location: /crud_php/index.php?mensagem=" . $msg);
                exit();
            } else {
                echo $exc->getMessage();
            }
        }
    }

}
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
            //CALL `bd_cadastropessoa`.`cadastra_pessoa`('nome', 'apelido', 'login', 'senha', 'cpf', 'rg', 'numero de telefone', tipo de usuario,
            //						                     'endereço residencial', 'endereço trabalho','email', 'senha email', 'nome do curso');
            $sql = "CALL `bd_cadastropessoa`.`cadastra_pessoa`(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @return)";

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

    //lista todos cadastros
    public function listarTodasPessoas()
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
                    order by id_pessoa limit {$itensPorPagina} offset {$paginaAtual}";

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
            $sql = "CALL `bd_cadastropessoa`.`atualizar_pessoa`(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @return);";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $pessoaDTO->getIdPessoa());
            $stmt->bindValue(2, $pessoaDTO->getNome());
            $stmt->bindValue(3, $pessoaDTO->getApelido());
            $stmt->bindValue(4, $pessoaDTO->getLogin());
            $stmt->bindValue(5, $pessoaDTO->getSenha());
            $stmt->bindValue(6, $pessoaDTO->getCpf());
            $stmt->bindValue(7, $pessoaDTO->getRg());
            $stmt->bindValue(8, $pessoaDTO->getTelefone());
            $stmt->bindValue(9, $pessoaDTO->getTipoUsuario());
            $stmt->bindValue(10, $pessoaDTO->getEnResidencia());
            $stmt->bindValue(11, $pessoaDTO->getEnTrabalho());
            $stmt->bindValue(12, $pessoaDTO->getEmail());
            $stmt->bindValue(13, $pessoaDTO->getEmailSenha());
            $stmt->bindValue(14, $pessoaDTO->getCurso());
            $sucesso = $stmt->execute();
            return $sucesso;
        }
        catch (PDOException $exc)
        {
            echo $exc->getMessage();
        }
    }

    //exclui uma pessoa
    //por tabela estar usando cascade, update e exclusao senrao executados em todas as tabelas
    //com FK
    public function excluirPessoa($idPessoa)
    {
        try
        {
            $sql = "DELETE FROM pessoa WHERE id_pessoa = ?";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idPessoa);
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
    public function buscarLogin (PessoaDTO $pessoaDTO)
    {
        try
        {
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
            //CALL `bd_cadastropessoa`.`cadastra_pessoa`('nome', 'apelido', 'login', 'senha', 'cpf', 'rg', 'numero de telefone', tipo de usuario,
            //						                     'endereço residencial', 'endereço trabalho','email', 'senha email', 'nome do curso');
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
                header("location: /Belfort/views/cadastroClienteContrato.php?mensagem=" . $msg);
                exit();
            } else {
                echo $exc->getMessage();
            }
        }
    }

}
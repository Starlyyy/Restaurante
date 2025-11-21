<?php
#Classe DAO para o model de Usuario

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO {
    
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();        
    }

    public function findById(int $id) {
        $sql = "SELECT * FROM usuario 
                WHERE id_usuario = ?";
        $stm = $this->conexao->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        if(count($result) == 0)
           return null;
           
        if(count($result) > 1)
           die("Mais de um usuário encontrado para o login e senha!");

        $usuarios = $this->mapUsuarios($result);
        return $usuarios[0];
    }

    public function findByLoginSenha(string $nomeUsuario, string $senha) {
        $sql = "SELECT * FROM usuario 
                WHERE BINARY nomeUsuario = ? AND BINARY senhaUsuario = ?";
        $stm = $this->conexao->prepare($sql);    
        $stm->execute([$nomeUsuario, $senha]);
        $result = $stm->fetchAll();

        if(count($result) == 0)
           return null;
           
        if(count($result) > 1)
           die("Mais de um usuário encontrado para o login e senha!");

        $usuarios = $this->mapUsuarios($result);
        return $usuarios[0];
    }

    public function alterar(Usuario $usuario) {
        try {
            $sql = "UPDATE usuario SET nomeUsuario = ?, 
                            senhaUsuario= ?, fotoUsuario = ?, isAdm = ?
                    WHERE id_usuario = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([
                $usuario->getNomeUsuario(),
                $usuario->getSenhaUsuario(), $usuario->getFotoUsuario(), $usuario->getIsAdm(),
                $usuario->getIdUsuario()
            ]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    }

    private function mapUsuarios(array $result) {
        $usuarios = array();

        foreach($result as $reg) {
            $usuario = new Usuario(
            $reg['id_usuario'], 
            $reg['nomeUsuario'], 
            $reg['senhaUsuario'], 
            $reg['isAdm'],
            $reg['fotoUsuario']);
                                   

            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

}
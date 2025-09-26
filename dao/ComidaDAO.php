<?php

require_once (__DIR__ . "/../util/Connection.php");
require_once (__DIR__ . "/../model/Comida.php");

class ComidaDAO{
    private PDO $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function inserir(Comida $comida){
        try {
            $sql = "INSERT INTO comida (nome, descricao, preco) VALUES (?, ?, ?)";
            $stm = $this->connection->prepare($sql);
            $stm->execute([
                $comida->getNome(),
                $comida->getDescricao(),
                $comida->getPreco()
            ]);
    
            $comida->setId($this->connection->lastInsertId());
            return $comida;
        } catch (PDOException $e) {
            print($e->getMessage());
            die;
        }
    }

    public function alterar(Comida $comida){
        try {
            $sql = "UPDATE comida 
                    SET nome = ?, descricao = ?, preco = ?
                    WHERE id_comida = ?";
            $stm = $this->connection->prepare($sql);
            $stm->execute([
                $comida->getNome(),
                $comida->getDescricao(),
                $comida->getPreco(),
                $comida->getId()
            ]);
    
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function excluir(int $id) {
        try {
            # code...
            $sql = 'delete from comida where id_comida = :id';
            $stm = $this->connection->prepare($sql);
            $stm->bindValue('id', $id);
            $stm->execute();
    
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }

    }

    public function listar() {
        $sql = "SELECT * FROM comida";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        return $this->map($resultado);
    }

    public function buscarPorId(int $id){
        $sql = "SELECT * FROM comida WHERE id_comida = ?";
        $stm = $this->connection->prepare($sql);
        $stm->execute([$id]);
        $resultado = $stm->fetchAll();

        $comidas = $this->map($resultado);
        
        if(count($comidas) > 0){
            return $comidas[0];
        }else{
            return NULL;
        } 
    }

    private function map(array $resultado) {
        $comidas = [];

        foreach($resultado as $r){
            $comida = new Comida();

            $comida->setId($r['id_comida']);
            $comida->setNome($r['nome']);
            $comida->setDescricao($r['descricao']);
            $comida->setPreco($r['preco']);

            array_push($comidas, $comida);
        }

        return $comidas;
    }
}
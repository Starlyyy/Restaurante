<?php

require_once (__DIR__ . "/../util/Connection.php");
require_once (__DIR__ . "/../model/Bebida.php");

class BebidaDAO{
    private PDO $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM bebida";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        return $this->map($resultado);
    }

    public function inserir(Bebida $bebida){
        try {
            $sql = "INSERT INTO bebida (nome, alcoolica, preco) VALUES (?, ?, ?)";
            $stm = $this->connection->prepare($sql);
            $stm->execute([
                $bebida->getNome(),
                $bebida->getAlcoolica(),
                $bebida->getPreco()
            ]);
    
            $bebida->setId($this->connection->lastInsertId());
            return $bebida;
        } catch (PDOException $e) {
            print($e->getMessage());
            die;
        }
    }

    public function excluir(int $id) {
        try {
            # code...
            $sql = 'delete from bebida where id_bebida = :id';
            $stm = $this->connection->prepare($sql);
            $stm->bindValue('id', $id);
            $stm->execute();
    
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }

    }

    public function alterar(Bebida $bebida){
        try {
            $sql = "UPDATE bebida 
                    SET nome = ?, alcoolica = ?, preco = ?
                    WHERE id_bebida = ?";
            $stm = $this->connection->prepare($sql);
            $stm->execute([
                $bebida->getNome(),
                $bebida->getAlcoolica(),
                $bebida->getPreco(),
                $bebida->getId()
            ]);
    
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function buscarPorId(int $id){
        $sql = "SELECT * FROM bebida WHERE id_bebida = ?";
        $stm = $this->connection->prepare($sql);
        $stm->execute([$id]);
        $resultado = $stm->fetchAll();

        $bebidas = $this->map($resultado);
        
        if(count($bebidas) > 0){
            return $bebidas[0];
        }else{
            return NULL;
        } 
    }

    private function map(array $resultado) {
        $bebidas = [];

        foreach($resultado as $r){
            $bebida = new Bebida();
            
            $bebida->setId($r['id_bebida']);
            $bebida->setNome($r['nome']);
            $bebida->setAlcoolica($r['alcoolica']);
            $bebida->setPreco($r['preco']);

            array_push($bebidas, $bebida);
        }
        
        return $bebidas;
    }
}
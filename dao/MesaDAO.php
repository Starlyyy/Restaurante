<?php

require_once (__DIR__ . "/../util/Connection.php");
require_once (__DIR__ . "/../model/Mesa.php");

class MesaDAO{
    private PDO $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM mesa";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $resultados = $stm->fetchAll();

        $mesas = [];
        foreach ($resultados as $row) {
            $mesas[] = $this->map($row);
        }
        return $mesas;
    }

    public function buscarPorId(int $id){
        $sql = "SELECT * FROM mesa WHERE id_mesa = ?";
        $stm = $this->connection->prepare($sql);
        $stm->execute([$id]);
        $row = $stm->fetch();

        if($row){
            return $this->map($row);
        }else{
            return NULL;
        } 
    }

    private function map(array $resultado) {

        $mesa = new Mesa();
        $mesa->setId((int)($resultado['id_mesa'] ?? 0));
        $mesa->setCapacidade((int)($resultado['capacidade'] ?? 0));
        return $mesa;
    }
}
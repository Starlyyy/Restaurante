<?php

require_once (__DIR__ . "/../util/Connection.php");
require_once (__DIR__ . "/../model/Pedido.php");

require_once(__DIR__ . "/MesaDAO.php");
require_once(__DIR__ . "/ComidaDAO.php");
require_once(__DIR__ . "/BebidaDAO.php");

class PedidoDAO{
    private PDO $connection;
    private MesaDAO $mesaDAO;
    private ComidaDAO $comidaDAO;
    private BebidaDAO $bebidaDAO;
    
    public function __construct(){
        $this->connection = Connection::getConnection();
        $this->mesaDAO = new MesaDAO();
        $this->comidaDAO = new ComidaDAO();
        $this->bebidaDAO = new BebidaDAO();
    }

    public function inserir(Pedido $pedido){
        try{
            $sql = "INSERT INTO pedido (id_mesa, id_comida, id_bebida, total)
                    VALUES (?, ?, ?, ?)";
            $stm = $this->connection->prepare($sql);
            $stm->execute([
                $pedido->getMesa()->getId(), 
                $pedido->getComida() ? $pedido->getComida()->getId() : null, 
                $pedido->getBebida() ? $pedido->getBebida()->getId() : null,
                $pedido->getTotal()
                        ]);
            return NULL;
        }catch(PDOException $e){
            return $e;
        }
    }
    
    public function listar() {
        $sql = "SELECT * from pedido";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        return $this->map($resultado);
    }

    public function buscarPorId(int $id) {
        $sql = "SELECT * FROM pedido WHERE id_pedido = ?";
        $stm = $this->connection->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $pedidos = $this->map($result);

        if(count($pedidos) > 0)
            return $pedidos[0];
        else
            return NULL;
    }

    public function alterar(Pedido $pedido) {
        try {
            $sql = "UPDATE pedido SET id_mesa = ?, id_comida = ?, id_bebida = ?, total = ?
                    WHERE id_pedido = ?";
            $stm = $this->connection->prepare($sql);
            $stm->execute([
                $pedido->getMesa()->getId(),
                $pedido->getComida() ? $pedido->getComida()->getId() : null,
                $pedido->getBebida() ? $pedido->getBebida()->getId() : null,
                $pedido->getTotal(),
                $pedido->getId()
            ]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    }

    public function excluirPorId(int $id) {
        try{
            $sql = "DELETE FROM pedido WHERE id_pedido = :id";
            $stm = $this->connection->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->execute();

            return NULL;
        }catch(PDOException $e){
            return $e;
        }
    }

    private function map(array $resultado) {
        $pedidos = [];
        foreach($resultado as $r) {
            $mesa = $this->mesaDAO->buscarPorId((int)$r['id_mesa']);

            $comida = null;
            if (!empty($r['id_comida'])) {
                $comida = $this->comidaDAO->buscarPorId((int)$r['id_comida']);
            }

            $bebida = null;
            if (!empty($r['id_bebida'])) {
                $bebida = $this->bebidaDAO->buscarPorId((int)$r['id_bebida']);
            }

            $pedido = new Pedido($mesa, $comida, $bebida);
            $pedido->setId((int)$r['id_pedido']);

            array_push($pedidos, $pedido);
        }
        return $pedidos;
    }

}
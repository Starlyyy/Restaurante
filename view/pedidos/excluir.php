<?php
require_once(__DIR__ . "/../../controller/PedidoController.php");

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pedidoController = new PedidoController();
    $pedidoController->excluirPorId($id);
    header("Location: listar.php");
    exit;
} else {
    echo "ID do pedido não informado.";
}
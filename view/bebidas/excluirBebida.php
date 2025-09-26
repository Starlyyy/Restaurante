<?php 

require_once(__DIR__ . '/../../controller/BebidaController.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new BebidaController();
    $controller->excluir($id);
    header ("Location: ../cardapio.php");
    exit;
} else {
    echo "ID da bebida não informado.";
}
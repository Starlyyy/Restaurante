<?php 

require_once(__DIR__ . '/../../controller/ComidaController.php');
include_once __DIR__ . '/../adm/validar.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new ComidaController();
    $controller->excluir($id);
    header ("Location: ../cardapio.php");
    exit;
} else {
    echo "ID da comida não informado.";
}
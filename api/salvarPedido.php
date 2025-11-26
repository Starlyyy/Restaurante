<?php 

require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/Mesa.php';
require_once __DIR__ . '/../model/Bebida.php';
require_once __DIR__ . '/../model/Comida.php';
require_once __DIR__ . '/../controller/PedidoController.php';
require_once __DIR__ . '/../controller/MesaController.php';
require_once __DIR__ . '/../controller/BebidaController.php';
require_once __DIR__ . '/../controller/ComidaController.php';

$idMesa = is_numeric($_POST['idMesa']) ? $_POST['idMesa'] : 0;
$idBebida = is_numeric($_POST['idBebida']) ? $_POST['idBebida'] : 0;
$idComida = is_numeric($_POST['idComida']) ? $_POST['idComida'] : 0;

$pedidoController = new PedidoController();

$MesaCon = new MesaController();
$mesa = $MesaCon->buscarPorId($idMesa);

$BebidaCon = new BebidaController();
$bebida = $BebidaCon->buscarPorId($idBebida);

$ComidaCon = new ComidaController();
$comida = $ComidaCon->buscarPorId($idComida);

$pedido = new Pedido($mesa, $comida, $bebida);

$erros = $pedidoController->inserir($pedido);

$msgErro = '';
if ($erros) {
    $msgErro = implode("\n", $erros);
}   

echo $msgErro;
<?php 

require_once __DIR__ . '/../model/Bebida.php';
require_once __DIR__ . '/../controller/BebidaController.php';

$nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
$alcoolica = trim($_POST['alcoolica']) ? trim($_POST['alcoolica']) : null;
$preco = trim($_POST['preco']) ? trim($_POST['preco']) : null;

$bebida = new Bebida();
$bebida->setNome($nome);
$bebida->setAlcoolica($alcoolica);
$bebida->setPreco($preco);

$bebidaController = new BebidaController();
$erros = $bebidaController->inserir($bebida);

$msgErro = '';
if ($erros) {
    $msgErro = implode("\n", $erros);
}

echo $msgErro;
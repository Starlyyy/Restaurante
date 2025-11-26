<?php

require_once __DIR__ . '/../model/Comida.php';
require_once __DIR__ . '/../controller/ComidaController.php';

$nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
$descricao = trim($_POST['descricao']) ? trim($_POST['descricao']) : null;
$preco = trim($_POST['preco']) ? trim($_POST['preco']) : null;

$comida = new Comida();
$comida->setNome($nome);
$comida->setDescricao($descricao);
$comida->setPreco($preco);

$comidaController = new ComidaController();
$erros = $comidaController->inserir($comida);

$msgErro = '';
if ($erros) {
    $msgErro = implode("\n", $erros);
}

echo $msgErro;
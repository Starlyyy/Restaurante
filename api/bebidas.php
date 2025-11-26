<?php
require_once __DIR__ . '/../controller/BebidaController.php';


$alcoolica = isset($_GET['alcoolica']) ? $_GET['alcoolica'] : null; //get pq li em algum esapco que era o melhor para leituras sem nenhuma alteração.

$cont = new BebidaController();
$bebidas = $cont->listar();

$result = [];
foreach ($bebidas as $b) {

    if ($alcoolica !== null && $alcoolica !== '') {
        if ($b->getAlcoolica() !== $alcoolica) continue;
    }
    $result[] = [
        'id' => $b->getId(),
        'nome' => $b->getNome(),
        'alcoolica' => $b->getAlcoolica(),
        'preco' => $b->getPreco()
    ];
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;

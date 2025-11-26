<?php

include_once(__DIR__ . "/../login/validar.php");

require_once(__DIR__ . "/../../controller/PedidoController.php");
require_once(__DIR__ . "/../../controller/MesaController.php");
require_once(__DIR__ . "/../../controller/BebidaController.php");
require_once(__DIR__ . "/../../controller/ComidaController.php");

$pedidoController = new PedidoController();
$mesaController = new MesaController();
$bebidaController = new BebidaController();
$comidaController = new ComidaController();

$msgErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $mesaId = $_POST['mesa'] ?? null;
    $bebidaId = $_POST['bebida'] ?? null;
    $comidaId = $_POST['comida'] ?? null;

    // Validação: mesa obrigatória
    if (!$mesaId) {
        $msgErro = "Selecione uma mesa!";
        $pedido = $pedidoController->buscarPorId($id);
        $mesas = $mesaController->listar();
        $bebidas = $bebidaController->listar();
        $comidas = $comidaController->listar();
    } else {
        $mesa = $mesaId ? $mesaController->buscarPorId((int)$mesaId) : null;
        $bebida = $bebidaId ? $bebidaController->buscarPorId((int)$bebidaId) : null;
        $comida = $comidaId ? $comidaController->buscarPorId((int)$comidaId) : null;

        $pedido = new Pedido($mesa, $comida, $bebida);
        $pedido->setId($id);

        $pedidoController->alterar($pedido);

        header("Location: listar.php");
        exit;
    }
} elseif (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pedido = $pedidoController->buscarPorId($id);
    $mesas = $mesaController->listar();
    $bebidas = $bebidaController->listar();
    $comidas = $comidaController->listar();
} else {
    echo "ID do pedido não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Pedido/alterar.css">
    <title>Alterar</title>
</head>
<body>
    
    <a href="listar.php">🠔 Voltar</a>
    
    <h3>Alterar Pedido</h3>
    <?php if ($msgErro): ?>
        <div class="alert alert-danger"><?= $msgErro ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= $pedido->getId() ?>">
        <label>Mesa:</label>
        <select name="mesa" required>
            <?php foreach($mesas as $mesa): ?>
                <option value="<?= $mesa->getId() ?>" <?= ($pedido->getMesa() && $pedido->getMesa()->getId() == $mesa->getId()) ? 'selected' : '' ?>>
                    <?= $mesa->getId() ?>
                </option>
            <?php endforeach; ?>
        </select><br>
    
        <label>Comida:</label>
        <select name="comida">
            <option value="">Nenhuma</option>
            <?php foreach($comidas as $comida): ?>
                <option value="<?= $comida->getId() ?>" <?= ($pedido->getComida() && $pedido->getComida()->getId() == $comida->getId()) ? 'selected' : '' ?>>
                    <?= $comida->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select><br>
    
        <label>Bebida:</label>
        <select name="bebida">
            <option value="">Nenhuma</option>
            <?php foreach($bebidas as $bebida): ?>
                <option value="<?= $bebida->getId() ?>" <?= ($pedido->getBebida() && $pedido->getBebida()->getId() == $bebida->getId()) ? 'selected' : '' ?>>
                    <?= $bebida->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select><br>
    
        <button type="submit">Salvar alterações</button>
    </form>
</body>
</html>

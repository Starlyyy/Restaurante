<?php
    require_once(__DIR__ . "/../../controller/PedidoController.php");   
    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

    //Chamar o controller para obter a lista de Pedidos
    $pedidoCont = new PedidoController();
    $lista = $pedidoCont->listar();
    
    // print_r($lista);
    include(__DIR__ . "/../include/menu.php")
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/Pedido/listar.css">
    <title>Listagem Pedidos</title>
</head>
<body>

    <h3>Listagem de Pedidos</h3> 
    
    <div class="actions">
        <div>
            <a href="formulario.php">Inserir</a>
        </div>
        
        <div>
            <a href="../cardapio.php">Cardapio</a>
        </div>
    </div>
    
    
    <table class="table table-striped">
        <!-- Cabeçalho -->
        <tr>
            <th>ID</th>
            <th>Mesa</th>
            <th>Comida</th>
            <th>Bebida</th>
            <th>Preco total</th>
            <th></th>
            <th></th>
        </tr>
    
        <!-- Dados -->
        <?php foreach($lista as $pedido): ?>
            <tr>
                <td><?= $pedido->getId() ?></td>
                <td><?= $pedido->getMesa()->getId() ?></td>
                <td><?= $pedido->getComida() ? $pedido->getComida()->getNome() : '-' ?></td>
                <td><?= $pedido->getBebida() ? $pedido->getBebida()->getNome() : '-' ?></td>
                <td><?= $pedido->getTotal() ?></td>
                <td>
                    <a href="alterar.php?id=<?= $pedido->getId() ?>">
                        <img src="../../img/btn_editar.png">
                    </a> 
                </td>
                <td>
                    <a href="excluir.php?id=<?= $pedido->getId() ?>"
                        onclick="return confirm('Confirma a exclusão?');">
                        <img src="../../img/btn_excluir.png">
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    
    
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
</body>
</html>


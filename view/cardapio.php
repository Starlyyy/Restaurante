<?php 
    require_once(__DIR__."../../controller/BebidaController.php");
    require_once(__DIR__."../../controller/ComidaController.php");
    require_once(__DIR__."../../controller/MesaController.php");
    require_once(__DIR__."../../controller/PedidoController.php");

    $controladorBebida = new BebidaController();
    $controladorComida = new ComidaController();

    $bebidas = $controladorBebida->listar();
    $comidas = $controladorComida->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - OverCozido</title>
    <link rel="stylesheet" href="../view/styles/Pedido/cardapio.css">

</head>
<body>
    
    <header>🍲 Restaurante OverCozido 🍲</header>
    
    <a href="../view/pedidos/listar.php">🠔 Voltar</a>
    
    <div class="container">
        <div class="cardapio-section">
            <div class="header-section">
                <a href="../view/comidas/formComida.php" class="linkCrudCB">+</a>
                <h2>Comidas</h2>
            </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($comidas as $comida): ?>
                <tr>
                    <td><?= $comida->getId() ?></td>
                    <td><?= $comida->getNome() ?></td>
                    <td><?= $comida->getDescricao() ?></td>
                    <td>R$ <?= number_format($comida->getPreco(), 2, ',', '.') ?></td>
                    <td><a href="../view/comidas/alterarComida.php?id=<?= $comida->getId() ?>"><img src="../img/btn_editar.png" alt=""></a></td>
                    <td><a href="../view/comidas/excluirComida.php?id=<?= $comida->getId() ?>"><img src="../img/btn_excluir.png" alt=""></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="cardapio-section">
            <div class="header-section">
                <a href="../view/bebidas/formBebida.php" class="linkCrudCB">+</a>
                <h2>Bebidas</h2>
            </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Preço</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($bebidas as $bebida): ?>
                <tr>
                    <td><?= $bebida->getId() ?></td>
                    <td><?= $bebida->getNome() ?></td>
                    <td><?= $bebida->getAlcoolica() == "S"? "Alcoólica" : "Sem Álcool" ?></td>
                    <td>R$ <?= number_format($bebida->getPreco(), 2, ',', '.') ?></td>
                    <td><a href="../view/bebidas/alterarBebida.php?id=<?= $bebida->getId() ?>"><img src="../img/btn_editar.png" alt=""></a></td>
                    <td><a href="../view/bebidas/excluirBebida.php?id=<?= $bebida->getId() ?>"><img src="../img/btn_excluir.png" alt=""></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>

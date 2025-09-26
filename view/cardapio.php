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

    <!-- <style>
        /* ====== VARIÁVEIS DE CORES TERROSAS ====== */
        :root {
        --bege-claro: #fbe9e7;
        --terracota: #d2695e;
        --argila: #a0522d;
        --tijolo: #8b3e2f;
        --marrom-suave: #6d4c41;
        --marrom-escuro: #3e2723;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--marrom-suave);
            color: var(--marrom-escuro);
            margin: 0;
            padding: 2rem;
        }

        a[href='../view/pedidos/listar.php']{
            display: inline-block;
            margin-bottom: 1rem;
            padding: 0.6rem 1rem;
            background: var(--terracota);
            color: var(--bege-claro);
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.3s;
        }

        a[href='../view/pedidos/listar.php']:hover{
            background: #c86b4f;
            transform: translateY(-2px);
        }

        header {
            background: var(--terracota);
            color: var(--bege-claro);
            text-align: center;
            padding: 20px;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 2px;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .container {
            display: flex;
            justify-content: space-around;
            margin: 40px auto;
            max-width: 1200px;
            gap: 30px;
        }

        .cardapio-section {
            flex: 1;
            background: var(--bege-claro);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--terracota);
            padding: 15px;
        }

        .header-section h2 {
            color: var(--bege-claro);
            text-align: center;
            float: right;
            font-size: 1.5rem;
            margin: 0;
            flex: 1;
        }

        .linkCrudCB {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--bege-claro);
            color: var(--terracota);
            text-decoration: none;
            font-size: 2rem;
            font-weight: bold;
            border-radius: 50%;
            transition: all 0.3s ease;
            border: 2px solid var(--bege-claro);
        }

        .linkCrudCB:hover {
            background: var(--terracota);
            color: var(--bege-claro);
            border: 2px solid var(--bege-claro);
            transform: scale(1.1);
        }

        .cardapio-section > a {
            display: inline-block;
            margin: 15px;
            padding: 0.5rem 1rem;
            background: var(--terracota);
            color: var(--bege-claro);
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.3s;
        }

        .cardapio-section > a:hover {
            background: #c86b4f;
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: var(--terracota);
            color: var(--bege-claro);
            padding: 12px;
            text-align: left;
            font-size: 1rem;
            border: 1px solid #e0c6b9;
        }

        td {
            padding: 12px;
            border-top: 1px solid #e0c6b9;
            font-size: 0.95rem;
            color: var(--marrom-escuro);
        }

        tr:nth-child(even) {
            background: #f5e1d2;
        }

        tr:hover {
            background: #f1d5c5;
            transition: 0.2s;
        }

        td img {
            width: 24px;
            height: 24px;
            transition: 0.2s;
        }

        td img:hover {
            transform: scale(1.15);
        }
    </style> -->

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

<?php 
session_start();

require_once (__DIR__ . "/../../controller/BebidaController.php");
$controladorBebida = new BebidaController();

// Mensagem de erro e dados antigos
$msgErro = $_SESSION['erro'] ?? '';

$old = $_SESSION['old'] ?? [];
$nome = $old['nome'] ?? '';
$alcoolica = $old['alcoolica'] ?? '';
$preco = $old['preco'] ?? '';

// Limpa erro (pra não ficar persistindo sempre)
unset($_SESSION['erro']);
include_once __DIR__ . '/../adm/validar.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Nova Bebida - OverCozido</title>
    <link rel="stylesheet" href="../styles/Bebida/form.css">
</head>
<body>

    <span id='confUrlBase' data-url-base='<?=URL_BASE?>'></span>

    <div class="container">
        <a href="../cardapio.php">🠔 Voltar para o Cardápio</a>
        
        <?php if ($msgErro): ?>
            <div class="alert alert-danger"><?= $msgErro ?></div>
        <?php endif; ?>

        <h1>Inserir Nova Bebida</h1>

        <form action="inserirBebida.php" method="POST" class="form-inserir">
            <div class="form-group">
                <label for="nome">Nome da Bebida:</label>
                <input type="text" name="nome" id="nome" 
                       value="<?= htmlspecialchars($nome) ?>" 
                       placeholder="Digite o nome da bebida" >
            </div>

            <div class="radio-group">
                <div class="group-label">Tipo de Bebida:</div>
                <div class="radio-options">
                    <div class="radio-option">
                        <input type="radio" name="alcoolica" id="alcoolicaS" value="S" 
                            <!-- <?= $alcoolica === 'S' ? 'checked' : '' ?> -->
                            >
                        <label for="alcoolicaS">Alcoólica</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="alcoolica" id="alcoolicaN" value="N"
                            <!-- <?= $alcoolica === 'N' ? 'checked' : '' ?> -->
                            >
                        <label for="alcoolicaN">Não alcoólica</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="preco">Preço (R$):</label>
                <input type="number" name="preco" id="preco" step="0.01" min="0" 
                       value="<?= htmlspecialchars($preco) ?>" 
                       placeholder="0.00" >
            </div>

            <button type="button" class="btn-submit" onclick="salvarBebida()">Adicionar Bebida</button>
        </form>
    </div>
    <script src="../js/scriptBebida.js"></script>
</body>
</html>
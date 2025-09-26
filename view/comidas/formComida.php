<?php 
session_start();

$msgErro = $_SESSION['erro'] ?? '';
$old = $_SESSION['old'] ?? [];

// Inputs antigos
$nomeSelecionado       = $old['nome'] ?? '';
$descricaoSelecionada  = $old['descricao'] ?? '';
$precoSelecionado      = $old['preco'] ?? '';

// Limpa erro (pra não ficar persistindo sempre)
unset($_SESSION['erro']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Nova Comida - OverCozido</title>
    <link rel="stylesheet" href="../styles/Comida/form.css">
</head>
<body>
    <div class="container">
        <a href="../cardapio.php">🠔 Voltar para o Cardápio</a>
        
        <?php if ($msgErro): ?>
            <div class="alert alert-danger"><?=$msgErro ?></div>
        <?php endif; ?>

        <h1>Inserir Nova Comida</h1>

        <form action="inserirComida.php" method="POST" class="form-inserir">
            <div class="form-group">
                <label for="nome">Nome da Comida:</label>
                <input type="text" id="nome" name="nome" maxlength="100" 
                       value="<?= htmlspecialchars($nomeSelecionado) ?>" 
                       placeholder="Digite o nome da comida">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" maxlength="255" 
                       value="<?= htmlspecialchars($descricaoSelecionada) ?>" 
                       placeholder="Descreva a comida">
            </div>

            <div class="form-group">
                <label for="preco">Preço (R$):</label>
                <input type="number" id="preco" name="preco" step="0.01" min="0" 
                       value="<?= htmlspecialchars($precoSelecionado) ?>" 
                       placeholder="0.00">
            </div>

            <button type="submit" class="btn-submit">Adicionar Comida</button>
        </form>
    </div>
</body>
</html>
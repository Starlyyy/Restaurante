<?php 
require_once (__DIR__ . "/../../controller/BebidaController.php");

$controladorBebida = new BebidaController();
$msgErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bebidaId  = $_POST['id'] ?? null;
    $nome      = trim($_POST['nome'] ?? '');
    $alcoolica = $_POST['alcoolica'] ?? '';
    $preco     = $_POST['preco'] ?? '';

    // Validação
    if ($nome === '' || $alcoolica === '' || $preco === '' || !is_numeric($preco)) {
        $msgErro = "Preencha todos os campos corretamente!";
        $bebida = $controladorBebida->buscarPorId((int)$bebidaId);
        $bebida->setNome($nome);
        $bebida->setAlcoolica($alcoolica);
        $bebida->setPreco(is_numeric($preco) ? (float)$preco : 0.0); 
    } else {
        $bebida = $controladorBebida->buscarPorId((int)$bebidaId);
        $bebida->setNome($nome);
        $bebida->setAlcoolica($alcoolica);
        $bebida->setPreco((float)$preco);
        $controladorBebida->alterar($bebida);
        header("Location: ../cardapio.php");
        exit;
    }
} elseif (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $bebida = $controladorBebida->buscarPorId($id);
    $alcoolica = $bebida->getAlcoolica(); 
} else {
    echo "ID da Bebida não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Bebida - OverCozido</title>
    <link rel="stylesheet" href="../styles/Bebida/alterar.css">
</head>
<body>
    <div class="container">
        <a href="../cardapio.php">🠔 Voltar para Cardápio</a>
        
        <h1>Alterar Bebida</h1>
        
        <?php if ($msgErro): ?>
            <div class="alert alert-danger"><?= $msgErro ?></div>
        <?php endif; ?>

        <form method="POST" class="form-alterar">
            <input type="hidden" name="id" value="<?= $bebida->getId() ?>">
            
            <div class="form-group">
                <label for="nome">Nome da Bebida:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($bebida->getNome()) ?>">
            </div>
            
            <div class="radio-group">
                <div class="group-label">Tipo de Bebida:</div>
                <div class="radio-options">
                    <div class="radio-option">
                        <input type="radio" name="alcoolica" id="alcoolicaS" value="S" 
                            <?= $bebida->getAlcoolica() === 'S' ? 'checked' : '' ?>>
                        <label for="alcoolicaS">Alcoólica</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="alcoolica" id="alcoolicaN" value="N"
                            <?= $bebida->getAlcoolica() === 'N' ? 'checked' : '' ?>>
                        <label for="alcoolicaN">Não alcoólica</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço (R$):</label>
                <input type="number" id="preco" name="preco" value="<?= htmlspecialchars($bebida->getPreco()) ?>" step="0.01" min="0">
            </div>
            
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
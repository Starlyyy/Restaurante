<?php 
require_once (__DIR__ . "/../../controller/ComidaController.php");
include_once __DIR__ . '/../adm/validar.php';

$controladorComida = new ComidaController();
$msgErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comidaId  = $_POST['id'] ?? null;
    $nome      = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco     = $_POST['preco'] ?? '';

    // Validação
    if ($nome === '' || $descricao === '' || $preco === '' || !is_numeric($preco)) {
        $msgErro = "Preencha todos os campos corretamente!";
        $comida = $controladorComida->buscarPorId((int)$comidaId);
        $comida->setNome($nome);
        $comida->setDescricao($descricao);
        $comida->setPreco(is_numeric($preco) ? (float)$preco : 0.0); 
    } else {
        $comida = $controladorComida->buscarPorId((int)$comidaId);
        $comida->setNome($nome);
        $comida->setDescricao($descricao);
        $comida->setPreco((float)$preco);
        $controladorComida->alterar($comida);
        header("Location: ../cardapio.php");
        exit;
    }
} elseif (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $comida = $controladorComida->buscarPorId($id);
} else {
    echo "ID da comida não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Comida - OverCozido</title>
    <link rel="stylesheet" href="../styles/Comida/alterar.css">
</head>
<body>
    <div class="container">
        <a href="../cardapio.php">🠔 Voltar para Cardápio</a>
        
        <h1>Alterar Comida</h1>
        
        <?php if ($msgErro): ?>
            <div class="alert alert-danger"><?= $msgErro ?></div>
        <?php endif; ?>

        <form method="POST" class="form-alterar">
            <input type="hidden" name="id" value="<?= $comida->getId() ?>">
            
            <div class="form-group">
                <label for="nome">Nome da Comida:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($comida->getNome()) ?>">
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"><?= htmlspecialchars($comida->getDescricao()) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço (R$):</label>
                <input type="number" id="preco" name="preco" value="<?= htmlspecialchars($comida->getPreco()) ?>" step="0.01" min="0">
            </div>
            
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
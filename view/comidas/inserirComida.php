<?php 
session_start();

require_once (__DIR__ . "/../../controller/ComidaController.php");

$controladorComida = new ComidaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Salva os dados antigos para repopular o formulário em caso de erro
    $_SESSION['old'] = $_POST;

    $nome = $_POST['nome'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $preco = $_POST['preco'] ?? null;

    $comida = new Comida();
    $comida->setNome($nome);
    $comida->setDescricao($descricao);
    $comida->setPreco(floatval($preco));
    
    $erros = $controladorComida->inserir($comida);

    if (count($erros) == 0) {
        // Limpa dados antigos e erro
        unset($_SESSION['old'], $_SESSION['erro']);
        header("Location: ../cardapio.php");
        exit;
    } else {
        // Se for array, transforma em string única
        $_SESSION['erro'] = is_array($erros) ? implode('<br>', $erros) : $erros;
        header("Location: formComida.php");
        exit;
    }
} else {
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: formComida.php");
    exit;
}
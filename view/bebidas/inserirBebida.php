<?php
session_start();

require_once (__DIR__ . "/../../controller/BebidaController.php");

$controladorBebida = new BebidaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Salva os dados antigos para repopular o formulário em caso de erro
    $_SESSION['old'] = $_POST;

    $nome      = $_POST['nome'] ?? null;
    $alcoolica = $_POST['alcoolica'] ?? ''; // Garantir string
    $preco     = $_POST['preco'] ?? null;

    $bebida = new Bebida();
    $bebida->setNome($nome);
    $bebida->setAlcoolica($alcoolica); // !null
    $bebida->setPreco(floatval($preco));

    $erros = $controladorBebida->inserir($bebida);

    if (count($erros) == 0) {
        unset($_SESSION['old'], $_SESSION['erro']);
        header("Location: ../cardapio.php");
        exit;
    } else {
        $_SESSION['erro'] = is_array($erros) ? implode('<br>', $erros) : $erros;
        header("Location: formBebida.php");
        exit;
    }
} else {
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: formBebida.php");
    exit;
}
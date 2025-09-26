<?php
session_start();

require_once(__DIR__ . "/../../controller/MesaController.php");
require_once(__DIR__ . "/../../controller/BebidaController.php");
require_once(__DIR__ . "/../../controller/ComidaController.php");
require_once(__DIR__ . "/../../controller/PedidoController.php");

$controladorMesa = new MesaController();
$controladorBebida = new BebidaController();
$controladorComida = new ComidaController();
$controladorPedido = new PedidoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // salva todos os inputs para repopular depois, se der erro
    $_SESSION['old'] = $_POST;

    $mesaId   = $_POST['mesa'] ?? null;
    $bebidaId = $_POST['bebida'] ?? null;
    $comidaId = $_POST['comida'] ?? null;

    if ($mesaId == "") {
        $_SESSION['erro'] = "Número da mesa é obrigatório.";
        header("Location: formulario.php");
        exit;
    }

    if ($comidaId != "" || $bebidaId != "") {
        $mesa   = $mesaId   ? $controladorMesa->buscarPorId((int)$mesaId)   : null;
        $bebida = $bebidaId ? $controladorBebida->buscarPorId((int)$bebidaId) : null;
        $comida = $comidaId ? $controladorComida->buscarPorId((int)$comidaId) : null;

        // se mesa não existir
        if (!$mesa) {
            $_SESSION['erro'] = "Mesa inexistente.";
            header("Location: formulario.php");
            exit;
        }

        $pedido = new Pedido($mesa, $comida, $bebida);
        $controladorPedido->inserir($pedido);

        // limpar dados antigos e erro
        unset($_SESSION['old'], $_SESSION['erro']);

        header("Location: listar.php");
        exit;
    } else {
        $_SESSION['erro'] = "Opção inválida. Selecione ao menos uma comida ou bebida.";
        header("Location: formulario.php");
        exit;
    }
} else {
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: formulario.php");
    exit;
}

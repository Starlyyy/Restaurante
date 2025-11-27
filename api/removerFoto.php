<?php 


include_once(__DIR__ . "/../login/validar.php");

include_once(__DIR__ . "/../../controller/LoginController.php");
include_once(__DIR__ . "/../../controller/PerfilController.php");

header("Content-Type: application/json");

$loginCont = new LoginController();
$usuario = $loginCont->getUsuarioLogado();

if (!$usuario) {
    echo json_encode(["erro" => "Usuário não encontrado"]);
    exit;
}

$perfCont = new PerfilController();
$erros = $perfCont->removerFoto($usuario);

if ($erros) {
    echo json_encode(["erro" => implode("<br>", $erros)]);
} else {
    echo json_encode(["sucesso" => true]);
}

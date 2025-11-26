<?php 

require_once __DIR__ . '/../../controller/LoginController.php';

$loginCont = new LoginController();
$validar = $loginCont->validarIsAdm();

if(!$validar) {
    header("location: " . URL_BASE . "/view/cardapio.php");
    header("location: " . URL_BASE . "/view/cardapio.php?msg=1");
    exit;
}
<?php 

require_once(__DIR__ . "/../model/Pedido.php");

class PedidoService {

    public function validarPedido(Pedido $pedido) {
        $erros = array();

        //Validar mesa
        $mesa = $pedido->getMesa();
        if($mesa == null) {
            array_push($erros, "Mesa é obrigatória.");
        } else if($mesa->getId() < 1 || $mesa->getId() > 24) {
            array_push($erros, "Número da mesa inválido. Deve estar entre 1 e 24.");
        }

        //Validar comida
        $comida = $pedido->getComida();
        if($comida != null) {
            if($comida->getId() < 1) {
                array_push($erros, "Comida inválida.");
            }
        }

        //Validar bebida
        $bebida = $pedido->getBebida();
        if($bebida != null) {
            if($bebida->getId() < 1) {
                array_push($erros, "Bebida inválida.");
            }
        }

        //Validar se pelo menos uma comida ou bebida foi selecionada
        if($comida == null && $bebida == null) {
            array_push($erros, "Selecione ao menos uma comida ou bebida.");
        }

        return $erros;
    }
}
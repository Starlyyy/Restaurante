<?php

require_once(__DIR__ . "/../model/Bebida.php");

class BebidaService{
    public function validarBebida(Bebida $bebida) {
        $erros = array();

        //Validar nome
        $nome = $bebida->getNome();
        if($nome == null || trim($nome) == "") {
            array_push($erros, "Nome é obrigatório.");
        } else if(strlen($nome) > 100) {
            array_push($erros, "Nome deve ter no máximo 100 caracteres.");
        }else if(is_numeric($nome)) {
            array_push($erros, "Nome não pode ser um número.");
        }

        //Validar se é alcoólica
        $alcoolica = $bebida->getAlcoolica();
        if($alcoolica == null || ($alcoolica != 'S' && $alcoolica != 'N')) {
            array_push($erros, "Indicação de bebida alcoólica é obrigatória.");
        }

        //Validar preço
        $preco = $bebida->getPreco();
        if($preco == null || !is_numeric($preco)) {
            array_push($erros, "Preço é obrigatório e deve ser um número.");
        } else if($preco < 0) {
            array_push($erros, "Preço não pode ser negativo.");
        }

        return $erros;
    }
}

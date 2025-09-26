<?php

require_once(__DIR__ . "/../model/Comida.php");

class ComidaService {

    public function validarComida(Comida $comida) {
        $erros = array();

        //Validar nome
        $nome = $comida->getNome();
        if($nome == null || trim($nome) == "") {
            array_push($erros, "Nome é obrigatório.");
        } else if(strlen($nome) > 100) {
            array_push($erros, "Nome deve ter no máximo 100 caracteres.");
        } else if(is_numeric($nome)) {
            array_push($erros, "Nome não pode ser um número.");
        }

        //Validar descrição
        $descricao = $comida->getDescricao();
        if($descricao == null || trim($descricao) == "") {
            array_push($erros, "Descrição é obrigatória.");
        } else if(strlen($descricao) > 255) {
            array_push($erros, "Descrição deve ter no máximo 255 caracteres.");
        } else if(is_numeric($descricao)) {
            array_push($erros, "Descrição não pode ser um número.");
        }

        //Validar preço
        $preco = $comida->getPreco();
        if($preco == null || !is_numeric($preco)) {
            array_push($erros, "Preço é obrigatório e deve ser um número.");
        } else if($preco < 0) {
            array_push($erros, "Preço não pode ser negativo.");
        }

        return $erros;
    }
}

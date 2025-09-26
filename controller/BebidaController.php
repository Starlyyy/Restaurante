<?php

require_once (__DIR__ . "/../dao/BebidaDAO.php");
require_once (__DIR__ . "/../service/BebidaService.php");
require_once (__DIR__ . "/../model/Bebida.php");

class BebidaController{
    private BebidaDAO $bebidaDAO;
    private BebidaService $bebidaService;

    public function __construct(){
        $this->bebidaDAO = new BebidaDAO();
        $this->bebidaService = new BebidaService();
    }

    public function inserir(Bebida $bebida){
        $erros = $this->bebidaService->validarBebida($bebida);
        if(count($erros) > 0) {
            return $erros;
        }
        //Se não tiver erros, chama o DAO
        try {
            $this->bebidaDAO->inserir($bebida);
            return []; // Sucesso, sem erros
        } catch (Exception $e) {
            return ["Erro ao salvar a bebida!"];
        }
    }

    public function alterar(Bebida $bebida){
        $erros = $this->bebidaService->validarBebida($bebida);
        if(count($erros) > 0) {
            return $erros;
        }
        //Se não tiver erros, chama o DAO
        try {
            $this->bebidaDAO->alterar($bebida);
            return []; // Sucesso, sem erros
        } catch (Exception $e) {
            return ["Erro ao atualizar a bebida!"];
        }
   }

    public function excluir(int $id){
        try {
            $this->bebidaDAO->excluir($id);
            return []; // Sucesso, sem erros
        } catch (Exception $e) {
            return ["Erro ao excluir a bebida!"];
        }
    }

    public function listar(){
        return $this->bebidaDAO->listar();
    }

    public function buscarPorId(int $id){
        return $this->bebidaDAO->buscarPorId($id);
    }
}
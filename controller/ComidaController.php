<?php

require_once (__DIR__ . "/../dao/ComidaDAO.php");
require_once (__DIR__ . "/../model/Comida.php");
require_once (__DIR__ . "/../service/ComidaService.php");

class ComidaController{
    private ComidaDAO $comidaDAO;
    private ComidaService $comidaService;

    public function __construct(){
        $this->comidaDAO = new ComidaDAO();
        $this->comidaService = new ComidaService();
    }

    public function inserir(Comida $comida){
        $erros = $this->comidaService->validarComida($comida);
        if(count($erros) > 0) {
            return $erros;
        }
        //Se não tiver erros, chama o DAO
        try {
            $this->comidaDAO->inserir($comida);
            return []; // Sucesso, sem erros
        } catch (Exception $e) {
            return ["Erro ao salvar a comida!"];
        }
    }

    public function alterar(Comida $comida){
        $erros = $this->comidaService->validarComida($comida);
        if(count($erros) > 0) {
            return $erros;
        }
        //Se não tiver erros, chama o DAO
        try {
            $this->comidaDAO->alterar($comida);
            return []; // Sucesso, sem erros
        } catch (Exception $e) {
            return ["Erro ao atualizar a comida!"];
        }
    }

    public function excluir(int $id) {
        try {
            $this->comidaDAO->excluir($id);
            return []; // Sucesso, sem erros
        } catch (Exception $e) {
            return ["Erro ao excluir a comida!"];
        }
    }

    public function listar(){
        return $this->comidaDAO->listar();
    }

    public function buscarPorId(int $id){
        return $this->comidaDAO->buscarPorId($id);
    }
}
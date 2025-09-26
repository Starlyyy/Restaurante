<?php

require_once(__DIR__ . "/../dao/PedidoDAO.php");
require_once(__DIR__ . "/../model/Pedido.php");
require_once(__DIR__ . "/../service/PedidoService.php");

class PedidoController {

    private PedidoDAO $pedidoDAO;
    private PedidoService $pedidoService;

    public function __construct() {
        $this->pedidoDAO = new PedidoDAO();
        $this->pedidoService = new PedidoService();        
    }

    public function listar() {
        $lista = $this->pedidoDAO->listar();
        return $lista;
    }

    public function buscarPorId(int $id) {
        $pedido = $this->pedidoDAO->buscarPorId($id);
        return $pedido;
    }

    public function inserir(Pedido $pedido) {
        $erros = $this->pedidoService->validarPedido($pedido);
        if(count($erros) > 0) 
            return $erros;
        
        //Se não tiver erros, chama o DAO       
        $erros = array();
        $erro = $this->pedidoDAO->inserir($pedido);
        if($erro) {
            array_push($erros, "Erro ao salvar o pedido!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function alterar(Pedido $pedido) {
        /*$erros = $this->pedidoService->validarPedido($pedido);
        if(count($erros) > 0) 
            return $erros;*/

        //Se não deu erros, alterar o pedido no banco de dados
        $erros = array();
        $erro = $this->pedidoDAO->alterar($pedido);
        if($erro) {
            array_push($erros, "Erro ao atualizar o pedido!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function excluirPorId(int $id) {
        $erros = array();
        
        $erro = $this->pedidoDAO->excluirPorId($id);
        if($erro) {
            array_push($erros, "Erro ao excluir o pedido!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }



}
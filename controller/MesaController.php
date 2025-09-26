<?php

require_once (__DIR__ . "/../dao/MesaDAO.php");
require_once (__DIR__ . "/../model/Mesa.php");

class MesaController{
    private MesaDAO $mesaDAO;

    public function __construct(){
        $this->mesaDAO = new MesaDAO();
    }

    public function listar(){
        return $this->mesaDAO->listar();
    }

    public function buscarPorId(int $id){
        return $this->mesaDAO->buscarPorId($id);
    }
}
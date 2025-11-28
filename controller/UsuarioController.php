<?php 

require_once(__DIR__ . '/../dao/UsuarioDAO.php');
require_once(__DIR__ . '/../controller/PerfilController.php');

class UsuarioController {
    private UsuarioDAO $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function buscarPorId($id) {
        return $this->usuarioDAO->findById($id);
    }

}
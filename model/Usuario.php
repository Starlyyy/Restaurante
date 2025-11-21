<?php
#Arquivo com a declaração da classe Usuario

class Usuario {

    private ?int $id_usuario;
    private ?string $nomeUsuario;
    private ?string $senhaUsuario;
    private ?string $fotoUsuario;
    private ?string $isAdm;

    //Construtor da classe
    public function __construct($id_usuario, $nomeUsuario, $senhaUsuario, $fotoUsuario, $isAdm) {
        $this->id_usuario = $id_usuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->senhaUsuario = $senhaUsuario;
        $this->fotoUsuario = $fotoUsuario;
        $this->isAdm = $isAdm;
    }

    public function getIdUsuario(): ?int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getNomeUsuario(): ?string
    {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario(?string $nomeUsuario): self
    {
        $this->nomeUsuario = $nomeUsuario;

        return $this;
    }

    public function getSenhaUsuario(): ?string
    {
        return $this->senhaUsuario;
    }

    public function setSenhaUsuario(?string $senhaUsuario): self
    {
        $this->senhaUsuario = $senhaUsuario;

        return $this;
    }

    public function getFotoUsuario(): ?string
    {
        return $this->fotoUsuario;
    }

    public function setFotoUsuario(?string $fotoUsuario): self
    {
        $this->fotoUsuario = $fotoUsuario;

        return $this;
    }

    public function getIsAdm(): ?string
    {
        return $this->isAdm;
    }

    public function setIsAdm(?string $isAdm): self
    {
        $this->isAdm = $isAdm;

        return $this;
    }
}

?>
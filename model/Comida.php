<?php

class Comida{
    private ?int $id;
    private ?string $nome;
    private ?string $descricao;
    private ?float $preco;

    public function __construct(){
        $this->id = null;
        $this->nome = null;
        $this->descricao = null;
        $this->preco = null;
    }

    

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of preco
     */
    public function getPreco(): ?float
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     */
    public function setPreco(?float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }
}
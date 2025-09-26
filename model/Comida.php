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

    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id): self{
        $this->id = $id;

        return $this;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function setNome(string $nome): self{
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(): string{
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self{
        $this->descricao = $descricao;

        return $this;
    }

    public function getPreco(): float{
        return $this->preco;
    }

    public function setPreco(float $preco): self{
        $this->preco = $preco;

        return $this;
    }
}
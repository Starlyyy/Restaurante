<?php

class Bebida{
    private ?int $id;
    private ?string $nome;
    private ?string $alcoolica; //apenas 'S' ou 'N'
    private ?float $preco;

    public function __construct(){
        $this->id = null;
        $this->nome = null;
        $this->alcoolica = null;
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

    public function getAlcoolica(): string{
        return $this->alcoolica;
    }

    public function setAlcoolica(string $alcoolica): self{
        $this->alcoolica = $alcoolica;

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
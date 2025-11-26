<?php

require_once(__DIR__ . "/Mesa.php");
require_once(__DIR__ . "/Comida.php");
require_once(__DIR__ . "/Bebida.php");

class Pedido{
    private ?int $id;
    private ?Mesa $mesa;
    private ?Comida $comida;//pode aceitar nulo;
    private ?Bebida $bebida;//pode aceitar nulo;
    private float $total;

    public function __construct(?Mesa $m, ?Comida $c = NULL, ?Bebida $b = NULL){
        $this->mesa = $m;
        $this->comida = $c;
        $this->bebida = $b;
        $total = 0;
        if ($c) $total += $c->getPreco();
        if ($b) $total += $b->getPreco();
        $this->total = $total;
    }

    //TODAS AS FUNÇÕES DE GET DEVEM CHAMAR O CONTROLLER, menos a de calcular o total do pedido, acredito eu.
    //não acho que seria apropriado colocar a opção de setar o id, já que ele é auto incrementado e deveria apenas ser pegado do banco de dados.


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getMesa(): ?Mesa
    {
        return $this->mesa;
    }

    public function setMesa(?Mesa $mesa): self
    {
        $this->mesa = $mesa;

        return $this;
    }

    public function getComida(): ?Comida
    {
        return $this->comida;
    }

    public function setComida(?Comida $comida): self
    {
        $this->comida = $comida;

        return $this;
    }

    public function getBebida(): ?Bebida
    {
        return $this->bebida;
    }

    public function setBebida(?Bebida $bebida): self
    {
        $this->bebida = $bebida;

        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }
}
<?php

class Mesa{
    private int $id;
    private int $capacidade;
    
    public function getId(): int{
        return $this->id;
    }

    public function getCapacidade(): int{
        return $this->capacidade;
    }

    public function setCapacidade(int $capacidade): self{
        $this->capacidade = $capacidade;

        return $this;
    }

    public function setId(int $id): self{
        $this->id = $id;

        return $this;
    }
}
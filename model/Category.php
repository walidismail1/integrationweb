<?php

class Category
{
    private ?int $idCategorie = null;
    private ?string $nomC = null;

    public function __construct($id = null, $nom = null)
    {
        $this->idCategorie = $id;
        $this->nomC = $nom;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function getNomC()
    {
        return $this->nomC;
    }

    public function setNomC($nomC)
    {
        $this->nomC = $nomC;
        return $this;
    }
}

<?php
/*class Formation {
    private ?int $idFormation = null;
    private ?string $nom = null;
    private ?string $description = null;
    private ?string $durée = null;
    private ?float $prix = null;

    public function __construct($id = null, $nom, $description, $durée, $prix) {
        $this->idFormation = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->durée = $durée;
        $this->prix = $prix;
    }

    // Getters and setters for all properties

    public function getIdFormation(): ?int {
        return $this->idFormation;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;
        return $this;
    }

    public function getDuree(): ?string {
        return $this->durée;
    }

    public function setDurée(?string $durée): self {
        $this->durée = $durée;
        return $this;
    }

    public function getPrix(): ?float {
        return $this->prix;
    }

    public function setPrix(?float $prix): self {
        $this->prix = $prix;
        return $this;
    }
}*/
class Formation {
    private ?int $idFormation = null;
    private ?string $nom = null;
    private ?string $description = null;
    private ?string $durée = null;
    private ?float $prix = null;

    // Constructeur de la classe
    public function __construct(?int $id = null, ?string $nom, ?string $description, ?string $durée, ?float $prix) {
        $this->idFormation = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->durée = $durée;
        $this->prix = $prix;
    }

    // Getters and setters pour toutes les propriétés

    public function getIdFormation(): ?int {
        return $this->idFormation;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;
        return $this;
    }

    public function getDuree(): ?string {
        return $this->durée;
    }

    public function setDuree(?string $durée): self {
        $this->durée = $durée;
        return $this;
    }

    public function getPrix(): ?float {
        return $this->prix;
    }

    public function setPrix(?float $prix): self {
        $this->prix = $prix;
        return $this;
    }
}


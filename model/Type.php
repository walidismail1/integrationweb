<?php 
/*class Type {
    private ?int $idType = null;
    private ?string $name = null;
    private ?string $descriptions = null;
    private ?string $outilspossibles = null;

    public function __construct($id = null, $name, $descriptions, $outilspossibles) {
        $this->idType = $id;
        $this->name = $name;
        $this->descriptions = $descriptions;
        $this->outilspossibles = $outilspossibles;
    }

    // Getters and setters for all properties

    public function getIdType(): ?int {
        return $this->idType;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getDescriptions(): ?string {
        return $this->descriptions;
    }

    public function setDescriptions(?string $descriptions): self {
        $this->descriptions = $descriptions;
        return $this;
    }

    public function getOutilsPossibles(): ?string {
        return $this->outilspossibles;
    }

    public function setOutilsPossibles(?string $outilspossibles): self {
        $this->outilspossibles = $outilspossibles;
        return $this;
    }
}*/


class Type {
    private ?int $idType = null;
    private ?string $name = null;
    private ?string $descriptions = null;
    private ?string $outilspossibles = null;

    public function __construct($id = null, $name, $descriptions, $outilspossibles) {
        $this->idType = $id;
        $this->name = $name;
        $this->descriptions = $descriptions;
        $this->outilspossibles = $outilspossibles;
    }

    // Getters and setters for all properties

    public function getIdType(): ?int {
        return $this->idType;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getDescriptions(): ?string {
        return $this->descriptions;
    }

    public function setDescriptions(?string $descriptions): self {
        $this->descriptions = $descriptions;
        return $this;
    }

    public function getOutilsPossibles(): ?string {
        return $this->outilspossibles;
    }

    public function setOutilsPossibles(?string $outilspossibles): self {
        $this->outilspossibles = $outilspossibles;
        return $this;
    }
}

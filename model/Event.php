<?php
class Event
{
    private ?int $idevent = null;
    private ?string $nom = null;
    private ?string $date = null;
    private ?string $lieu = null;
    private ?string $description = null;
    private ?int $capacite = null;
    private ?int $idCategorie = null; // Nouvel attribut pour l'id de la catégorie

    public function __construct($id = null, $nom, $date, $lieu, $description, $capacite, $idCategorie = null)
    {
        $this->idevent = $id;
        $this->nom = $nom;
        $this->date = $date;
        $this->lieu = $lieu;
        $this->description = $description;
        $this->capacite = $capacite;
        $this->idCategorie = $idCategorie;
    }

    // Getters et Setters

    public function getIdevent()
    {
        return $this->idevent;
    }

    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getCapacite()
    {
        return $this->capacite;
    }

    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
        return $this;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;
        return $this;
    }
}
?>

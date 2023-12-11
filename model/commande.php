<?php
class commande{
    private int $id_commande;
    private string $email;
    private string $nom;
    private string $prenom;
    private int $artwork;

    public function  __construct ($id,$e,$n,$p,$a)
    {
    $this->id_commande=$id;
    $this->email=$e;
    $this->nom=$n;
    $this->prenom=$p;
    $this->artwork=$a;

    }
    public function getidcommande()
    {
        return $this->id_commande;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function getnom()
    {
        return $this->nom;
    }
    public function getprenom()
    {
        return $this->prenom;
    }
    public function getartwork()
    {
        return $this->artwork;
    }
}
?>
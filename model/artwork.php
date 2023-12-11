<?php
class artwork{
    private string $titre;
    private string $image;
    private float $price;
    private string $description;

    public function  __construct ($t,$i,$p,$d)
    {
    $this->titre=$t;
    $this->image=$i;
    $this->price=$p;
    $this->description=$d;

    }
    public function gettitre()
    {
        return $this->titre;
    }
    public function getimage()
    {
        return $this->image;
    }
    public function getprice()
    {
        return $this->price;
    }
    public function getdescription()
    {
        return $this->description;
    }
}
?>
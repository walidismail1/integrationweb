<?php
class user{
    private string $first_name;
    private string $last_name;
    private string $telephone;
    private string $email;
    private string $password;

    public function  __construct ($p,$n,$t,$u,$r)
    {
    $this->first_name=$p;
    $this->last_name=$n;
    $this->telephone=$t;
    $this->email=$u;
    $this->password=$r;

    }
    public function getfirst_name()
    {
        return $this->first_name;
    }
    public function getlast_name()
    {
        return $this->last_name;
    }
    public function gettelephone()
    {
        return $this->telephone;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function getpassword()
    {
        return $this->password;
    }
}
?>
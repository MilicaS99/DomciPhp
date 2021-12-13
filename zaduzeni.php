<?php
class Zaduzeni{
    public $Id;
    public $Ime;   
    public $Prezime;   
    public $BrojTelefona;   
    public $Email;   
    public $OpisZaduzenja;
    public $Datum;
    
    public function __construct($id=null,$ime=null, $prezime=null, $brojtelefona=null, $email=null, $opiszaduzenja=null,$datum=null)
    {   
      $this->Id=$id;
        $this->Ime= $ime;
        $this->Prezime = $prezime;
        $this->BrojTelefona = $brojtelefona;
        $this->Email= $email;
        $this->OpisZaduzenja=$opiszaduzenja;
        $this->Datum=$datum;

    }
  public static function VratiSveZaduzene(mysqli $conn)
  {
    $query = "SELECT * FROM zaduzeni";
    return $conn->query($query);
  }
  
  public static function DodajZaduzenog(Zaduzeni $zaduzen, mysqli $conn)
  {
    $query = "INSERT INTO zaduzeni(Ime,Prezime,BrojTelefona,Email,OpisZaduzenja,Datum) VALUES('$zaduzen->Ime','$zaduzen->Prezime','$zaduzen->BrojTelefona','$zaduzen->Email','$zaduzen->OpisZaduzenja','$zaduzen->Datum')";
    return $conn->query($query);

  }
  public function Izmeni($id, mysqli $conn)
  {
    $query = "UPDATE zaduzeni set Ime = $this->Ime,Prezime = $this->Prezime,BrojTelefona = $this->BrojTelefona,Email = $this->Email,
    OpisZaduzenja=$this->OpisZaduzenja,Datum=$this->Datum  WHERE Id=$id";
    return $conn->query($query);
  }

  public function deleteById($id,mysqli $conn)
  {
    $query = "DELETE FROM zaduzeni WHERE Id=:id";
    $stmt= $conn->prepare($query);
    $stmt->execute(['id'=>$id]);
    return true;
  }

  }

?>
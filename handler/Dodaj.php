<?php

require "../db.php";
require "../zaduzeni.php";

if(isset($_POST['action']) && $_POST['action']=='add_zaduzeni' && isset($_POST['ime']) && isset($_POST['prezime']) 
&& isset($_POST['brojtelefona']) && isset($_POST['email'])
  && isset($_POST['opiszaduzenja']) && isset($_POST['datum'])){
    $zaduzeni = new Zaduzeni(null, $_POST['ime'], $_POST['prezime'], $_POST['brojtelefona'], $_POST['email'], $_POST['opiszaduzenja'], $_POST['datum'] );
    $status =Zaduzeni::DodajZaduzenog($zaduzeni,$conn);

}
?>
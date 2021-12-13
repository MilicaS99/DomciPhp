<?php

require "../db.php";
require "../zaduzeni.php";

if (
  true
  // isset($_POST['action']) && $_POST['action'] == 'update_zaduzeni' && isset($_POST['Ime']) && isset($_POST['Prezime'])
  // && isset($_POST['BrojTelefona']) && isset($_POST['Email'])
  // && isset($_POST['OpisZaduzenja']) && isset($_POST['Datum'])
) {

  $id = ($_POST['id']);
  $ime = ($_POST['ime']);
  $prezime = ($_POST['prezime']);
  $brojTelefona = ($_POST['brojTelefona']);
  $email = ($_POST['email']);
  $opisZaduzenja = ($_POST['opisZaduzenja']);
  $datum = ($_POST['datum']);

 
  $query = "UPDATE zaduzeni 
                     SET Ime = $ime,
                         Prezime = $prezime,
                         BrojTelefona = $brojTelefona,
                         OpisZaduzenja = $opisZaduzenja,
                        Datum = $datum,
                        Email = $email

               WHERE Id=$id";

  $stmt = $conn->prepare($query);
  $stmt->execute();
}

?>
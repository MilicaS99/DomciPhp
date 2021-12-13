<?php

require "../db.php";
require "../zaduzeni.php";

if (
  isset($_POST['action']) && $_POST['action'] == 'update_zaduzeni' && isset($_POST['Ime']) && isset($_POST['Prezime'])
  && isset($_POST['BrojTelefona']) && isset($_POST['Email'])
  && isset($_POST['OpisZaduzenja']) && isset($_POST['Datum'])
) {

  $id = ($_POST['Id']);
  $ime = ($_POST['Ime']);
  $prezime = ($_POST['Prezime']);
  $brojTelefona = ($_POST['BrojTelefona']);
  $opisZaduzenja = ($_POST['OpisZaduzenja']);
  $datum = ($_POST['Datum']);


  $query = "UPDATE zaduzeni 
                     SET Ime = $ime,
                     Prezime = $prezime,
                     BrojTelefona = $brojTelefona,
                     OpisZaduzenja = $opisZaduzenja,
                     datum = $datum
               WHERE Id=$id";

  $stmt = $conn->prepare($query);
  $stmt->execute();
}

<?php

require "../db.php";
require "../zaduzeni.php";

if (
  true
  // isset($_POST['action']) && $_POST['action'] == 'update_zaduzeni' && isset($_POST['Ime']) && isset($_POST['Prezime'])
  // && isset($_POST['BrojTelefona']) && isset($_POST['Email'])
  // && isset($_POST['OpisZaduzenja']) && isset($_POST['Datum'])
) {

  try {

    $objekatJson = json_encode($_POST);
    $zaduzeni =  json_decode($objekatJson);

    $id = $zaduzeni->id;
    echo $id;
    $ime = $zaduzeni->ime;
    echo  $ime;
    $prezime = $zaduzeni->prezime;
    echo $prezime;
    $brojTelefona = $zaduzeni->brojTelefona;
    echo $brojTelefona;
    $email = $zaduzeni->email;
    echo $email;
    $opisZaduzenja = $zaduzeni->opisZaduzenja;
    echo $opisZaduzenja;
    $datum = $zaduzeni->datum;
    echo $datum;

    $query = "UPDATE zaduzeni 
                      SET Ime = '$ime',
                          Prezime = '$prezime',
                          BrojTelefona = '$brojTelefona',
                          OpisZaduzenja = '$opisZaduzenja',
                          Datum = '$datum',
                          Email = '$email'

                WHERE Id = $id";

    echo $query;

    $stmt = $conn->prepare($query);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
}

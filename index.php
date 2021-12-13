<?php

require "db.php";
require "korisnik.php";

session_start();
$object1 = new Korisnik();

if (isset($_POST['prijavise'])) {
  $object1->login();
} else if (isset($_POST['registrujse'])) {
  $object1->sigup();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="maincss/style.css">
  <title>Sign-Up/Login Form</title>

</head>

<body>
  <div class="glavni">
    <div class="signup" >Registruj se</div>
    <div class="login" >Prijavi se</div>

    <div class="login-form" >
      
      <div class="main-div">
        <form method="POST" action="#">
          <div class="container">

            <input type="text" name="emailadress" placeholder="Email Adresa" class="form-control" required>
            <br>

            <input type="password" name="password" placeholder="Šifra" class="form-control" required>
            <button type="submit" class="btn btn-primary" name="prijavise">Prijavi se</button>
          </div>

        </form>
      </div>


    </div>


    <div class="signup-form" >
      <div class="main-div">
        <form method="POST" action="#">
          <div class="container">

            <input type="text" name="firstname" placeholder="Ime" class="form-control" required>
            <br>

            <input type="text" name="lastname" placeholder="Prezime" class="form-control" required>
            <br>

            <input type="txt" name="emailadress" placeholder="Email Adresa" class="form-control" required>
            <br>

            <input type="password" name="password" placeholder="Šifra" class="form-control" required>
            <button type="submit" class="btn btn-primary" name="registrujse">Registruj se</button>
          </div>

        </form>
      </div>


    </div>

  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".login-form").hide();
      $(".login").click(function() {
        $(".signup-form").hide();
        $(".login-form").show();
      });
      $(".signup").click(function() {
        $(".signup-form").show();
        $(".login-form").hide();


      });


    });
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>


</body>

</html>
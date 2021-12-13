<?php
require "../db.php";
require "../glavna.php";
if(isset($_POST['Id'])){
  $id=($_POST['Id']);
  $query = "DELETE FROM zaduzeni WHERE Id=$id";
  $stmt = $conn->prepare($query);
  $stmt->execute();

}

?>
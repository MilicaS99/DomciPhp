<?php

class Korisnik{
  private $host;
  private $user;
  private $pass;
  private $db;
  private $mysqli;
  public function __construct()
  {
    $this->host='localhost';
    $this->user='root';
    $this->pass='';
    $this->db='domaciphp';
    $this-> mysqli=new mysqli($this->host,$this->user,$this->pass,$this->db) or die($this->mysqli->error);
  }
  public function login(){
    $email=$this->mysqli->escape_string($_POST['emailadress']);
    $result=$this->mysqli->query("select * from users where email='$email'");
    if($result->num_rows==0){
      $_SESSION['message']="User with tha email doesn not exist!";
      header("location: index.php");
    }
    else{
      $user=$result->fetch_assoc();
      if(password_verify($_POST['password'],$user['password'])){
        
        $_SESSION['emailadress']=$user['emailadress'];
        $_SESSION['firstname']=$user['firstname'];
        $_SESSION['lastname']=$user['lastname'];
        $_SESSION['active']=$user['active'];
        $_SESSION['logged_in']=true;
        header('location:glavna.php');
      }
      else{
        $_SESSION['message']="You have entered wrong password,try again!";
        echo  $_SESSION['message'];
        header("location:index.php");
      }
    }
  }
  public function sigup(){
    $_SESSION['email']=$_POST['emailadress'];
    $_SESSION['first_name']=$_POST['firstname'];
    $_SESSION['last_name']=$_POST['lastname'];
    $first_name=$this->mysqli->escape_string($_POST['firstname']);
    $last_name=$this->mysqli->escape_string($_POST['lastname']);
    $email=$this->mysqli->escape_string($_POST['emailadress']);
    $password=$this->mysqli->escape_string(password_hash($_POST['password'],PASSWORD_BCRYPT));
    $hash=$this->mysqli->escape_string(md5(rand(0,1000)));

    $result=$this->mysqli->query("select * from users where email='$email'");
    if($result->num_rows>0){
      $_SESSION['message']='User with this email alredy exists!';
      header("location:index.php");
    }
    else{
      $sql="INSERT INTO users (first_name,last_name,email,password,hash) values
      ('$first_name','$last_name','$email','$password','$hash')";
      if($this->mysqli->query($sql)){
        $_SESSION['active']=1;
        $_SESSION['logged_in']=true;
      $alert="<script>alert('Uspešno ste se registrovali!');</script>";
        echo $alert;
        header("location:glavna.php");
      }else{
        $_SESSION['message']='Registration failed!';
        header("location:index.php");
      }
    }

  }


}

?>
<?php
session_start();
session_regenerate_id();
use app\{
  autoload,
  database,
  validate,
};
require "../autoload/loader.php";
require "../database/sql.php";

autoload\loader::register();


if($_SERVER["REQUEST_METHOD"] == "POST"){
  if($_POST["token"] != $_SESSION["token"]){
    die("Token mismatch!");
  }
  $val = new validate\validate();
  $error = $val->email($_POST["email"]);
  if($error == ""){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $account = $_POST["account"];
    if(empty($password) || empty($account)){
      die( "Missing details!");
    }
    $params = database\database::params();
    $conn = mysql($params);
    $sql = "SELECT Password FROM $account WHERE Email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
      while($row = $result->fetch_assoc()){
        if($row["Password"] == hash("sha256",$password)){
          die("1");
        }
      }
      die("Incorrect email or password");
    }
    die("Incorrect email or password");
  }
  else echo $error;
}



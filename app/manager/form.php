<?php

//FUNCTIONS FOR HANDLING INPUT
use app\{
  autoload,
  database,
  handleimages,
  validate,
};
require "../autoload/loader.php";
require "../database/sql.php";
autoload\loader::register();
function savedp($file){
  $id = $_COOKIE["manager"];
  $dpclass = new handleimages\handleimages();
  $dpname = $dpclass->dp($file);
  if(!$dpname){
    $obj = [];
    $obj["err"] = $dpclass->error;
    die(json_encode($obj));
  }
  
  $params = database\database::params();
  $conn = mysql($params);
  
  $sql = "UPDATE manager SET Pic = '$dpname' WHERE Id = $id";
  if($conn->query($sql)!==TRUE){
      $obj = [];
      $obj["err"] = "An error occurred. Please try again";
      echo json_encode($obj);
    }
  
  $conn->close();
  $id = $sql = $params = $conn = $dpclass = $dpname = "";
}

function savecontacts($arr){
  $validate = new validate\validate();
  foreach (json_decode($arr) as $value) {
    foreach ($value as $val) {
      if($validate->string($val)){
        echo "Invalid!";
        return;
      }
    }
  }
  $id = $_COOKIE["manager"];
  $params = database\database::params();
  $conn = mysql($params);
  $get = "SELECT Contacts FROM manager WHERE Id = $id";
  $res = $conn->query($get);
  $row = $res->fetch_assoc();
  if($row["Contacts"] != ""){
    $arr = json_encode(array_merge(json_decode($row["Contacts"],true),json_decode($arr,true)));
  }
  $sql = "UPDATE manager SET Contacts = '$arr' WHERE Id = $id";
  if($conn->query($sql)!==TRUE){
    echo $conn->error;
    echo "An error occurred! Please try again.";
    return;
  }
  return;
}


//HANDLING INPUT


if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_FILES["dp"])){
    savedp($_FILES["dp"]);
  }
  if(!empty($_POST["contacts"])){
   savecontacts($_POST["contacts"]);
  }
}
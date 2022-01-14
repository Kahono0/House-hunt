<?php

//FUNCTIONS FOR HANDLING INPUT
use app\{
  autoload,
  database,
  handleimages,
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
    $obj["err"] = "An error occurred. Please try again";
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

//HANDLING INPUT


if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_FILES["dp"])){
    savedp($_FILES["dp"]);
  }
}
<?php

namespace app\database;
include "sql.php";
require "../autoload/loader.php";
use app\{
  autoload,
  database,
};
autoload\loader:: register ();
class init{
  public function __construct($conn)
  {
    $this->conn = $conn;
  }
  public function create($sql,$name)
  {
    $conn = $this->conn;
    echo "Creating table $name...\n";
    if($conn->query($sql) === TRUE){
      echo "Table $name created successfully.\n";
    }
    else{
      echo "Failed to create table $name.\n".$conn->error."\n";
    }
    
    
  }
  public function tables()
  {
    $sql = "SHOW TABLES";
    $result = $this->conn->query($sql);
    if($result->num_rows>0)
    {
      foreach($result->fetch_assoc() as $a)
      {
        echo $a;
      }
    }
    else
    {
      
      $conn = $this->conn;
      $conn = $this->conn;
      $area = "CREATE TABLE area(
        Area_code INT NOT NULL AUTO_INCREMENT,
        Area VARCHAR(100) NOT NULL,
        PRIMARY KEY(Area_code))";
      $manager = "CREATE TABLE manager(
        Id INT NOT NULL AUTO_INCREMENT,
        Name VARCHAR(100),
        Contact VARCHAR(100),
        PRIMARY KEY(Id))";
      $tenants = "CREATE TABLE tenants(
        Id INT NOT NULL AUTO_INCREMENT,
        Name VARCHAR(100) NOT NULL,
        Contact VARCHAR(100),
        PRIMARY KEY(Id))";
      
      $pics = "CREATE TABLE pics(
        Id INT NOT NULL AUTO_INCREMENT,
        House_id INT NOT NULL,
        Src VARCHAR(255),
        PRIMARY KEY(Id))";
        
      $reviews = "CREATE TABLE reviews(
        Id INT NOT NULL AUTO_INCREMENT,
        Sender INT NOT NULL,
        Review TEXT,
        PRIMARY KEY(Id))";
      
      $ratings = "CREATE TABLE ratings(
        House_id INT NOT NULL,
        User INT NOT NULL)";
     $this->create($area,"area");
     $this->create($manager,"manager");
     $this->create($tenants,"tenants");
     $this->create($pics,"pics");
     $this->create($reviews,"reviews");
     $this->create($ratings,"ratings");
    }
  }
};
$params = database\database::params();
$db = new init(mysql($params));
$db->tables();
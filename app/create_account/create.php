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

autoload\loader:: register ();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if($_POST["token"] == $_SESSION["token"])
  {
    $params = database\database::params();
    $conn = mysql($params);
    $val = new validate\validate();
    $error = $val->name($_POST["fname"]);
    if($error == "")
    {
      $error = $val->name($_POST["sname"]);
      if($error=="")
      {
        $error = $val->email($_POST["email"]);
        if($error=="")
        {
          if($_POST["password"] == $_POST["pass"])
          {
            $error = $val->pass($_POST["password"]);
            if($error == "")
            {
              //insert
              $account = $_POST["account"];
              $fname = $_POST["fname"];
              $sname = $_POST["sname"];
              $email = $_POST["email"];
              $password = hash("sha256",$_POST["password"]);
              $sql = "INSERT INTO $account(Fname,Sname, Email, Password)VALUES('$fname','$sname','$email','$password')";
              if($conn->query($sql) === TRUE)
              {
                echo 1;
              }
              else{
              echo $conn->error;
              }
            }
            else echo $error;
          }
          else echo "Passwords do not match";
        }
        else echo $error;
      }
      else echo $error;
    }
    else
    {
      echo $err;
    }
    
  }
}

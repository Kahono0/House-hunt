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
    $fname = $val->name($_POST["fname"]);
    if($fname == "")
    {
      $sname = $val->name($_POST["sname"]);
      if($sname=="")
      {
        $contacts = str_replace($_POST["contacts"],",","");
        $contacts = $val->name($contacts);
        if($contacts=="")
        {
          if($_POST["password"] == $_POST["pass"])
          {
            $password = $val->pass($password);
            if($password == "")
            {
              //insert
              $account = $_POST["account"];
              $fname = $_POST["fname"];
              $sname = $_POST["sname"];
              $contacts = $_POST["contacts"];
              $password = $_POST["password"];
              $sql = "INSERT INTO $account(Fname,Sname, Contacts, Password)VALUES('$fname','$sname','$contacts','$password')";
              if($conn->query($sql) === TRUE)
              {
                echo 1;
              }
              else{
              echo $conn->error;
              }
            }
            else echo $password;
          }
          else echo "Passwords do not match";
        }
        else echo $contacts;
      }
      else echo $sname;
    }
    else
    {
      echo $fname;
    }
    
  }
}

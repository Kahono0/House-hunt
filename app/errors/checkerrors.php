<?php

namespace app\errors;

class checkerrors
{
  public static function checksessions()
  {
    if(isset($_COOKIE["manager"])){
      header("Location: /app/manager/");
    }
    else if(isset($_COOKIE["tenants"])){
      header("Location: /");
    }
    else if(!isset($_COOKIE["manager"]) && !isset($_COOKIE["tenants"])){
      if($_SERVER["PHP_SELF"]!="/app/login/index.php"){
      header("Location: /login/");
      }
    }
  }
}
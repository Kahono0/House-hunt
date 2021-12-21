<?php

namespace app\errors;

class checkerrors
{
  public static function checksessions()
  {
    if(isset($_SESSION["manager"]) || isset($_SESSION["tenants"])){
      echo "logged in";
    }
  }
}
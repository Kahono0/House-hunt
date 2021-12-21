<?php

namespace app\errors;

class checkerrors
{
  public static function checksessions()
  {
    if(isset($_COOKIE["manager"]) || isset($_COOKIE["tenants"])){
      header("Location: /app/");
    }
  }
}
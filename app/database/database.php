<?php

namespace app\database;

class database{
  public static function params()
  {
  $params = [];
  $params["host"] = "localhost";
  $params["user"] = "jack";
  $params["password"] = "kahono";
  $params["db"] = "Househunt";
  return $params;
  }
};

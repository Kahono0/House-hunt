<?php

namespace app\database;

class database{
  public static function params()
  {
  $params = [];
  $params["host"] = "0.0.0.0";
  $params["user"] = "jack";
  $params["password"] = "kahono";
  $params["db"] = "Househunt";
  return $params;
  }
};
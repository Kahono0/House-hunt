<?php

function mysql($params)
{
  $conn = new mysqli(
    $params["host"],
    $params["user"],
    $params["password"],
    $params["db"]);
  if($conn)
  {
    return $conn;
  }
  echo $conn->connect_error;
}
<?php

//use mysqli;
use PDO;

function mysql($params)
{
    $host = $params['host'];
    $user = $params['user'];
    $pass = $params['pass'];
    $db = $params['db'];
    $port = $params['port'];
    $charset = $params['charset'];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
  // $conn = new mysqli(
  //   $params["host"],
  //   $params["user"],
  //   $params["password"],
  //   $params["db"]);
  // if($conn)
  // {
  //   return $conn;
  // }
  // echo $conn->connect_error;
}

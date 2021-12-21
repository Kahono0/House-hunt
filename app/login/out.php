<?php

try {
  if(isset($_COOKIE["manager"])){
    setcookie("manager","",time()-3600,"/");
  }
  else if(isset($_COOKIE["tenants"])){
    setcookie("tenants","",time()-3600,"/");
  }
  header("Location: /");
} catch (Exception $c) {
  header("Location: /");
  die();
}
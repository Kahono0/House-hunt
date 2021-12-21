<?php

session_start();
session_regenerate_id();

$_SESSION["token"] = urlencode(base64_encode(random_bytes(32)));
require "../autoload/loader.php";
use app\autoload;
use app\errors;
autoload\loader:: register ();
errors\checkerrors::checkSessions();
$token = $_SESSION["token"];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <center>
      <form method="post">
        <div id="error" style="color:red"></div>
        <input type="hidden" id="token" value="<?=$token;?>">
        Email:<br><input type="email" id="email">
        <br><br>
        Password:<br><input type="password" name="password" id="password" value="" />
        <br><br>
        <input type="button" name="manager" id="manager" value="Login as a manager" />
         <br><br>
        <input type="button" name="tenant" id="tenant" value="Login as a tenant" />
       
      </form>
      <script src="/app/js/login/login.js"></script>
  </body>
</html>
<?php

//THE LANDING PAGE FOR THE SITE.
//SHOWING HIGH RANKING RENTALS
//INCLUDING SEARCH AND LINK TO LOGIN

session_start();
session_regenerate_id();


require "app/autoload/loader.php";
require "app/database/sql.php";
use app\autoload;
use app\database;

autoload\loader::register();
$_SESSION["token"] = urlencode(base64_encode(random_bytes(32)));
$areas = "Select Area,Area_code from area";
$params = database\database::params();
$conn = mysql($params);
$areas = $conn->query($areas);
$areas = $areas->fetch_all();
$filters= array("Highest price first","lowest price first", "ratings");
$types = array("3 Bedroom","2 Bedroom","1 Bedroom","Bedsitter","Double Rooms","Single Rooms");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/app/css/index.css">
    <title></title>
  </head>
  <body>
    <div style="display:flex;justify-content:space-around;">
      <?php
if(!isset($_COOKIE["manager"]) && !isset($_COOKIE["tenants"])):?>
      <a href="/app/login/"><div>Login</div></a>
      <a href="/app/create_account/"><div>Create account</div></a>
      <?php else:?>
      <a href="/app/login/out.php">Log out</a>
      <?php endif?>
    </div>
    <div class="form">
      <div>Area:<br><select>
        <?php foreach($areas as $area) :?>
        <option value="<?=$area[1];?>"><?=$area[0];?></option>
        <?php endforeach?>
      </select></div>
      
      <div>Filter:<br><select>
        <?foreach($filters as $filter) :?>
        <option><?=$filter?></option>
        <?endforeach?>
      </select></div>
      
      <div>Type:<br><select>
        <?php foreach($types as $type) :?>
        <option><?=$type;?></option>
        <?php endforeach?>
      </select></div>
    </div>
  </body>
</html>

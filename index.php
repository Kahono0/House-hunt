<?php

//THE LANDING PAGE FOR THE SITE.
//SHOWING HIGH RANKING RENTALS
//INCLUDING SEARCH AND LINK TO LOGIN

session_start();
session_regenerate_id();
$_SESSION["token"] = urlencode(base64_encode(random_bytes(32)));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title></title>
  </head>
  <body>
    <div style="display:flex;justify-content:space-around;">
      <a href="/app/login/"><div>Login</div></a>
      <a href="/app/create_account/"><div>Create account</div></a>
    </div>
  </body>
</html>

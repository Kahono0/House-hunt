<?php
session_start();
session_regenerate_id();
$_SESSION["token"] = urlencode(base64_encode(random_bytes(32)));
$token = $_SESSION["token"] ?? urlencode(base64_encode(random_bytes(32)));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title></title>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
      <center>
        <input type="hidden" id="token" value="<?=$token;?>">
      Full name<br><input id="fname" placeholder="first name"><input id="sname" placeholder="Surname"><br><br>
      Contacts<br><div id="addContacts"><input type="text" id="contacts" placeholder="Separate multiple contacts with ','"></div><br><br>
      Password<br><input type="password" id="password" placeholder="password"><br><br>
      Confirm password<br><input type="password" id="pass" placeholder="confirm password">
      <!--<input type="button" onclick="addContact()" value="+add">-->
      <br><br>
      Account<select id="account">
        <option value="manager">Manager's account</option>
        <option vakue="tenant">Tenant's account</option>
      </select>
      <input type="button" onclick="create()" value="create">
      </center>
    </form>
    <script src="/app/js/create_account/create_manager.js"></script>
  </body>
</html>
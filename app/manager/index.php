<?php
echo "here is your office😌";
use app\{
  autoload,
  database,
  handleimages,
};

require "../autoload/loader.php";
require "../database/sql.php";
autoload\loader:: register ();
?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <title></title>
  </head>
<br><br>
<aside><a href="/app/login/out.php">Log out</a></aside>
<style>
.profile{
  height:fit-content;
  text-align: center;
}
label img{
  width:37vw;
  height:40vw;
  border-radius:50%;
  -moz-border-radius: 50%;
  webkit-border-radius: 50%;
  background:blue;
  
  /*margin:auto;*/
}
#err{
  color:red
}

</style>
<body>
  <div id="err"></div>
<?php
$params = database\database::params();
$conn = mysql($params);
$id = $_COOKIE["manager"];
$sql = "SELECT * FROM manager WHERE Id = $id";
$res = $conn->query($sql);
$manager = $res->fetch_assoc();
$conn->close();
$params = $conn = $sql = $res = $id = "";
?>
<form method="post" enctype="multipart/form-data" id="form"></form>
<div class = "profile">
  <label for="dp"><img id="dp-display" src="<?=$manager["Pic"];?>"></label>
  <input type="file" name="dp" id="dp" form="form" accept="image/*" style="display:none;">
  Tap on image to change profile pic
</div>
<script>
let err = document.getElementById("err")
let dp = document.getElementById("dp")
const clear = () => {
  dp.value = ""
}
dp.onchange = (function (e){
  const file=e.target.files[0];
  if(file!=null){
    var form = new FormData()
    form.append("dp",file);
    form.append("filename","<?=$manager["Pic"];?>")
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function (){
      if(this.readyState==4 && this.status==200){
         var error = JSON.parse(this.responseText)
          if(error.err != undefined){
            err.innerHTML = error.err
          }
          else{
            document.getElementById('dp-display').src = error.src
          }
      }
    };
  xhttp.open("POST","form.php",true);

  xhttp.send(form)
  clear()
  }
  
});
</script>
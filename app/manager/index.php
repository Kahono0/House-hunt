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
  display:flex;
  justify-content: center;
  flex-direction: column;
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
#contact-form,#add,#contact{
  display: none;
}
.con{
  font-size: 0.8em;
  padding:0.1em;
  width:fit-content;
  background: lightgrey;
  border-radius:3px;
  margin:0.5em;
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
   Tap on image to change profile pic<br>
  <label for="dp"><img id="dp-display" src="<?=$manager["Pic"];?>"></label>
  <input type="file" name="dp" id="dp" form="form" accept="image/*" style="display:none;">
  <h3><?=$manager["Fname"]." ".$manager["Sname"];?></h3>
  <b>rating:<?=$manager["rating"];?></b>
  <div><?php foreach (json_decode($manager["Contacts"]) as $key => $value): ?>
    <span><?=$key;?>:</span><span><?php if (is_array($value)): ?>
      <?=implode(",",$value);?>
    <?php else: ?>
      <?=$value;?>
    <?php endif; ?>
    </span><br>
  <?php endforeach; ?><span><button id="edit-contacts">Edit contacts</button></div>
  <div id="show-contacts"></div>
  <div id="contact-form">
    <select id="contact-type">
      <option selected disabled="1"></option>
      <?php $contact_types = array("email","phone","facebook","twitter","instagram","whatsapp");?>
      <?php foreach($contact_types as $type):?>
      <option value="<?=$type;?>"><?=$type;?></option>
      
      <?php endforeach?>
    </select>
    <br>
    <span id="xtype"></span><input type="text" id="contact">
    <br><button id="add">add</button>
    <div><button id="hide-form">cancel</button><button id="submit-contact">Finish</button></di>
  </div>
</div>
<script>
let img = document.getElementById('dp-display')
let err = document.getElementById("err")
let dp = document.getElementById("dp")
const clear = () => {
  dp.value = ""
}
dp.onchange = (function (e){
  img.src = URL.createObjectURL(e.target.files[0])
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
            img.src = "<?=$manager["Pic"];?>"
          }
      }
    };
  xhttp.open("POST","form.php",true);

  xhttp.send(form)
  clear()
  }
  
});

//contacts
function del(arr,txt){
  alert()/*  index = arrContacts[d].indexOf(i)
  document.getElementById(d+"-"+i).style.display = "none"
  delete arrContacts[d][index]*/
}

let contactForm = document.getElementById("contact-form")
let hideForm = document.getElementById("hide-form")
const showContactForm = () => {
  contactForm.style.display = "block";
}
let btn = document.getElementById("edit-contacts")
let select = document.getElementById("contact-type")
let add = document.getElementById("add")
let xtype = document.getElementById("xtype")
let show = document.getElementById("show-contacts")
let submitContact =document.getElementById("submit-contact")
const display = (arr,txt) => {
  //id=arr+"-"+txt
  id = "aa"
  show.innerHTML += "<span class='con'>"+txt+"<sup id='rem'>×</sup></span>"
}
let arrContacts = []
btn.onclick = function(){
  showContactForm()
  btn.style.display="none"
  hideForm.onclick = function (){
    contactForm.style.display = "none"
    btn.style.display = "block"
  }
  select.onchange = function (){
    select.style.display = "none"
    xtype.innerHTML = select.value+":"
    
    var contact = document.getElementById("contact")
    contact.style.display = "inline"
    add.style.display = "block"
    add.onclick = function (){
      if(!arrContacts[select.value]){
        arrContacts[select.value] = []
      }
      arrContacts[select.value].push(contact.value)
      select.style.display = "block"
      contact.value = ""
      contact.style.display = "none"
      add.style.display = "none"
      xtype.innerHTML = ""
      display(select.value,arrContacts[select.value][arrContacts[select.value].length-1])
      select.value=""
      for(a in arrContacts){
        alert(a)
      }
      
      submitContact.style.display = "block"
      submitContact.onclick = function(){
        save(arrContacts)
      }
      //showContacts(arrContacts[select.value][arrContacts[select.value].length-1)
    }
  }

}
function save(arrContacts){
  var form = new FormData()
  for(var a in arrContacts){
    alert(arrContacts[a])
  }
  let json = JSON .stringify( Object .assign({}, arrContacts)) 
  form.append("contacts",json)
  var xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange=function (){
    if(this.readyState==4 && this.status==200){
       
       alert(this.responseText)
    }
  };
  xhttp.open("POST","form.php",true);

  xhttp.send(form)
  clear()
}

</script>
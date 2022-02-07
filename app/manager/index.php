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
#unit-form{
  text-align: center;
}
textarea{
  width:50vw;
  height:15vh;
  padding:1em;
  border-radius:10px;
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
    <div><button id="hide-form">cancel</button><button id="submit-contact">Finish</button></div>
  </div>
  <div id="add-unit"><button id="btn-unit">+Add unit(s)</button></div>
</div>
<div id="unit-form" style="display:none;">
  <form action="" method="post" enctype="multipart/form-data">
  <div class="name">Name of unit, house<br><input type="text" id="unit-name"></div>
  <div class="type">Type of unit<br>
    <select id="unit-type">
      <option disabled selected></option>
      <?php
        $arr_val = array ("3-bed"=>"3 bedroom","2-bed"=>"2 bedroom","1-bed"=>"1 bedroom","bedsitter"=>"bedsitter","d-room"=>"double room","s-room"=>"single room");
        foreach ($arr_val as $val=>$key):?>
      <option value="<?=$val;?>"><?=$key;?></option>
      <?php endforeach;?>
    </select>
  </div>
  <div class="desc">Detailed description<br><textarea id="desc"></textarea></div>
  <div class="quantity">No of units<br><input type="number" id="quantity"></div>
  <div class="images" id="images">Images<input type="file" id="unit-image" style="display:none"><label for="unit-image"><img src="../images/add.jpg"></label></div>
  <div class="location">Location<br><input type="url" id="location"></div>
  <div id="sub"><input type="button" id="sub-unit" value="+Add"></div>
  </form>
  
</div>
<script>
let img = document.getElementById('dp-display')
let err = document.getElementById("err")
let dp = document.getElementById("dp")
const clear = () => {
  dp.value = ""
}
dp.onchange = function (e){
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
  
};

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
const val = (type, value) =>{
     var format = ""
     switch(type){
          case "email":
               format = /[#$'&_&\-+()\/*":;!?]/
               break
          case "phone":
               format = /[a-zA-Z\W]/
               break
          case "facebook":
               format = /[]/
               
     }
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
      val(select.value,contact.value)
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

//add unit
/*
let unitBtn = document.getElementById("btn-unit")
let unitForm = document.getElementById("unit-form")
let subUnit = document.getElementById("sub-unit")
let unitName = document.getElementById("unit-name")
let unitType = document.getElementById("unit-type")
let description = document.getElementById("desc")
let quantity = document.getElementById("quantity")
let location = document.getElementById("location")
let unitImg = document.getElementById("unit-image")
let dispImg = document.getElementById("images")
let unitImages = []
function validate(str,type){
     let formatstr = /;";"/
}

unitBtn.onclick = function (){
  unitForm.style.display = "block"
  unitImg.onchange=function (e){
    var src = URL.createObjectURL(e.target.files[0])
    dispImg.innerHTML = "<div><img src='"+src+"'></div>"
    const file=e.target.files[0];
    unitImages.push(file)
    subUnit.onclick = function (){
         if(validate(unitName.value,"string")){
              if(validate(description.value,"string")){
                   var x,y = getLocation(location)
              }
         }
         if(x=="" && y=""){
              alert("Invalid form data")
         }
         var form = new FormData()
         form.append(unitName.value,"unit_name")
         form.append(unitType.value,"unit_type")
         form.append(description.value,"description")
         form.append(quantity.value,"quantity")
         form.append(unitImages,"images[]")
         form.append(x,"x")
         form.append(y,"y")
         var xhttp=new XMLHttpRequest()
         xhttp.onreadystatechange=function (){
              if(this.readyState==4 && this.status==200){
            
                 alert(this.responseText)
              }
         };
          xhttp.open("POST","form.php",true);

          xhttp.send(form)
         
         
         
    }
}*/
</script>
